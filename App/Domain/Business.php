<?php
/**
 * 业务类
 */

class Domain_Business {

    private static $model;

    public function __construct(){
        self::$model = new Model_Business();
    }

    public function postBusiness($uid,$post) {
        return self::$model->postBusiness($uid,$post);
    }

    public function putBusiness($uid,$post) {
        return self::$model->putBusiness($uid,$post);
    }

    public function getBusiness($uid,$bid) {
        return self::$model->getBusiness($uid,$bid);
    }

    public function getBusinessSign($bid) {
        return self::$model->getBusinessSign($bid);
    }

    public function putBusinessSign($uid,$bid,$sign_money,$post) {
        return self::$model->putBusinessSign($uid,$bid,$sign_money,$post);
    }

    public function getBusinessAssess($bid) {
        return self::$model->getBusinessAssess($bid);
    }

    public function putBusinessAssess($uid,$bid,$post) {
        return self::$model->putBusinessAssess($uid,$bid,$post);
    }

    public function getBusinessList($page,$count,$uid,$day,$error) {
        return self::$model->getBusinessList($page,$count,$uid,$day,$error);
    }

    public function getBusinessCount($uid,$day,$error) {
        return self::$model->getBusinessCount($uid,$day,$error);
    }

    public function putBusinessStatus($uid,$bid,$post) {
        return self::$model->putBusinessStatus($uid,$bid,$post);
    }

    public function putSignBusinessStatus($uid,$bid,$status) {
        return self::$model->putSignBusinessStatus($uid,$bid,$status);
    }

    public function putAssessBusinessStatus($uid,$bid,$status) {
        return self::$model->putAssessBusinessStatus($uid,$bid,$status);
    }

    public function getCommonValue($common_key) {
        return self::$model->getCommonValue($common_key);
    }
}
