<?php
/**
 * 业务数据源类
 */

class Model_Business extends PhalApi_Model_NotORM {

    public function postBusiness($uid,$post) {
        $data = array(
            'uid' => $uid,
            'sign' => $post['sign'],
            'assess' => $post['assess'],
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = DI()->notorm->business->insert($data);
        return $rs['id'];
    }

    public function putBusiness($uid,$post) {
        $bid = $post['bid'];
        $data = array(
            'sign' => $post['sign'],
            'assess' => $post['assess'],
            'create_dt' => date("Y-m-d H:i:s")
        );
        $rs = DI()->notorm->business->where('uid', $uid)->where('bid', $bid)->update($data);
        if ($rs === false) {
            return false;
        }
        return $bid;
    }

    public function getBusiness($uid,$bid) {
        return DI()->notorm->business
            ->select('bid','uid','sign','assess','status')
            ->where('uid', $uid)->where('bid', $bid)
            ->fetchRow();
    }

    public function getBusinessSign($bid) {
        return DI()->notorm->business_sign
            ->where('bid', $bid)
            ->fetchRow();
    }

    public function putBusinessSign($uid,$bid,$sign_money,$post) {
        $rs = DI()->notorm->business_sign->select('bid')->where('uid', $uid)->where('bid', $bid)->fetchRow();
        if(!$rs){
            $data = array(
                'uid' => $uid,
                'bid' => $bid,
                'money' => $sign_money,
                'create_dt' => date("Y-m-d H:i:s")
            );
            DI()->notorm->business_sign->insert($data);
        }
        $rs = DI()->notorm->business_sign->where('uid', $uid)->where('bid', $bid)->update($post);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getBusinessAssess($bid) {
        return DI()->notorm->business_assess
            ->where('bid', $bid)
            ->fetchRow();
    }

    public function putBusinessAssess($uid,$bid,$post) {
        $rs = DI()->notorm->business_assess->select('bid')->where('uid', $uid)->where('bid', $bid)->fetchRow();
        if(!$rs){
            $data = array(
                'uid' => $uid,
                'bid' => $bid,
                'create_dt' => date("Y-m-d H:i:s")
            );
            DI()->notorm->business_assess->insert($data);
        }
        $rs = DI()->notorm->business_assess->where('uid', $uid)->where('bid', $bid)->update($post);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getBusinessList($page,$count,$uid,$day,$error) {
        $sql = "select a.*,b.status as sign_status,c.status as assess_status from pa_business as a LEFT JOIN pa_business_sign as b ON a.bid = b.bid LEFT JOIN pa_business_assess as c ON a.bid = c.bid where a.status != 0 ";
        if($uid){
            $sql .= "and a.uid = :uid ";
        }
        if($day){
            $day = date("Y-m-d",strtotime("-$day day"));
            $sql .= "and a.create_dt >= :day ";
        }
        if($error){
            $sql .= "and (b.status = 3 or c.status = 2 or c.status = 4) ";
        }
        $sql .= "order by a.create_dt desc limit :page,:count";
        $params = array(':uid' => $uid, ':page' => ($page-1)*$count, ':count' => $count, ':day' => $day);
        return $this->getORM()->queryRows($sql, $params);
    }

    public function getBusinessCount($uid,$day,$error) {
        $sql = "select count(*) as count from pa_business as a LEFT JOIN pa_business_sign as b ON a.bid = b.bid LEFT JOIN pa_business_assess as c ON a.bid = c.bid where a.status != 0 ";
        if($uid){
            $sql .= "and a.uid = :uid ";
        }
        if($day){
            $day = date("Y-m-d",strtotime("-$day day"));
            $sql .= "and a.create_dt >= :day ";
        }
        if($error){
            $sql .= "and (b.status = 3 or c.status = 2 or c.status = 4) ";
        }
        $params = array(':uid' => $uid, ':day' => $day);
        $res = $this->getORM()->queryAll($sql, $params);
        return $res[0]['count'];
    }

    public function putBusinessStatus($uid,$bid,$post) {
        $rs = DI()->notorm->business->where('uid', $uid)->where('bid', $bid)->update($post);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function putSignBusinessStatus($uid,$bid,$post) {
        $rs = DI()->notorm->business_sign->where('uid', $uid)->where('bid', $bid)->update($post);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function putAssessBusinessStatus($uid,$bid,$post) {
        $rs = DI()->notorm->business_assess->where('uid', $uid)->where('bid', $bid)->update($post);
        if ($rs === false) {
            return false;
        }
        return true;
    }

    public function getCommonValue($common_key) {
        $sql = "select common_value from la_common WHERE common_key = :common_key";
        $params = array(':common_key' => $common_key);
        return $this->getORM()->queryRows($sql, $params);
    }
}
