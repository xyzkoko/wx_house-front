<?php
session_start();
$url='http://www.allwinits.com/web/register.php';
$configUrl='http://www.allwinits.com/?service=WeiChat.GetWebConfig&url='.urlencode($url);
$data = file_get_contents($configUrl);
$signPackage = json_decode($data,true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户绑定</title>

    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/common.js?v=1.02665"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript" src="js/apply.js?v=1.039"></script>
    <link rel="stylesheet" href="css/jquery-labelauty.css">
    <link rel="stylesheet" href="css/boostramp.min.css">

    <style>
        ul { list-style-type: none;}
        li { display: inline-block;}
        li { margin: 14px 14px;}
        input.labelauty + label { font: 15px "Microsoft Yahei"; color:#000000;padding:20px}
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
<body>

	

<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:absolute;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:absolute" id = "showTip" ></div>
<div style = "background-color:#258ee7;margin-bottom:30px" class = "col-sm-12" >

 <img id = "imagePhoto" src="" style = "width:128px;height:128px;margin-top:40px;margin-bottom:20px" class="img-circle center-block">
 <p id = "pName" style= "text-align:center;color:#ffffff;font-size:40px;font-family: Microsoft Yahei"></p>
</div>


 <div class="col-sm-10 col-xs-12 col-sm-offset-1" style = "margin-bottom:20px">
   
         <div class="col-sm-1 col-xs-2 ">
		  <span class="glyphicon glyphicon-phone  " style = "top:20px;color:red"></span>
		 </div>
		<div class="col-sm-11 col-xs-10">
			<input id = "yanzheng_phone" style = "height:70px; font-size:32px"  onkeyup="this.value=this.value.replace(/\D/g,'')"  type="number" class="form-control" id="firstname" 
				   placeholder="请输入手机号码">
		</div>
	</div>
	
	 <div class="col-sm-10 col-xs-12 col-sm-offset-1" style = "margin-bottom:20px">
   
         <div class="col-sm-1  col-xs-2">
		  <span class="glyphicon glyphicon-envelope  " style = "top:20px; color:red"></span>
		 </div>
		<div class="col-sm-9 col-xs-7">
			<input id = "yanzheng_code" onkeyup="this.value=this.value.replace(/\D/g,'')" style = "height:70px; font-size:32px" type="number" class="form-control" id="firstname" 
				   placeholder="请输验证码">
		</div>
		<div class = "col-sm-2 col-xs-3">
			<input style = "height:70px; font-size:16px;border-radius:0px;border-color:#e0d3d3" onclick="getMessage()"  value = "获取验证码" id = 'phoneMessage' type="button" class=" col-sm-12 col-xs-12">
        </div>
		
	</div>
	
	 <div class="col-sm-10 col-xs-12 col-sm-offset-1" style = "margin-bottom:20px">
   
         <div class="col-sm-1  col-xs-2">
		   <span class="glyphicon glyphicon-thumbs-up" style = "top:20px; color:red"></span>
		 </div>
		<div class="col-sm-11 col-xs-10">
			<input id = "friend_code" onkeyup="this.value=this.value.replace(/\D/g,'')" style = "height:70px; font-size:32px" type="number" class="form-control" id="firstname" 
				   placeholder="推荐好友绑定手机号码(没有则不填)">
		</div>
		
	</div>
	
	 <div hidden = "hidden" class="col-sm-10 col-xs-12 col-sm-offset-1" style = "margin-bottom:20px">
	 <div class="col-sm-1 col-xs-2">
		  <span class="glyphicon glyphicon-asterisk" style = "color:red"></span>
		 </div>
	 <p style="color:#565353;font-size:30px" class = "col-sm-10 col-xs-10">请选择会员类型:</p>

	 <div  class="col-sm-11  col-sm-offset-1">
	<ul class="dowebok">
	<li><input type="radio" class = "choice huyuan col-sm-4 col-xs-3" name="radio" id = "yhhy"  data-labelauty="银行会员"></li>
	<li><input type="radio" class = "choice huyuan col-sm-4 col-xs-3"  name="radio" id = "zjhy" data-labelauty="中介会员"></li>
	<li><input type="radio" class = "choice huyuan col-sm-4 col-xs-3"  name="radio" id = "hqsjhy"  data-labelauty="后期商家会员"></li>
	</div>
    </ul>
		
	</div>

	
	
	
	
	

<div id = "addApeend"class = 'col-sm-12'>
	</div>
	<div class = "col-sm-12">

 <hr style = "border-top: 2px solid #cce">
</div>
	 <div class="col-sm-12 col-xs-12" style = "margin-bottom:20px">
	
	<button  type="button" onclick = "playerRegister()" style= "font-size:40px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7" class="btn col-sm-12 col-xs-12">绑&nbsp&nbsp&nbsp&nbsp定</button>
	<p style = "    padding-top: 100px;font-size:26px;color:#848181;text-align:center">版权所有：青岛博文公司</p>
	</div>
	
	
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	
<script type="text/javascript" src="js/jquery-labelauty.js"></script>

<script>	

 
function getValue(obj)
{
   console.info(obj)
}



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