<?php
/**
 * 业务接口类
 *
 * @author: Sirius
 */

class Api_Business extends PhalApi_Api {

    public function getRules() {
        return array(
            'postBusiness' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '业务id'),
                'sign' 	=> array('name' => 'sign','type' => 'enum','range' => array('0', '1'), 'require' => false,'source' => 'post', 'desc' => '是否上传网签 0不上传 1上传' ),
                'assess' 	=> array('name' => 'assess','type' => 'enum','range' => array('0', '1'), 'require' => false,'source' => 'post', 'desc' => '是否上传评估报告 0不上传 1上传' )
            ),
            'getBusinessSign' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id')
            ),
            'putBusinessSign' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id'),
                'seller_name' 	=> array('name' => 'seller_name','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卖方姓名'),
                'seller_mobile' 	=> array('name' => 'seller_mobile','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卖方电话'),
                'seller_ID' 	=> array('name' => 'seller_ID','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卖方身份证号'),
                'seller_ID1_photo' 	=> array('name' => 'seller_ID1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卖方身份证号正面照'),
                'seller_ID2_photo' 	=> array('name' => 'seller_ID2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卖方身份证号反面照'),
                'buyer_name' 	=> array('name' => 'buyer_name','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '买方姓名'),
                'buyer_mobile' 	=> array('name' => 'buyer_mobile','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '买方电话'),
                'buyer_ID' 	=> array('name' => 'buyer_ID','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '买方身份证号'),
                'buyer_ID1_photo' 	=> array('name' => 'buyer_ID1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '买方身份证号正面照'),
                'buyer_ID2_photo' 	=> array('name' => 'buyer_ID2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '买方身份证号反面照'),
                'business_price' 	=> array('name' => 'business_price','type' => 'float', 'require' => false,'source' => 'post', 'desc' => '交易信息-成交价'),
                'business_loan' 	=> array('name' => 'business_loan','type' => 'float', 'require' => false,'source' => 'post', 'desc' => '交易信息-商贷金额'),
                'business_fund' 	=> array('name' => 'business_fund','type' => 'float', 'require' => false,'source' => 'post', 'desc' => '交易信息-公积金贷款金额'),
                'business_photo' 	=> array('name' => 'business_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '交易信息-买卖合同'),
                'hou_address' 	=> array('name' => 'houes_address','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-房产地址'),
                'house_prove1_photo' 	=> array('name' => 'house_prove1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-房产证扫描件1'),
                'house_prove2_photo' 	=> array('name' => 'house_prove2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-房产证扫描件2'),
                'house_prove3_photo' 	=> array('name' => 'house_prove3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-房产证扫描件3'),
                'house_prove4_photo' 	=> array('name' => 'house_prove4_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-房产证扫描件4'),
                'house_fund_photo' 	=> array('name' => 'house_fund_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-维修基金发票扫描件'),
                'house_prove_photo' 	=> array('name' => 'house_prove_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '其他信息-购房证明扫描件')
            ),
            'getBusinessAssess' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id')
            ),
            'putBusinessAssess' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id'),
                'bank_name' 	=> array('name' => 'bank_name','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '报告使用银行'),
                'house_out1_photo' 	=> array('name' => 'house_out1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '房屋外部照片1'),
                'house_out2_photo' 	=> array('name' => 'house_out2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '房屋外部照片2'),
                'house_out3_photo' 	=> array('name' => 'house_out3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '房屋外部照片3'),
                'house_out4_photo' 	=> array('name' => 'house_out4_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '房屋外部照片4'),
                'house_bedroom1_photo' 	=> array('name' => 'house_bedroom1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卧室照片1'),
                'house_bedroom2_photo' 	=> array('name' => 'house_bedroom2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卧室照片2'),
                'house_bedroom3_photo' 	=> array('name' => 'housese_bedroom3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卧室照片3'),
                'house_living1_photo' 	=> array('name' => 'house_living1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '客厅照片1'),
                'house_living2_photo' 	=> array('name' => 'house_living2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '客厅照片2'),
                'house_living3_photo' 	=> array('name' => 'house_living3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '客厅照片3'),
                'house_kitchen1_photo' 	=> array('name' => 'house_kitchen1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '厨房照片1'),
                'house_kitchen2_photo' 	=> array('name' => 'house_kitchen2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '厨房照片2'),
                'house_kitchen3_photo' 	=> array('name' => 'house_kitchen3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '厨房照片3'),
                'house_toilet1_photo' 	=> array('name' => 'house_toilet1_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卫生间照片1'),
                'house_toilet2_photo' 	=> array('name' => 'house_toilet2_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卫生间照片2'),
                'house_toilet3_photo' 	=> array('name' => 'house_toilet3_photo','type' => 'string', 'require' => false,'source' => 'post', 'desc' => '卫生间照片3')
            ),
            'getBusinessList' => array(
                'page' 	=> array('name' => 'page','type' => 'int', 'default' => 1, 'min' => 1, 'source' => 'post', 'desc' => '当前页数 不传默认为1'),
                'count' => array('name' => 'count','type' => 'int','default' => 10, 'min' => 1, 'source' => 'post', 'desc' => '每页显示数量 不传默认为10'),
                'uid' 	=> array('name' => 'uid','type' => 'enum','range' => array(0, 1),'default' => 0, 'source' => 'post', 'desc' => '0 查询所有业务记录 1 查询自己的业务记录'),
                'day' 	=> array('name' => 'day','default' => 0, 'source' => 'post', 'desc' => '查询最近时间内业务单位天，不填不限时'),
                'error' => array('name' => 'error','default' => 0,'type' => 'enum','range' => array(0, 1), 'source' => 'post', 'desc' => '是否显示未完成的接口')
            ),
            'getBusinessCount' => array(
                'uid' 	=> array('name' => 'uid','type' => 'enum','range' => array(0, 1),'default' => 0, 'source' => 'post', 'desc' => '0 查询所有业务数量 1 查询自己的业务数量'),
                'day' 	=> array('name' => 'day','default' => 0, 'source' => 'post', 'desc' => '查询最近时间内业务单位天，不填不限时'),
                'error' => array('name' => 'error','default' => 0,'type' => 'enum','range' => array(0, 1), 'source' => 'post', 'desc' => '是否显示未完成的接口')
            ),
            'postBusinessStatus' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id'),
                'type' 	=> array('name' => 'type','type' => 'enum','range' => array(1,2,3), 'require' => true,'source' => 'post', 'desc' => '派送方式 1 自取 2 统一派送银行 3 快递'),
                'address' 	=> array('name' => 'address','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '姓名;电话;派送位置'),
                'isAgency' 	=> array('name' => 'isAgency','type' => 'enum','range' => array(0,1), 'require' => true,'source' => 'post', 'desc' => '是否代办 0 不代办 1 代办')
            ),
            'testWxPay' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id')
            ),
            'testWxPay2' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id')
            ),
            'deleteAssessBusiness' => array(
                'bid' 	=> array('name' => 'bid','type' => 'string', 'require' => true,'source' => 'post', 'desc' => '业务id')
            )
        );
    }

    /**
     * 查询/提交/修改业务
     * @desc 1.只传业务d返回当前业务详情 2.传业务id和其他内容修改当前业务 3.不传业务id创建新业务
     * @return int code 接口状态 0 成功 1 用户不存在 2 角色未审核
     * @return string error 错误提示信息
     * @return string bid 当前业务id
     * @return string sign 是否有网签
     * @return string assess 是否有评估报告
     * @return string status 业务状态 0未提交 1受理中 2物流配送 3业务成功 4业务取消
     */
    public function postBusiness() {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = isset($_POST['bid'])?$_POST['bid']:0;
        $sign = isset($_POST['sign'])?$_POST['sign']:0;
        $assess = isset($_POST['assess'])?$_POST['assess']:0;
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
            return $array;
        }else{
            $roleid =$userinfo['roleid'];       //用户角色
            $status = 0;
            if($roleid == 2){
                $domian = new Domain_Role();
                $roleinfo = $domian->getBrokerInfo($uid);
                $status = $roleinfo['status'];      //用户角色审核
            }
        }
        $domian = new Domain_Business();
        if(!$bid){   //新增
            if($roleid!=2 || $status!=2){
                $array['code'] = 2;
                $array['error'] = T('role not audit');
                return $array;
            }
            $res = $domian->postBusiness($uid,$_POST);
            $array['bid'] = $res;
        }elseif($sign||$assess){    //修改
            if($roleid!=2 || $status!=2){
                $array['code'] = 2;
                $array['error'] = T('role not audit');
                return $array;
            }
            $res = $domian->putBusiness($uid,$_POST);
            $array['bid'] = $res;
        }else{      //详情
            $res = $domian->getBusiness($uid,$bid);
            $array = array_merge($array,$res);
        }
        return $array;
    }

    /**
     * 提交业务(模拟支付接口)
     * @desc 提交业务和派送信息
     * @return int code 接口状态 0 成功 1 用户不存在 2 角色未审核 3 添加失败
     * @return string error 错误提示信息
     */
    public function postBusinessStatus() {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $businessinfo = $domian->getBusiness($uid,$bid);
        if(!$businessinfo){
            $array['code'] = 3;
            $array['error'] = T('add error');
            return $array;
        }
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
            return $array;
        }else{
            $roleid =$userinfo['roleid'];       //用户角色
            if($roleid == 2){
                $domian = new Domain_Role();
                $roleinfo = $domian->getBrokerInfo($uid);
                $status = $roleinfo['status'];      //用户角色审核
            }
            if($roleid!=2 || $status!=2){
                $array['code'] = 2;
                $array['error'] = T('role not audit');
                return $array;
            }
        }
        unset($_POST['bid']);
        //姓名;电话;地址
        $data = explode(';',$_POST['address']);
        $_POST['name'] = $data[0];
        $_POST['mobile'] = $data[1];
        $_POST['address'] = $data[2];
        $_POST['status'] = 1;
        $domian = new Domain_Business();
        $res = $domian->putBusinessStatus($uid,$bid,$_POST);
        if(!$res){
            $array['code'] = 3;
            $array['error'] = T('add error');
        }
        //TODO 模拟支付完成
        $domian->putSignBusinessStatus($uid,$bid,['status'=>1]);
        $domian->putAssessBusinessStatus($uid,$bid,['status'=>1]);
        return $array;
    }

    /**
     * 获取网签信息
     * @desc 根据业务id获取网签信息
     * @return int code 接口状态 0 成功 1 查询失败
     * @return string error 错误提示信息
     * @return string xxx 网签内容
     * @return string status 网签状态 0未提交 1已支付待审核 2已支付审核通过 3已支付审核失败 4业务取消已退款
     */
    public function getBusinessSign() {
        $array = array(
            'code' => 0
        );
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $res = $domian->getBusinessSign($bid);
        if(!$res){
            $array['code'] = 1;
            $array['error'] = T('get error');
        }
        $array = array_merge($array,$res);
        return $array;
    }

    /**
     * 提交网签
     * @desc 添加网签信息
     * @return int code 接口状态 0 成功 1 用户不存在 2 角色未审核 3 添加失败
     * @return string error 错误提示信息
     */
    public function putBusinessSign() {
        DI()->logger->info('putBusinessSign', array('uid' => $_SESSION['uid'], 'data' => $_POST));
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $businessinfo = $domian->getBusiness($uid,$bid);
        if(!$businessinfo['sign']){
            $array['code'] = 3;
            $array['error'] = T('add error');
            return $array;
        }
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
            return $array;
        }else{
            $roleid =$userinfo['roleid'];       //用户角色
            if($roleid == 2){
                $domian = new Domain_Role();
                $roleinfo = $domian->getBrokerInfo($uid);
                $status = $roleinfo['status'];      //用户角色审核
            }
            if($roleid!=2 || $status!=2){
                $array['code'] = 2;
                $array['error'] = T('role not audit');
                return $array;
            }
        }
        unset($_POST['bid']);
        foreach ($_POST as $key => $value){
            $photo = trim(strrchr($key, '_'),'_');
            if($photo == 'photo'){      //按照规范取参数名 判断上传的是否是图片信息
                $token = DI()->cache->get('token');
                if(!$token){
                    $api = new Api_WeiChat();
                    $api->getToken();
                }
                $domianWeichat = new Domain_WeiChat();
                $_POST[$key] = $domianWeichat->postImage($_POST[$key]);
            }
        }
        $domian = new Domain_Business();
        $result = $domian->getCommonValue('sign_money');    //获取网签金额
        $sign_money = $result[0]['common_value'];
        $res = $domian->putBusinessSign($uid,$bid,$sign_money,$_POST);
        if(!$res){
            $array['code'] = 3;
            $array['error'] = T('add error');
        }
        return $array;
    }

    /**
     * 获取评估报告信息
     * @desc 根据业务id获取网签信息
     * @return int code 接口状态 0 成功 1 查询失败
     * @return string error 错误提示信息
     * @return string xxx 评估内容
     * @return string status 评估状态 0未提交 1待审核 2待支付 3支付成功 4审核失败 5业务取消
     */
    public function getBusinessAssess() {
        $array = array(
            'code' => 0
        );
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $res = $domian->getBusinessAssess($bid);
        if(!$res){
            $array['code'] = 1;
            $array['error'] = T('get error');
        }
        $array = array_merge($array,$res);
        return $array;
    }

    /**
     * 提交评估报告
     * @desc 添加评估报告信息
     * @return int code 接口状态 0 成功 1 用户不存在 2 角色未审核 3 添加失败
     * @return string error 错误提示信息
     */
    public function putBusinessAssess() {
        DI()->logger->info('putBusinessAssess', array('uid' => $_SESSION['uid'], 'data' => $_POST));
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $businessinfo = $domian->getBusiness($uid,$bid);
        if(!$businessinfo['assess']){
            $array['code'] = 3;
            $array['error'] = T('add error');
            return $array;
        }
        $domian = new Domain_User();
        $userinfo = $domian->getUserInfo($uid);
        if(!$userinfo){
            $array['code'] = 1;
            $array['error'] = T('user not exists');
            return $array;
        }else{
            $roleid =$userinfo['roleid'];       //用户角色
            if($roleid == 2){
                $domian = new Domain_Role();
                $roleinfo = $domian->getBrokerInfo($uid);
                $status = $roleinfo['status'];      //用户角色审核
            }
            if($roleid!=2 || $status!=2){
                $array['code'] = 2;
                $array['error'] = T('role not audit');
                return $array;
            }
        }
        unset($_POST['bid']);
        foreach ($_POST as $key => $value){
            $photo = trim(strrchr($key, '_'),'_');
            if($photo == 'photo'){      //按照规范取参数名 判断上传的是否是图片信息
                $token = DI()->cache->get('token');
                if(!$token){
                    $api = new Api_WeiChat();
                    $api->getToken();
                }
                $domianWeichat = new Domain_WeiChat();
                $_POST[$key] = $domianWeichat->postImage($_POST[$key]);
            }
        }
        $domian = new Domain_Business();
        $res = $domian->putBusinessAssess($uid,$bid,$_POST);
        if(!$res){
            $array['code'] = 3;
            $array['error'] = T('add error');
        }
        return $array;
    }

    /**
     * 业务列表接口
     * @desc 获取所有（自己发布的）业务列表
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     * @return string bid 业务id
     * @return string uid 发布者id
     * @return string sign 是否发布网签 0未发布 1发布
     * @return string assess 是否发布评估报告 0未发布 1发布
     * @return string type 派送方式
     * @return string name 收件人
     * @return string mobile 收件人电话
     * @return string address 收件人地址
     * @return string isAgency 是否代办 0 不代办 1 代办
     * @return string status 业务状态 0未提交 1受理中 2物流配送 3业务成功 4业务取消
     * @return string sign_status 网签状态 0未提交 1已支付待审核 2已支付审核通过 3已支付审核失败 4业务取消已退款
     * @return string assess_status 评估状态 0未提交 1待审核 2待支付 3支付成功 4审核失败 5业务取消
     * @return string create_dt 发布时间
     */
    public function getBusinessList()
    {
        $array = array(
            'code' => 0
        );
        if($this->uid){
            $this->uid = $_SESSION['uid'];
        }
        $domian = new Domain_Business();
        $res = $domian->getBusinessList($this->page,$this->count,$this->uid,$this->day,$this->error);
        $array = array_merge($array,$res);
        return $array;
    }

    /**
     * 业务总数接口
     * @desc 获取所有（自己发布的）业务总数
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     * @return string count 数据总数
     */
    public function getBusinessCount()
    {
        $array = array(
            'code' => 0
        );
        if($this->uid){
            $this->uid = $_SESSION['uid'];
        }
        $domian = new Domain_Business();
        $res = $domian->getBusinessCount($this->uid,$this->day,$this->error);
        $array['count'] = $res;
        return $array;
    }

    /**
     * 放弃评估业务
     * @desc 模拟网签报告退款 取消业务
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     */
    public function deleteAssessBusiness()
    {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $domian->putAssessBusinessStatus($uid,$bid,['status'=>5]);
        return $array;
    }

    /**
     * 模拟评估报告支付
     * @desc 模拟评估报告支付成功
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     */
    public function testWxPay()
    {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $domian->putAssessBusinessStatus($uid,$bid,3);
        return $array;
    }

    /**
     * 模拟网签报告退款 取消业务
     * @desc 模拟网签报告退款 取消业务
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     */
    public function testWxPay2()
    {
        $array = array(
            'code' => 0
        );
        $uid = $_SESSION['uid'];
        $bid = $_POST['bid'];
        $domian = new Domain_Business();
        $domian->putBusinessStatus($uid,$bid,['status'=>4]);
        $domian->putSignBusinessStatus($uid,$bid,['status'=>4]);
        $domian->putAssessBusinessStatus($uid,$bid,['status'=>5]);
        return $array;
    }

}


