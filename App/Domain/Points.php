<?php
/**
 * 积分业务类
 */

class Domain_Points {

    private static $model;

    public function __construct(){
        self::$model = new Model_Points();
    }

    public function getSign($uid) {
        return self::$model->getSign($uid);
    }

    public function postSign($uid) {
        return self::$model->postSign($uid);
    }

    public function putSign($uid,$days) {
        return self::$model->putSign($uid,$days);
    }


    public function putUserPoints($uid,$points) {
        return self::$model->putUserPoints($uid,$points);
    }
}
