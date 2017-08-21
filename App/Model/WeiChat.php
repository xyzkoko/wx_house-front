<?php
/**
 * 微信数据源类
 */

class Model_WeiChat extends PhalApi_Model_NotORM {

    protected function getTableName($id = null) {
        return 'user';
    }

    public function GetUserInfoByOpenId($openid) {
        return $this->getORM()
            ->select('uid')
            ->where('openid', $openid)
            ->fetchRow();
    }

    public function postUserInfo($user_obj) {
        $data = array(
            'openid' => $user_obj['openid'],
            'nickname' => isset($user_obj['nickname'])?$user_obj['nickname']:null,
            'city' => isset($user_obj['city'])?$user_obj['city']:null,
            'sex' => isset($user_obj['sex'])?$user_obj['sex']:0,
            'headimgurl' => isset($user_obj['headimgurl'])?$user_obj['headimgurl']:null,
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = $this->getORM()->insert($data);
        return $rs['id'];
    }

    public function putUserInfo($user_obj) {
        $data = array(
            'nickname' => isset($user_obj['nickname'])?$user_obj['nickname']:null,
            'city' => isset($user_obj['city'])?$user_obj['city']:null,
            'sex' => isset($user_obj['sex'])?$user_obj['sex']:0,
            'headimgurl' => isset($user_obj['headimgurl'])?$user_obj['headimgurl']:null,
            'update_dt' => date("Y-m-d H:i:s")
        );
        $this->getORM()->where('openid', $user_obj['openid'])->update($data);
    }

}
