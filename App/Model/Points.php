<?php
/**
 * 积分数据源类
 */

class Model_Points extends PhalApi_Model_NotORM {

    public function getSign($uid) {
        return DI()->notorm->points_sign->select('update_dt','days')->where('uid', $uid)->fetchRow();
    }

    public function postSign($uid) {
        $data = array(
            'uid' => $uid,
            'update_dt' => date("Y-m-d"),
            'days' => 0
        );
        $rs = DI()->notorm->points_sign->insert($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function putSign($uid,$days) {
        $data = array(
            'update_dt' => date("Y-m-d"),
            'days' => $days
        );
        $rs = DI()->notorm->points_sign->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function putUserPoints($uid,$points) {
        $data = array(
            'points' => new NotORM_Literal("points + $points")
        );
        $rs = DI()->notorm->user->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }
}
