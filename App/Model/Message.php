<?php
/**
 *  验证码数据源类
 */

class Model_Message extends PhalApi_Model_NotORM {

    public function postMessage($uid,$mobile,$msg_id) {
        $data = array(
            'uid' => $uid,
            'mobile' => $mobile,
            'msg_id' => $msg_id,
            'create_dt' => date("Y-m-d H:i:s")
        );
        $this->getORM()->insert($data);
    }

    public function getMessageNum($uid) {
        return $this->getORM()
            ->where('uid', $uid)
            ->count();
    }
}
