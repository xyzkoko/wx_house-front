<?php
/**
 * 极光短信接口类
 *
 * @author: Sirius
 */

class Api_Message extends PhalApi_Api {

    public function getRules() {
        return array(
            'sendCode' => array(
                'mobile' 	=> array('name' => 'mobile','regex' => "/^1[34578]\d{9}$/", 'require' => true,'source' => 'post', 'desc' => '手机号码')
            ),
        );
    }
    /**
     * 发送验证码
     * @desc 调用极光发送验证码接口
     * @return int code 接口状态 0 成功  1 发送失败 2 每日获取验证码最多10次
     * @return string error 错误提示信息
     */
    public function sendCode() {
        $array = array(
            'code' => 0
        );
        $temp_id = '125341';
        $mobile = $_POST['mobile'];
        $uid = $_SESSION['uid'];
        $domian = new Domain_Message();
        $num = $domian->getMessageNum($uid);
        if($num >= 10) {
            $array['code'] = 2;
            $array['error'] = T('message too much');
            return $array;
        }
        $res = DI()->jsms->sendCode($mobile, $temp_id);
        if($res['http_code'] == 200){
            $body = json_decode($res['body'],true);
            DI()->cache->set($uid.'_msg_id',$body['msg_id'],120);
            $domian->postMessage($uid,$mobile,$body['msg_id']);
        }else{
            $array['code'] = 1;
            $array['error'] = T('message send error');
        }
        return $array;
    }
    /**
     * 下行消息发送状态回调
     * @desc 暂不使用
     */
    public function mt() {
        //url校验
        if(isset($_GET['echostr'])){
            echo$_GET['echostr'];exit;
        }
        return null;
    }

    /**
     * 上行消息内容回调
     * @desc 暂不使用
     */
    public function mo(){
        //url校验
        if(isset($_GET['echostr'])){
            echo$_GET['echostr'];exit;
        }
        return null;
    }
}
