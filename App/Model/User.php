<?php
/**
 * 用户数据源类
 */

class Model_User extends PhalApi_Model_NotORM {



    public function GetUserInfoByUid($uid) {
        return $this->getORM()
            ->select('uid','openid','nickname','headimgurl','mobile','points','roleid','update_dt')
            ->where('uid', $uid)
            ->fetchRow();
    }

    public function putUserRoleid($uid,$post) {
        $data = array(
            'roleid' => $post['roleid'],
            'mobile' => $post['mobile']
        );
        $rs = DI()->notorm->user->where('uid', $uid)->update($data);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getUserInfoByMobile($mobile) {
        return $this->getORM()
            ->select('uid','roleid','points','create_dt')
            ->where('mobile', $mobile)
            ->fetchRow();
    }

    public function deleteUser($uid) {
        return DI()->notorm->user->where('uid', $uid)->delete();
    }

    public function addUserPoints($uid,$points) {
        $sql = "update pa_user set points = points + :points where uid = :uid";
        $params = array(':points' => $points, ':uid' => $uid);
        return DI()->notorm->user->queryRows($sql,$params);
    }

}
