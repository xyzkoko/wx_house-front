<?php
/**
 * 角色接口类
 *
 * @author: Sirius
 */

class Api_Role extends PhalApi_Api {

    public function getRules() {
        return array(
            'putBrokerInfo' => array(
                'licence_photo' 	=> array('name' => 'licence_photo','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '营业执照微信临时文件ID'),
                'head_photo' 	=> array('name' => 'head_photo','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '门头照片微信临时文件ID' ),
                'address' 	=> array('name' => 'address','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '地址' )
            ),
            'getSellerList' => array(
                'page' 	=> array('name' => 'page','type' => 'int', 'default' => 1, 'min' => 1, 'source' => 'post', 'desc' => '当前页数 不传默认为1'),
                'count' 	=> array('name' => 'count','type' => 'int','default' => 10, 'min' => 1, 'source' => 'post', 'desc' => '每页显示数量 不传默认为10')
            )
        );
    }

    /**
     * 修改中介信息接口
     * @desc 修改中介会员信息
     * @return int code 接口状态 0 成功  1 用户不存在或角色不存在 2 每周只能修改一次 3 下拉微信图片失败 4 修改失败
     * @return string error 错误提示信息
     */
    public function putBrokerInfo() {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
            return $array;
        }
        $domian = new Domain_Role();
        $roleinfo = $domian->getBrokerInfo($uid);
        if(!$roleinfo || $userinfo['roleid'] != 2){
            $array['code'] = 1;
            $array['error'] = T('role not exists');
            return $array;
        }
        $update_dt = $roleinfo['update_dt'];
        $date=date('Y-m-d');
        $first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
        $w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $now_start = strtotime("$date -".($w ? $w - $first : 6).' days');
        if($update_dt&&strtotime($update_dt)>=$now_start) {
            //TODO 每周只能修改一次
            //$array['code'] = 2;
            //$array['error'] = T('role too much');
            //return $array;
        }
        $status = $roleinfo['status'];  //TODO 判断角色是否已审核
        $licence_photo = $_POST['licence_photo'];
        $head_photo = $_POST['head_photo'];
        $token = DI()->cache->get('token');
        if(!$token){
            $api = new Api_WeiChat();
            $api->getToken();
        }
        $domianWeichat = new Domain_WeiChat();
        $data['licence_photo'] = $domianWeichat->postImage($licence_photo);
        $data['head_photo'] = $domianWeichat->postImage($head_photo);
        $data['address'] = $_POST['address'];
        $data['update_dt'] = date('Y-m-d H:i:s');
        $data['status'] = '1';
        $res = $domian->putBrokerInfo($uid,$data);
        if(!$res){
            $array['code'] = 4;
            $array['error'] = T('put error');
        }
        return $array;
    }

    /**
     * 商家列表接口
     * @desc 获取所有商家列表
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     * @return string uid 商家id
     * @return string roleid 角色
     * @return string create_dt 创建时间
     * @return string nickname 昵称
     * @return string sex 性别
     * @return string headimgurl 头像
     * @return string mobile 手机号码
     * @return string points 积分
     */
    public function getSellerList()
    {
        $array = array(
            'code' => 0
        );
        $domian = new Domain_Role();
        $res = $domian->getSellerList($this->page,$this->count);
        $array = array_merge($array,$res);
        return $array;
    }

    /**
     * 商家总数接口
     * @desc 获取所有商家数量
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     * @return string count 商家总数
     */
    public function getSellerCount()
    {
        $array = array(
            'code' => 0
        );
        $domian = new Domain_Role();
        $res = $domian->getSellerCount();
        $array['count'] = $res;
        return $array;
    }
}
