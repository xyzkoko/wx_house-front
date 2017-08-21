<?php
/**
 * 微信接口类
 *
 * @author: Sirius
 */

class Api_WeiChat extends PhalApi_Api {

    /**
     * 微信默认入口
     * @desc 内部调用
     */
    public function index() {
        $state = isset($_REQUEST['state'])?$_REQUEST['state']:null;
        $uid = isset($_SESSION['uid'])?$_SESSION['uid']:null;
        $code = isset($_GET['code'])?$_GET['code']:null;
        if(!$uid){
            $this->oauth2($state,$code);
        }
        $this->putUserInfo($state);
        $this->view($state);
    }

    /**
     * 微信用户授权和登陆
     * @desc 内部调用
     */
    public function oauth2($state,$code = null){
        $AppID = DI()->config->get('app.weichat.AppID');
        $AppSecret = DI()->config->get('app.weichat.AppSecret');
        if(!$code){
            $redirect_uri = 'http://www.allwinits.com?service=WeiChat.index';
            $scope='snsapi_userinfo';
            $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$AppID.'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
            header("Location:".$url);exit;
        }
        //根据code获取access_token和openid
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$code.'&grant_type=authorization_code';
        $res = DI()->function->curl($get_token_url);
        $json_decode = json_decode($res,true);
        DI()->cache->set('access_token',$json_decode['access_token'],7000);
        $domian = new Domain_WeiChat();
        $userInfo = $domian->GetUserInfoByOpenId($json_decode['openid']);
        $uid = $userInfo['uid'];
        if(!$userInfo){
            $json_decode = $domian->getWeiChatUserInfo($json_decode['openid']);
            $uid = $domian->postUserInfo($json_decode);
        }
        $_SESSION['uid'] = $uid;
    }

    /**
     * 微信用户信息更新（每日一次）
     * @desc 内部调用
     */
    public function putUserInfo($state){
        $uid = $_SESSION['uid'];
        $domian = new Domain_User();
        $userInfo = $domian->getUserInfo($uid);
        $update_dt = substr($userInfo['update_dt'],0,10);
        if($update_dt != date('Y-m-d')){
            $access_token = DI()->cache->get('access_token');
            if(!$access_token){
                $this->oauth2($state);
            }
            $domian = new Domain_WeiChat();
            $json_decode = $domian->getWeiChatUserInfo($userInfo['openid']);

            $domian->putUserInfo($json_decode);
        }
    }

    /**
     * 微信跳转页面
     * @desc 内部调用
     */
    public function view($state) {
        switch ($state){
            case "register":
                //TODO 后期如果用户已注册不再跳转注册界面
                $url = "http://www.allwinits.com/web/register.php";
                header("Location:".$url);
                break;
            case "userInfo":
                $url = "http://www.allwinits.com/web/userinfo.php";
                header("Location:".$url);
                break;
            case "business":
                $url = "http://www.allwinits.com/web/main.php";
                header("Location:".$url);
                break;
            case "mybusiness":
                $url = "http://www.allwinits.com/web/myYeWu.php";
                header("Location:".$url);
                break;
            case "help":
                $url = "http://www.allwinits.com/web/helper.php";
                header("Location:".$url);
                break;
            default:
                $url = "http://www.allwinits.com/web/userinfo.php";
                header("Location:".$url);
                break;
        }
    }

    /**
     * 获取wx.config内容
     * @desc 内部调用
     */
    public function getWebConfig() {
        $AppID = DI()->config->get('app.weichat.AppID');
        $ticket = DI()->cache->get('ticket');
        if (!$ticket){
            $this->getTicket();
            $ticket = DI()->cache->get('ticket');
        }
        //$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = urldecode($_GET['url']);//"$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = DI()->function->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId"     => $AppID,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    /**
     * 获取jsapi_ticket
     * @desc 内部调用
     */
    public function getTicket() {
        $token = DI()->cache->get('token');
        if(!$token){
            $this->getToken();
            $token = DI()->cache->get('token');
        }
        $get_ticket_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$token";
        $res = DI()->function->curl($get_ticket_url);
        $json_decode = json_decode($res,true);
        $ticket = $json_decode['ticket'];
        if($ticket){
            DI()->cache->set('ticket',$ticket,7000);
        }
    }

    /**
     * 获取token
     * @desc 内部调用
     */
    public function getToken() {
        $AppID = DI()->config->get('app.weichat.AppID');
        $AppSecret = DI()->config->get('app.weichat.AppSecret');
        $get_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$AppID&secret=$AppSecret";
        $res = DI()->function->curl($get_token_url);
        $json_decode = json_decode($res,true);
        $token = $json_decode['access_token'];
        if($token){
            DI()->cache->set('token',$token,7000);
        }
    }

    /**
     * 开发者模式下URL地址
     * @desc 内部调用
     */
    public function check() {
        DI()->logger->info('check', $_REQUEST);
        $signature = $_GET['signature'];
        $echostr = $_GET['echostr'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $Token = DI()->config->get('app.weichat.Token');
        $sign = DI()->function->getSHA1($Token, $timestamp, $nonce);
        if($signature == $sign){
            echo $echostr;exit;
        }
        return false;
    }

    /**
     * 创建自定义菜单
     * @desc 只需上传一次
     */
    public function postMenu() {
        $token = DI()->cache->get('token');
        if(!$token){
            $this->getToken();
            $token = DI()->cache->get('token');
        }
        $post_menu_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";
        $data = array();
        $data['button'][] = ['name'=>'业务中心','sub_button'=>[
            ['type'=>'view','name'=>'业务办理','url'=>'http://www.allwinits.com/?service=WeiChat.Index&state=business'],
            ['type'=>'view','name'=>'我的业务','url'=>'http://www.allwinits.com/?service=WeiChat.Index&state=mybusiness'],
            ['type'=>'view','name'=>'帮助','url'=>'http://www.allwinits.com/?service=WeiChat.Index&state=help']
        ]];
        $data['button'][] = ['name'=>'个人中心','sub_button'=>[
            ['type'=>'view','name'=>'用户绑定','url'=>'http://www.allwinits.com/?service=WeiChat.Index&state=register'],
            ['type'=>'view','name'=>'个人信息','url'=>'http://www.allwinits.com/?service=WeiChat.Index&state=userInfo'],
        ]];
        $res = DI()->function->curl($post_menu_url,json_encode($data, JSON_UNESCAPED_UNICODE));
        return json_decode($res,true);
    }

    /**
     * 发送模板信息（审核通知）
     * @desc 管理端调用
     */
    public function sendTemplate() {
        $token = DI()->cache->get('token');
        if(!$token){
            $this->getToken();
            $token = DI()->cache->get('token');
        }
        $send_template_url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token";
        $res = DI()->function->curl($send_template_url,json_encode($_POST, JSON_UNESCAPED_UNICODE));
        return json_decode($res,true);
    }
}
