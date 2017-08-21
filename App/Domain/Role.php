<?php
/**
 * 角色业务类
 */

class Domain_Role {

    private static $model;

    public function __construct(){
        self::$model = new Model_Role();
    }

    public function BankRegister($uid,$post) {
        if(self::$model->getBankByUid($uid)){
            return false;
        }
        return self::$model->BankRegister($uid,$post);
    }

    public function BrokerRegister($uid,$post) {
        if(self::$model->getBrokerByUid($uid)){
            return false;
        }
        return self::$model->BrokerRegister($uid,$post);
    }

    public function SellerRegister($uid,$post) {
        if(self::$model->getSellerByUid($uid)){
            return false;
        }
        return self::$model->SellerRegister($uid,$post);
    }

    public function getBankInfo($uid) {
        return self::$model->getBankByUid($uid);
    }

    public function getBrokerInfo($uid) {
        return self::$model->getBrokerByUid($uid);
    }

    public function getSellerInfo($uid) {
        return self::$model->getSellerByUid($uid);
    }

    public function putBrokerInfo($uid,$data) {
        return self::$model->putBrokerInfo($uid,$data);
    }

    public function getSellerList($page,$count) {
        return self::$model->getSellerList($page,$count);
    }

    public function getSellerCount() {
        return self::$model->getSellerCount();
    }

    public function putBankUid($uid,$newUid) {
        return self::$model->putBankUid($uid,$newUid);
    }

    public function putSellerUid($uid,$newUid) {
        return self::$model->putSellerUid($uid,$newUid);
    }

    public function getAuditError($audit_error) {
        return self::$model->getAuditError($audit_error);
    }

}
