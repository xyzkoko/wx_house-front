<?php
/**
 * 用户业务类
 */

class Domain_User {

    private static $model;

    public function __construct(){
        self::$model = new Model_User();
    }

    public function getUserInfo($uid) {
        return self::$model->GetUserInfoByUid($uid);
    }

    public function putUserRoleid($uid,$post) {
        return self::$model->putUserRoleid($uid,$post);
    }

    public function getUserInfoByMobile($mobile) {
        return self::$model->getUserInfoByMobile($mobile);
    }

    public function deleteUser($uid) {
        return self::$model->deleteUser($uid);
    }

    public function addUserPoints($uid,$points) {
        return self::$model->addUserPoints($uid,$points);
    }

}
