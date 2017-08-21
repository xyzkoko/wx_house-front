<?php
session_start();
$url='http://www.allwinits.com/web/main.php';
$configUrl='http://www.allwinits.com/?service=WeiChat.GetWebConfig&url='.urlencode($url);
$data = file_get_contents($configUrl);
$signPackage = json_decode($data,true);
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>主页面</title>

    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript" src="js/common.js?v=1.0298"></script>
	  <script type="text/javascript" src="js/main.js?v=1.0224"></script>
    <link rel="stylesheet" href="css/jquery-labelauty.css">
    <link rel="stylesheet" href="css/boostramp.min.css">
  <style>
    
		.ta_c{text-align: center}

@-webkit-keyframes rotation{
from {-webkit-transform: rotate(0deg);}
to {-webkit-transform: rotate(360deg);}
}

.Rotation{
-webkit-transform: rotate(360deg);
animation: rotation 3s ease-in-out infinite;
-moz-animation: rotation 3s ease-in-out infinite;
-webkit-animation: rotation 3s ease-in-out infinite;
-o-animation: rotation 3s ease-in-out infinite;
}


@keyframes tipAni
{
	0%   {opacity:1;}
	25%  {opacity:0.8;}
	50%  {opacity:0.4;}
	100% {opacity:0.8;}
}

@-moz-keyframes tipAni /* Firefox */
{
	0%   {opacity:1;}
	25%  {opacity:0.6;}
	50%  {opacity:0.2;}
	75%  {opacity:0.6;}
	100% {opacity:1;}
}

@-webkit-keyframes tipAni /* Safari and Chrome */
{
	0%   {opacity:1;}
	25%  {opacity:0.6;}
	50%  {opacity:0.2;}
	75%  {opacity:0.6;}
	100% {opacity:1;}
}

@-o-keyframes tipAni /* Opera */
{
	0%   {opacity:1;}
	25%  {opacity:0.6;}
	50%  {opacity:0.2;}
	75%  {opacity:0.6;}
	100% {opacity:1;}
}

#tip{
	animation: tipAni 3s ease infinite;
-moz-animation: tipAni 3s ease infinite;
-webkit-animation: tipAni 3s ease infinite;
-o-animation: tipAni 3s ease infinite;
}

    </style>
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
    </script>

</head>
<body style='overflow:-Scroll;overflow-x:hidden'>
<div id = "tuijian"  hidden= "hidden" class="col-sm-12 col-xs-12" >
  <div class="col-sm-12  col-xs-12" onClick = "TuiJian()">
 
	<span style = "color:red" class="glyphicon glyphicon-arrow-left"></span>     
  </div>

 <p class="col-sm-12 col-xs-12" style = "text-align:center;font-size:20px">推荐送积分</p>
 <div class="col-sm-12 col-xs-12">
 <p style = "color:red">说明：成功推荐一位好友送20积分</p>
  <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
 <b class="col-sm-12 col-xs-12" style = "text-align:center">step1<br/>推荐博文公众号给好友</b>
 <image src = "./images/gzh.png" style = "width:95%;margin:10px"></image>
  <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  <b class="col-sm-12 col-xs-12" style = "text-align:center">step2<br/>好友绑定手机，输入推荐手机号码</b>
 <image src = "./images/gzh1.png" style = "width:95%;margin:10px"></image>
  <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
 </div>
</div>
<div id = "content">
<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:fixed;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:fixed" id = "showTip" ></div>
<div style = "background-color:#258ee7;margin-bottom:30px" class = "col-sm-12 col-xs-12" >

    <img id = "imagePhoto" src="images/tjzp.jpg" style = "width:100px;height:100px;margin-top:20px;margin-bottom:20px" class="img-circle center-block">
    <p id = "pName" style= "text-align:center;color:#ffffff;font-size:30px;font-family: Microsoft Yahei">博文</p>
</div>
<div class = "col-sm-12 col-xs-12">
     <div class="col-sm-12 col-xs-12    " style = "margin-bottom:20px">
	 
	 
      <span  onClick = "myYewu()" style = "text-align:right;font-size:20px" class=" pull-right label label-primary">我的业务</span>
	   <span    id = 'tip' type="button"  style = "display:none;margin-right:10px;font-size:20px;text-align:right" class="pull-right label label-danger">我的通知</span>
    </div>
    <div class="col-sm-12 col-xs-12    " style = "margin-bottom:20px">
	
	  <span type="button" onClick = "Sign()" style = "font-size:20px;text-align:right" class="pull-right label label-success">每日签到</span>
      <span type="button" onClick = "TuiJian()" style = "margin-right:10px;font-size:20px;text-align:right" class="pull-right label label-success">推荐送积分</span>
    
    </div>

    <div class="col-sm-12 col-xs-12" style = "margin-bottom:20px">

    <button  type="button" style= "font-size:20px" onClick= "ChangeUrl(0)" class="btn btn-default btn-lg col-sm-12 col-xs-12">网签/评估报告</button>
   
   </div>
    <div hidden = "hidden" class="col-sm-12 col-xs-12" style = "margin-bottom:20px">

    <button  type="button" style= "font-size:20px" onClick= "ChangeUrl(1)" class="btn btn-default btn-lg col-sm-12 col-xs-12">后期业务</button>
   
   </div>
     <div class="col-sm-6 col-xs-6" style = "margin-bottom:20px">

    <button  type="button" style= "font-size:20px" onClick= "ChangeUrl(2)" class="btn btn-default btn-lg col-sm-12 col-xs-12">用户绑定</button>
   
   </div>
     <div class="col-sm-6 col-xs-6" style = "margin-bottom:20px">

    <button  type="button" style= "font-size:20px" onClick= "ChangeUrl(3)" class="btn btn-default btn-lg col-sm-12 col-xs-12">个人信息</button>
   
   </div>
    <div   class="col-sm-12 col-xs-12" style = "margin-bottom:20px">

    <button  type="button" style= "font-size:20px" onClick= "ChangeUrl(4)" class="btn btn-default btn-lg col-sm-12 col-xs-12">帮助</button>
   
   </div>
   <div class="col-sm-12 col-xs-12" style = "text-align:center;margin-bottom:20px">
   
    
	  <a class="col-sm-12 col-xs-12" style = "color:#333; font-size:18px; border-color: #ccc; border-style:solid; border-width:1px;border-radius:6px;padding:8px;text-decoration:none" href="tel:13625572670"> 
    <span style = "font-size:18px" class="glyphicon glyphicon-earphone"></span> 客服热线</a>

   </div>
 
</div>
</div>
<script>

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
   
   console.info("height = ", height);
console.info('height=', height)
var width = document.body.clientWidth ;
$('#showTipBk').width(width+ 'px');
$('#showTipBk').height(height +'px');
</script>
</body>
</html>