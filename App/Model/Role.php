<?php
/**
 * 角色数据源类
 */

class Model_Role extends PhalApi_Model_NotORM {

    public function BankRegister($uid,$post) {
        $data = array(
            'uid' => $uid,
            'roleid' => $post['roleid'],
            'status' => 0,
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = DI()->notorm->role_bank->insert($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getBankByUid($uid) {
        return DI()->notorm->role_bank->select('bank_name','status','audit_error','update_dt')->where('uid', $uid)->fetchRow();
    }

    public function BrokerRegister($uid,$post) {
        $data = array(
            'uid' => $uid,
            'roleid' => $post['roleid'],
            'status' => 0,
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = DI()->notorm->role_broker->insert($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getBrokerByUid($uid) {
        return DI()->notorm->role_broker->select('licence_photo','head_photo','address','status','audit_error','update_dt')->where('uid', $uid)->fetchRow();
    }

    public function SellerRegister($uid,$post) {
        $data = array(
            'uid' => $uid,
            'roleid' => $post['roleid'],
            'status' => 0,
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = DI()->notorm->role_seller->insert($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getSellerByUid($uid) {
        return DI()->notorm->role_seller->select('licence_photo','status','audit_error','update_dt')->where('uid', $uid)->fetchRow();
    }

    public function putBrokerInfo($uid,$data) {
        $rs = DI()->notorm->role_broker->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getSellerList($page,$count) {
        $sql = "select a.uid,a.roleid,a.create_dt,b.nickname,b.sex,b.headimgurl,b.mobile,b.points from pa_role_seller as a LEFT JOIN pa_user as b ON a.uid = b.uid limit :page,:count";
        $params = array(':page' => ($page-1)*$count, ':count' => $count);
        return DI()->notorm->role_seller->queryRows($sql,$params);
    }

    public function getSellerCount() {
        return DI()->notorm->role_seller->count();
    }

    public function putBankUid($uid,$newUid) {
        $data = ['uid' => $newUid];
        $rs = DI()->notorm->role_bank->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function putSellerUid($uid,$newUid) {
        $data = ['uid' => $newUid];
        $rs = DI()->notorm->role_seller->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getAuditError($audit_error) {
        $sql = "select name from la_check_error WHERE id = :id";
        $params = array(':id' => $audit_error);
        return DI()->notorm->user->queryRows($sql,$params);
    }
}
