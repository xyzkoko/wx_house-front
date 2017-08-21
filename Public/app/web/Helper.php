
<?php
session_start();
$url='http://www.allwinits.com/web/myYeWu.php';
$configUrl='http://www.allwinits.com/?service=WeiChat.GetWebConfig&url='.urlencode($url);
$data = file_get_contents($configUrl);
$signPackage = json_decode($data,true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>已办业务</title>
	
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

    <link rel="stylesheet" href="css/jquery-labelauty.css">
    <link rel="stylesheet" href="css/boostramp.min.css">
	 <script type="text/javascript" src="js/common.js?v=1.0226"></script>
	  <script type="text/javascript" src="js/myTip.js?v=1.0253"></script>
    
	
			

	 
	
<script type="text/javascript" src="js/jquery-labelauty.js"></script>
	
</head>
<body style='overflow:-Scroll;overflow-x:hidden' >
 <div style = "margin-top:20px">
  <p style= "font-size:30px;text-align:center">说明</p>
 </div>
 <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
 <div>
    <div class="col-sm-12 col-xs-12 ">
	   <p>一：积分</p>
	   <div class="col-sm-12 col-xs-12 ">
	   <p>（1）积分获取</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>新用户绑定成功获得10积分</li>
          <li>推荐好友成功总送10积分</li>
         <li>每日签到可以获得积分</li>
        </ul>
       </div>
	   </div>
	    <div class="col-sm-12 col-xs-12 ">
	   <p>（2）积分消耗</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>积分在办理网签和评估报告时可以用来支付费用</li>
          <li>每10个积分等价于1元人民币</li>
          <li>单独出具网签或同时出具网签和评估报告的，可以积分全额抵线。单独出具评估报告，不能使用积分抵线。</li>
        </ul>
       </div>
	   </div>
	   
	</div>
	<div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 1px solid #cce">
  </div>
     <div class="col-sm-12 col-xs-12 ">
	   <p>二：信息绑定和完善</p>
	   <div class="col-sm-12 col-xs-12 ">
	   <p>（1）信息绑定</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>输入手机号码</li>
          <li>输入验证短信码</li>
          <li>若有好友推荐，输入好友绑定手机号码。推荐人会收到积分奖励</li>
        </ul>
       </div>
	   </div>
	    <div class="col-sm-12 col-xs-12 ">
	   <p>（2）完善</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>只有完善后且审核通过的会员才能办理相关业务和优惠</li>
          <li>中介会员需要上传营业执照、门头照片和详细营业地址</li>
          <li>审核通过或者失败，我们将通过短信通知会员</li>
        </ul>
       </div>
	   </div>
	</div>
	<div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
	 <div class="col-sm-12 col-xs-12 ">
	   <p>三：业务办理</p>
	   <div class="col-sm-12 col-xs-12 ">
	   <p>（1）网签</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>会员享受半价优惠</li>
          <li>可以用积分抵扣人民币</li>
          <li>若同时办理网签和评估业务，若网签审核失败，将退还网签费用并且终止评估业务</li>
        </ul>
       </div>
	   </div>
	    <div class="col-sm-12 col-xs-12 ">
	   <p>（2）评估</p>
	   <div class="col-sm-12 col-xs-12 ">
         <ul class="col-sm-12 col-xs-12 ">
          <li>根据评估额进行收费</li>
          <li>评估成功后，请在48小时内付费确认</li>
          <li>若评估不能达成一致，可以选择单独发送网签业务</li>
        </ul>
       </div>
	   </div>
	</div>
	<div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  </div>
	<div style = "margin-top:20px">
  <p style= "font-size:20px;text-align:center">青岛博文享有最终解释权</p>
 </div>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	
<script type="text/javascript" src="js/jquery-labelauty.js"></script>

<script>

 
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage['data']["appId"];?>',
            timestamp: <?php echo $signPackage['data']["timestamp"];?>,
            nonceStr: '<?php echo $signPackage['data']["nonceStr"];?>',
            signature: '<?php echo $signPackage['data']["signature"];?>',
            jsApiList: [
                'onMenuShareAppMessage',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'openLocation',
                'getLocation'
            ]
        });
        wx.ready(function () {
            wx.onMenuShareAppMessage({
                title: '注册界面', // 分享标题
                desc: "测试", // 分享描述
                link:"http://www.allwinits.com/?service=WeiChat.Index&state=register",
                imgUrl: "分享图标的url,以http或https开头", // 分享图标
                type: 'link' // 分享类型,music、video或link，不填默认为link
            });
        });
    



function IsPC(){    
     var userAgentInfo = navigator.userAgent;  
     var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");    
     var flag = true;    
     for (var v = 0; v < Agents.length; v++) {    
         if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }    
     }    
     return flag;    
  } 
 var flag = IsPC();
if(!flag)
   var height = $(window).height();
else
   var height = $(document.body).outerWidth(true) + $(document).scrollTop();
var width = document.body.clientWidth ;
$('#showTipBk').width(width+ 'px');
$('#showTipBk').height(height +'px');
</script>
</body>
</html>