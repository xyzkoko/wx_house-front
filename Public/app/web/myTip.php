
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

	 
	
<script type="text/javascript" src="js/jquery-labelauty.js"></script>
	
</head>
<body style='overflow:-Scroll;overflow-x:hidden' >

<div style = "background-color: rgb(19, 18, 18);display:none;opacity: 0.6;position:fixed;z-index:1111;width:0px; height:0px" id = "showTipBk" ></div>
<div style = "z-index:1112;position:fixed" id = "showTip" ></div>
<div style = "background-color:#258ee7;margin-bottom:10px" class = "col-sm-12 col-xs-12" >

    <img id = "imagePhoto" src="images/tjzp.jpg" style = "width:100px;height:100px;margin-top:20px;margin-bottom:20px" class="img-circle center-block">
    <p id = "pName" style= "text-align:center;color:#ffffff;font-size:20px;font-family: Microsoft Yahei">博文</p>
</div>

  
  <div class="col-sm-12 col-xs-12 " style="margin-bottom:2px">
      <div class="col-sm-12 col-xs-12 ">
	  <p  style = "text-align:center;margin-left:4px;margin-top:10px;margin-right:10px;color:blue ;font-size:20px">待处理业务</p>
	  </div>
	  <div hidden = "hidden" style="font-size:22px" class="btn-group  col-sm-8 col-xs-8 col-sm-offset-2 col-xs-offset-2">    
	    <button style = "width:100%" type="button" class="btn btn-primary dropdown-toggle" id="dropdown-yh" data-toggle="dropdown"> 最近一周        
		  <span class="caret"></span>   
		</button>   
     		<ul class="dropdown-menu" role="menu" style = "width:100%">        
			 <li style = "width:100%;text-align:center;font-size:24px;margin:0" onclick="datechoice(this)">最近一周</li> 
<hr style = "margin:10px 0px">			 
			 <li style = "width:100%;text-align:center;font-size:24px;margin:0" onclick="datechoice(this)">最近一月</li>       
<hr style = "margin:10px 0px">				 
			 <li style = "width:100%;text-align:center;font-size:24px;margin:0" onclick="datechoice(this)">最近三月</li>  
<hr style = "margin:10px 0px">			 
			 <li style = "width:100%;text-align:center;font-size:24px;margin:0" onclick="datechoice(this)">最近半年</li>  
<hr style = "margin:10px 0px">			 
			 <li style = "width:100%;text-align:center;font-size:24px;margin:0" onclick="datechoice(this)">最近一年</li>   
			 </ul>
	  </div>
	 
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  <div id = "myYeWu" class = "myYeWu" class="col-sm-12 col-xs-12 ">
  
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