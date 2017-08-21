<?php
/**
 * 微信业务类
 */

class Domain_WeiChat {

    private static $model;

    public function __construct(){
        self::$model = new Model_WeiChat();
    }

    public function GetUserInfoByOpenId($openid) {
        return self::$model->GetUserInfoByOpenId($openid);
    }

    public function getWeiChatUserInfo($openid){
        $access_token = DI()->cache->get('access_token');
        $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $res = DI()->function->curl($get_user_info_url);
        return json_decode($res,true);
    }

    public function postUserInfo($user_obj) {
        return self::$model->postUserInfo($user_obj);
    }

    public function putUserInfo($user_obj) {
        self::$model->putUserInfo($user_obj);
    }

    /**
     * 用户图片绑定
     * @desc 下载微信媒体文件ID和用户绑定
     */
    public function postImage($media_id) {
        $token = DI()->cache->get('token');
        if(!$token){
            return false;
        }
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$token&media_id=$media_id";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);//只取body头
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//curl_exec执行成功后返回执行的结果；不设置的话，curl_exec执行成功则返回true
        $output = curl_exec($ch);
        curl_close($ch);
        return base64_encode($output);
    }
}
