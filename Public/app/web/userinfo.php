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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>个人信息</title>

    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript" src="js/common.js?v=1.1"></script>
	  <script type="text/javascript" src="js/userInfo.js?v=1.241"></script>
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
<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:fixed;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:fixed" id = "showTip" ></div>
<div style = "background-color:#258ee7;margin-bottom:30px" class = "col-sm-12 col-xs-12" >

    <img id = "imagePhoto" src="images/tjzp.jpg" style = "width:100px;height:100px;margin-top:20px;margin-bottom:20px" class="img-circle center-block">
    <p id = "pName" style= "text-align:center;color:#ffffff;font-size:30px;font-family: Microsoft Yahei"></p>
</div>
<div class = "col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style = "font-size:18px" class="table table-striped table-bordered"">
        <caption style = "color:#101010">个人信息</caption>

        <tbody>
        <tr>
            <td style = "text-align:center;width:30%">ID</td>
            <td style = "text-align:right"></td>

        <tr>
        <tr>
            <td style = "text-align:center;width:30%">会&nbsp员&nbsp类&nbsp型</td>
            <td style = "text-align:right"></td>
        <tr>
        <tr>
            <td style = "text-align:center;width:30%">电&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp话</td>
            <td style = "text-align:right"></td>
        <tr>
        <tr>
            <td style = "text-align:center;width:30%">会&nbsp员&nbsp等&nbsp级</td>
            <td style = "text-align:right;color:white"><span class="label label-warning">V1</span></td>
        <tr>
        <tr>
            <td style = "text-align:center;width:30%">剩&nbsp余&nbsp积&nbsp分</td>
            <td style = "text-align:right"></td>
        <tr>
        <tr>
            <td style = "text-align:center;width:30%">个&nbsp人&nbsp状&nbsp态</td>
            <td id = "shenheResult" style = "text-align:right"></td>
        <tr>
        </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <table style = "font-size:18px" id = "tableYeWu" onClick = "ShowYewu()" class="table table-striped ">


            <tbody>

            <tr style = "padding-bottom:30px">
                <td style = "text-align:center;width:30%">最&nbsp近&nbsp交&nbsp易</td>
                <td style = "text-align:right">
                    <span class="glyphicon glyphicon-chevron-right" style = "color:#906b6b"></span>
                </td>
            <tr>

            </tbody>
        </table>
		<div id = "yewuInfoDiv">
	           
         </div>
	 <table style = "font-size:18px"  onClick = "ShowInfo()" class="table table-striped ">


            <tbody>
            <tr style = "padding-bottom:30px" >
                <td style = "text-align:center;width:30%">详&nbsp细&nbsp信&nbsp息</td>
                <td style = "text-align:right">
                    <span class="glyphicon glyphicon-chevron-right" style = "color:#906b6b"></span>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
	</div>
	<div id = 'xiangxiInfoDiv' hidden = "hidden" class = 'col-sm-12 col-xs-12' style = "padding-left:0px">
  <p class = 'col-sm-2 col-sm-offset-2'>营业执照：</p>  
 
  <img  id = 'yyzz_img' src = 'images/tjzp.jpg' onClick = 'showBigImage(this, this.src, 0.8, 0.7)' class = 'col-sm-2 col-sm-offset-2' style = 'width:120px;height:120px'></img>
  	<div class = "col-sm-12">

 <hr style = "border-top: 2px solid #cce">
</div>
  <p class = 'col-sm-2 col-sm-offset-2'>门头照片：</p>  
 
  <img  id = 'mt_img' src = 'images/tjzp.jpg' onClick = 'showBigImage(this, this.src, 0.8, 0.7)'  class = 'col-sm-2 col-sm-offset-2' style = 'width:120px;height:120px'></img>
  	<div class = "col-sm-12">

 <hr style = "border-top: 2px solid #cce">
</div>
    <p id = "yy_address" class = 'col-sm-10 '>营业地址：</p> 
	<div class = "col-sm-12">

 <hr style = "border-top: 2px solid #cce">
</div>	
</div>
</div>
<div class="col-sm-12 col-xs-12" style = "margin-bottom:20px;margin-top:20px">

    <button  type="button" style= "font-size:20px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7" onClick= "ChangeUrl()" class="btn col-sm-12 col-xs-12">信息认证</button>
  
</div>
<div class="col-sm-12 col-xs-12" style = "margin-bottom:20px;margin-top:20px">

   
    <p style = "    padding-top: 15px;font-size:20px;color:#848181;text-align:center">版权所有：xx公司</p>
</div>
<script>
var a = {a:1,b:2};

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