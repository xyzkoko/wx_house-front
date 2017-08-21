<?php
/**
 * 验证码业务类
 */

class Domain_Message {

    private static $model;

    public function __construct(){
        self::$model = new Model_Message();
    }

    public function postMessage($uid,$mobile,$msg_id) {
        return self::$model->postMessage($uid,$mobile,$msg_id);
    }

    public function getMessageNum($uid) {
        return self::$model->getMessageNum($uid);
    }

}
