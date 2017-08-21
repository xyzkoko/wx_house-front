<?php
/**
 * 用户接口类
 *
 * @author: Sirius
 */

class Api_User extends PhalApi_Api {

    public function getRules() {
        return array(
            'register' => array(
                'mobile' 	=> array('name' => 'mobile','regex' => "/^1[34578]\d{9}$/", 'require' => true,'source' => 'post', 'desc' => '手机号码'),
                'code' 	=> array('name' => 'code','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '手机验证码' ),
                'roleid' 	=> array('name' => 'roleid','type' => 'enum','range' => array('1', '2', '3'), 'require' => true,'source' => 'post', 'desc' => '注册类型：1|银行 2|中介 3|商家' ),
                'friend' 	=> array('name' => 'friend','regex' => "/^1[34578]\d{9}$/", 'require' => false,'source' => 'post', 'desc' => '推荐人手机号码 各加10积分')
            ),
        );
    }

    /**
     * 注册接口
     * @desc 用户可注册为：银行会员/中介会员/商家会员
     * @return int code 接口状态 0 成功  1 用户不存在  2 用户该角色已注册 3 验证码输入错误
     * @return string error 错误提示信息
     */
    public function register() {
        DI()->logger->info('register', array('uid' => $_SESSION['uid'], 'data' => $_POST));
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $code = $_POST['code'];
        //$roleid = $_POST['roleid'];       //注册只有中介会员
        $mobile = $_POST['mobile'];
        $msg_id = DI()->cache->get($uid.'_msg_id');
        $res = DI()->jsms->checkCode($msg_id, $code);
        if($res['http_code'] != 200){
            $array['code'] = 3;
            $array['error'] = T('message check error');
            return $array;
        }
/*        if($code != 111111){
            $array['code'] = 3;
            $array['error'] = T('message check error');
            return $array;
        }*/
        $domian = new Domain_User();
        $result = $domian->getUserInfoByMobile($mobile);
        if($result){
            if($result['uid'] == $uid){     //重复注册
                $array['code'] = 2;
                $array['error'] = T('user role exists');
                return $array;
            }
            $post = ['mobile'=>$mobile,'roleid'=>$result['roleid'],'points'=>$result['points'],'create_dt'=>$result['create_dt']];
            $domian->putUserRoleid($uid,$post);
            $domian->deleteUser($result['uid']);        //删除后台添加的uid
            $domian = new Domain_Role();
            switch ($result['roleid']){
                case 1:
                    $domian->putBankUid($result['uid'],$uid);
                    break;
                case 3:
                    $domian->putSellerUid($result['uid'],$uid);
                    break;
            }
        }else{
            $domian = new Domain_Role();
            $domian->BrokerRegister($uid,$_POST);
            $domian = new Domain_User();
            $bool = $domian->putUserRoleid($uid,$_POST);
            if($bool){
                $array['code'] = 1;
                $array['error'] = T('user not exists');
            }
        }
        if($this->friend && $mobile!=$this->friend){     //有推荐人
            $result = $domian->getUserInfoByMobile($this->friend);
            if($result){
                $domian->addUserPoints($uid,10);
                $domian->addUserPoints($result['uid'],10);
            }
        }
        return $array;
    }

    /**
     * 用户信息接口
     * @desc 获取当前用户信息
     * @return int code 接口状态 0 成功  1 用户不存在
     * @return string error 错误提示信息
     * @return string uid 用户唯一标识
     * @return string nickname 微信昵称
     * @return string headimgurl 微信头像地址
     * @return string mobile 手机号码
     * @return string points 积分
     * @return string roleid 角色ID
     * @return string rolename 角色名称
     * @return string bank_name 可选 银行名称
     * @return string licence_photo 可选 营业执照
     * @return string head_photo 可选 门头照片
     * @return string address 可选 地址
     * @return string status 0未提交 1认证中 2认证通过 3认证未通过
     * @return string audit_error 未通过原因
     * @return string sign_money 网签金额
     */
    public function info() {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
        }else{
            $domian = new Domain_Role();
            switch ($userinfo['roleid']){
                case 1:     //银行会员
                    $userinfo['rolename'] = '银行会员';
                    $roleinfo = $domian->getBankInfo($uid);
                    if($roleinfo['audit_error']){
                        $result = $domian->getAuditError($roleinfo['audit_error']);
                        $roleinfo['audit_error'] = $result[0]['name'];
                    }
                    break;
                case 2:     //中介会员
                    $userinfo['rolename'] = '中介会员';
                    $roleinfo = $domian->getBrokerInfo($uid);
                    if($roleinfo['audit_error']){
                        $result = $domian->getAuditError($roleinfo['audit_error']);
                        $roleinfo['audit_error'] = $result[0]['name'];
                    }
                    break;
                case 3:     //商家会员
                    $userinfo['rolename'] = '商家会员';
                    $roleinfo = $domian->getSellerInfo($uid);
                    if($roleinfo['audit_error']){
                        $result = $domian->getAuditError($roleinfo['audit_error']);
                        $roleinfo['audit_error'] = $result[0]['name'];
                    }
                    break;
                default:
                    $roleinfo = array();
                    break;
            }
            $array = array_merge($array,$userinfo,$roleinfo);
            $domian = new Domain_Business();
            $result = $domian->getCommonValue('sign_money');    //获取网签金额
            $array['sign_money'] = $result[0]['common_value'];
        }
        return $array;
    }

    /**
     * 每日签到
     * @desc 每日签到 第1天10，第2天20，第3天之后30
     * @return int code 接口状态 0 成功  1 当日已签到
     * @return string error 错误提示信息
     * @return string points 获得积分
     * @return string all_points 获得后总积分
     */
    public function sign() {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $domian = new Domain_Points();
        $res = $domian->getSign($uid);
        if(!$res){
            $domian->postSign($uid);
            $points = 10;
        }else{
            $update_dt = $res['update_dt'];
            $days = $res['days'];
            if($update_dt == date('Y-m-d')){        //已签到
                $array['code'] = 1;
                $array['error'] = T('sign is exists');
                return $array;
            }elseif ($update_dt == date('Y-m-d',strtotime("-1 day"))){       //连续签到
                switch ($days){
                    case 0:
                        $points = 20;
                        break;
                    default:
                        $points = 30;
                        break;
                }
                $days++;
            }else{      //未连续签到
                $points = 10;
                $days = 0;
            }
            $domian->putSign($uid,$days);
        }
        $domian->putUserPoints($uid,$points);
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        $array['points'] = $points;
        $array['all_points'] = $userinfo['points'];
        return $array;
    }
}
