
<?php
session_start();
$url='http://www.allwinits.com/web/changeInfo.php';
$configUrl='http://www.allwinits.com/?service=WeiChat.GetWebConfig&url='.urlencode($url);
$data = file_get_contents($configUrl);
$signPackage = json_decode($data,true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>完善/修改信息</title>
	 
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=c5yjfmfbHZ7CuAIAeEthxaOr2v9rfUHX"></script>   
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<link rel="stylesheet" href="css/jquery-labelauty.css">
   <link rel="stylesheet" href="css/boostramp.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/common.js?v=1.0260"></script>
	<script type="text/javascript" src="js/changeInfo.js?v=1.0268"></script>
	
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
    </style>
</head>
<body>

<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:absolute;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:absolute" id = "showTip" ></div>
<div id = "bdmap" hidden="hidden">
</div>
<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:absolute;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:absolute" id = "showTip" ></div>
<div class = 'col-sm-12'>
    <span class ='glyphicon glyphicon-asterisk col-sm-1' style = 'color:red; top:20px'></span>
	<p style = "top:12px; font-size:30px" class = 'col-sm-10'>初次完善/修改信息后完成审核即赠送30积分</p>
</div>

<div class="col-sm-12">

 <hr style="border-top: 2px solid #cce">
</div>
<div class = 'col-sm-12'>
  <p class = 'col-sm-2 col-sm-offset-2'>营业执照：</p>  
  <p class = 'float:left' style = 'color:rgb(0, 0, 255);padding-left:-10px'>示例</p>
  <img onclick='getImage(this, "yyzz_button")' id = 'yyzz_button' src = 'images/tjzp.jpg' class = 'col-sm-2 col-sm-offset-2';style = 'width:60px;height:60px'></img>
</div>
<hr class = 'col-sm-12' style = 'border-top: 2px solid #cce'>
<div class = 'col-sm-12'>
   <p class = 'col-sm-2 col-sm-offset-2'>门头照片：</p>  
   <p class = 'float:left' style = 'color:rgb(0, 0, 255);padding-left:-10px'>示例</p>
   <img onclick='getImage(this, "mtzp_button")' id = 'mtzp_button'  src = 'images/tjzp.jpg' class = 'col-sm-2 col-sm-offset-2';style = 'width:60px;height:60px'></img>
</div> 
<hr class = 'col-sm-12' style = 'border-top: 2px solid #cce'><div class='col-sm-12 ' style = 'margin-bottom:20px'>
<div class = 'col-sm-12' style = "margin-bottom:20px">
    <span class ='glyphicon glyphicon-asterisk col-sm-1' style = 'font-size:20px;color:red; top:20px;padding-right:0px;padding-left:0px'></span>
	<p style = "top:12px; font-size:24px" class = 'col-sm-10'>为提高审核通过的概率，务必填写真实的营业所在地</p>
</div>
<div class='col-sm-1'>
	 <span class='glyphicon glyphicon-map-marker' style = 'top:20px'></span>
</div>
<div class='col-sm-9'>
    <input id = "address" style = 'height:70px; font-size:24px' type='text' class='form-control' id='firstname' placeholder='请输入地址'>
</div>
<div class = 'col-sm-2'>
    <button style = 'height:70px; font-size:16px' type='button' onClick = "getPosition()" class='btn btn-default col-sm-12'>获取地址</button>
</div>
 <div class="col-sm-12 col-xs-12" style = "margin-bottom:20px;margin-top:40px">
	
	<button  type="button" onclick = "ChangeInfo()" style= "font-size:40px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7" class="btn col-sm-12 col-xs-12">提&nbsp&nbsp&nbsp&nbsp交</button>
	<p style = "    padding-top: 100px;font-size:26px;color:#848181;text-align:center">版权所有：xx公司</p>
	</div>
</div>

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
   
   console.info("height = ", height);
console.info('height=', height)
var width = document.body.clientWidth ;
$('#showTipBk').width(width+ 'px');
$('#showTipBk').height(height +'px');
		

	 
		
	 
</script>
</body>
</html>