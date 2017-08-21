
<?php
session_start();
$url='http://www.allwinits.com/web/business.php';
$configUrl='http://www.allwinits.com/?service=WeiChat.GetWebConfig&url='.urlencode($url);
$data = file_get_contents($configUrl);
$signPackage = json_decode($data,true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>业务办理</title>
	
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

    <link rel="stylesheet" href="css/jquery-labelauty.css">
    <link rel="stylesheet" href="css/boostramp.min.css">
	 <script type="text/javascript" src="js/common.js?v=1.0225"></script>
	  <script type="text/javascript" src="js/bussiness.js?v=1.0240"></script>
    
	

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
<div id = "mainDiv"  >
<div class="row" style = "background-color:#258ee7;padding-bottom:20px;padding-top:20px">
 <p style = "text-align:center;color:white;margin-bottom:0px;font-size:30px" class  = "col-xs-12 col-xs-12">网签/评估服务</p>
</div>
<div class="row" style = "margin-top:30px">
<div class = "col-xs-2 col-sm-2" >
 <span style = "font-size:20px;text-align:right;margin-top: 7px;" class=" glyphicon glyphicon-tasks  col-xs-12 col-sm-12 "></span>
 </div>
 <div style = "padding:0px" class  = "col-xs-7 col-sm-7">
 <p  style = "font-size:24px;padding:0px;color: #258EE7">选择所需业务</p>
 </div>

</div>

<div class = "row">
<div id = "chujuwangqian" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "changeColor(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	出具网签
	</label>
</div>
<div style = "text-align:center;padding-top:10px"class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
<span style = "background-color: #948F8F;color: white;">原</span><span style="text-decoration:line-through;padding-left: 4px;padding-right:12px;color: #948F8F;">￥100</span>
<span style = "background-color: red;color: white;">会</span><span style="padding-left: 4px;color: red;">￥50</span>
</div>
</div>
<div class = "row" style = "padding-top:20px">
<div id = "chujupgbg" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "changeColor(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	出具评估报告
	</label>
</div>
<div style = "text-align:center;padding-top:10px"class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">

<span style = "background-color: red;color: white;">最低</span><span style="padding-left: 4px;color: red;">￥50</span>
</div>
</div>

<div class="col-sm-12 col-xs-12">

 <hr style="border-top: 2px solid #cce">
</div>

<div class = "col-xs-12 col-sm-12" style = "padding-top:18px">
<div class="panel panel-default">
    <div class="panel-body" style = "font-size:12px;color:#736e6e">
	<span style = "color:red; font-size:12px" class="glyphicon glyphicon-asterisk"></span>
       （说明:单独出具网签或者出具网签的同事出具评估报告的，可以积分全额抵现。若单独出具评估报告，则不能使用积分抵扣。特此说明）
    </div>
</div>
</div>

<div class="col-sm-12">

 <hr style="border-top: 2px solid #cce">
</div>

<div class="col-sm-8 col-xs-8  col-sm-offset-2 col-xs-offset-2">
<button id = "mainChioce" onclick = "mainChioce()" type="button" style="font-size:30px;padding-left:30px;padding-right:20px;color:#ffffff;background-color:#258ee7;margin-bottom:70px" class="btn col-sm-12 col-xs-12">下&nbsp;&nbsp;一&nbsp;&nbsp;步</button>
</div>
</div>


<div id = "wqyw" hidden = "hidden">
<div class="row" style = "background-color:#258ee7;padding-bottom:10px;padding-top:10px">
 <p style = "text-align:center;color:white;margin-bottom:0px;font-size:30px" class  = "col-xs-12 col-sm-12">网签办理</p>
</div>

  <label style = "margin-left:14px;color:red ;font-size:20px;margin-top:15px">卖方信息：</label>
  <div class="col-sm-12 col-xs-12 " style="padding:0px;margin-bottom:20px">

    <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">姓名</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style=" font-size:20px" type="text" class="form-control" id="wqyw_sell_name" placeholder="">
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">联系电话</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style="font-size:20px"  type="number" onkeyup="this.value=this.value.replace(/\D/g,'')" class="form-control" id="wqyw_sell_phone" placeholder="">
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">身份证号码</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style="font-size:20px" type="text" class="form-control" id="wqyw_sell_id" placeholder="">
	</div>
	</div>
  </div>
  <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">身份证正面照：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg"  id = "wqyw_sell_id_photo" onClick = "getImage(this, 'wqyw_sell_id_photo')" style="margin-top:10px">
  </div>
  <div class = "col-sm-12 col-xs-12" >
   <hr style = "border-top: 2px solid #cce">
  </div>
  
  <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">身份证反面照：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_sell_id_photo_back')" id = "wqyw_sell_id_photo_back" style="margin-top:10px">
  </div>
  <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
  
  <div class="col-sm-12">

 <hr style="border-top: 2px solid #cce">
</div>


<div style = "margin-top:50px">
  <label style = "margin-left:14px;color:red ;font-size:20px">买方信息：</label>
  <div class="col-sm-12 col-xs-12 " style="padding:0px;margin-bottom:20px">

    <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">姓名</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style=" font-size:20px" type="text" class="form-control" id = "wqyw_buy_name" placeholder="">
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">联系电话</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style="font-size:20px"  onkeyup="this.value=this.value.replace(/\D/g,'')"  type="number" class="form-control" id = "wqyw_buy_phone" placeholder="">
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">身份证号码</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style="font-size:20px" type="text" class="form-control" id = "wqyw_buy_id" placeholder="">
	</div>
	</div>
  </div>
  
  <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">身份证正面照：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg"  onClick = "getImage(this, 'wqyw_buy_id_photo')" id = "wqyw_buy_id_photo" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
  <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">身份证反面照：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_buy_id_photo_back')" id = "wqyw_buy_id_back" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
  <div class = "col-sm-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
  <div class="col-sm-12">

 <hr style="border-top: 2px solid #cce">
</div>
</div>

<div style = "margin-top:50px">
 <label style = "margin-left:14px;color:red ;font-size:20px">交易信息：</label>
  
    <div class="col-sm-12 col-xs-12 " style="padding:0px;margin-bottom:20px">

    <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-4 col-xs-5">成交价(元)</p>
	<div style = "margin-top:20px" class = "col-sm-8 col-xs-7">
	  <input style=" font-size:20px"  class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'.')"  type="number" id = "wqyw_business_price" placeholder="">
	
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-4 col-xs-5">商贷金额(元)</p>
	<div style = "margin-top:20px" class = "col-sm-8 col-xs-7">
	  <input style="font-size:20px"  class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'.')"  type="number" id = "wqyw_business_loan" placeholder="">
	</div>
    </div>
	
	<div class="col-sm-12 col-xs-12 " >
	<p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-5 col-xs-6">公积金贷款金额(元)</p>
	<div style = "margin-top:20px" class = "col-sm-7 col-xs-6">
	  <input style="font-size:20px"  class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'.')"  type="number" id = "wqyw_business_fund" placeholder="">
	</div>
	</div>
  </div>
  
  
  
  <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">买卖合同：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg"  onClick = "getImage(this, 'wqyw_business_photo')"  id = "wqyw_business_photo" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
</div>

<div style = "margin-top:50px">
 <label style = "margin-left:14px;color:red ;font-size:20px">其他信息：</label>
 
   <div class="col-sm-12 col-xs-12 " style="padding:0px;margin-bottom:20px">

    <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding-right:0px"class = "col-sm-3 col-xs-4">房产地址</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-8">
	  <input style=" font-size:20px" type="text" class="form-control" id = "wqyw_house_address" placeholder="">
	</div>
    </div>
	
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">房产证扫描件1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_house_prove1_photo')" id = "wqyw_house_prove1_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">房产证扫描件2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg"  onClick = "getImage(this, 'wqyw_house_prove2_photo')" id = "wqyw_house_prove2_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-5 col-xs-5">房产证扫描件3：</p>  
<p style = "color:rgb(255, 0, 0); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-5 col-xs-5" >（可不传）</p>   
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px;padding:0px" class = "col-sm-2 col-xs-2" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_house_prove3_photo')" id = "wqyw_house_prove3_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-5 col-xs-5">房产证扫描件4：</p>  
  <p style = "color:rgb(255, 0, 0); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-5 col-xs-5" >（可不传）</p>  
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px;padding:0px" class = "col-sm-2 col-xs-2" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_house_prove4_photo')" id = "wqyw_house_prove4_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
    <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-9 col-xs-9">维修基金发票扫描件：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-3 col-xs-3" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_house_fund_photo')" id = "wqyw_house_fund_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
    
    <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-8 col-xs-8">购房证明扫描件：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-4 col-xs-4" >示例</p>
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'wqyw_house_prove_photo')" id = "wqyw_house_prove_photo"  style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
 
<div class="col-sm-12 col-xs-12">
<button type="button" onclick = "banliwangqian()"style="font-size:40px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7;margin-bottom:70px" class="btn col-xs-12 col-sm-12">下&nbsp;&nbsp;一&nbsp;&nbsp;步</button>
</div>
</div>

</div>

<div id = "pgbgdiv" hidden = "hidden">
<div class="row" style = "background-color:#258ee7;padding-bottom:10px;padding-top:10px">
 <p style = "text-align:center;color:white;margin-bottom:0px;font-size:30px" class  = "col-xs-12 col-sm-12">网签办理</p>
</div>
<div style = "margin-top:50px">
  <label style = "margin-left:14px;color:red ;font-size:20px">报告使用银行：</label>
  <div class="col-sm-12 col-xs-12 " style="margin-bottom:20px">
      <div class="col-sm-12 col-xs-12"> 
	   <p style = "font-size:20px;text-align:left;margin-top:2px" class = "col-sm-6 col-xs-6 ">选择银行</p>
	  <div style="font-size:22px;margin-top:5px" class="btn-group col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">    
	    <button type="button" class="btn btn-primary dropdown-toggle" style = "width:100%"id="dropdown-yh" data-toggle="dropdown"> 请选择银行        
		  <span class="caret"></span>   
		</button>   
     		<ul class="dropdown-menu" role="menu">        
			 <li onclick="yhchoice(this)">南京银行</li>       
			 <li onclick="yhchoice(this)">北京银行</li>        
			 <li onclick="yhchoice(this)">中国银行</li>        
			 <li onclick="yhchoice(this)">潮州银行</li>       
			 <li onclick="yhchoice(this)">中国建设银行</li>   
			 </ul>
	  </div>
	  </div>
  </div>
 <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div >
  <div class = "col-sm-12 col-xs-12">
   <label style = "margin-left:14px;color:red ;font-size:20px">房屋外部照片：</label>
   </div>
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">外部图1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
   <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_photo1')" id = "pgyw_house_photo1" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">外部图2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_photo2')" id = "pgyw_house_photo2" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
   
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">外部图3：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_photo3')" id = "pgyw_house_photo3" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">外部图4：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_photo4')" id = "pgyw_house_photo4" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
 
</div>

<div style = "margin-top:50px">
  <label style = "margin-left:14px;color:red ;font-size:20px">房屋内部照片：</label>
     <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">卧室1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_in_photo1')" id = "pgyw_house_in_photo1" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
     <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">卧室2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_in_photo2')" id = "pgyw_house_in_photo2" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
    <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">卧室3：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_in_photo3')" id = "pgyw_house_in_photo3" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">客厅1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_kt_photo1')" id = "pgyw_house_kt_photo1" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">客厅2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_kt_photo2')" id = "pgyw_house_kt_photo2" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">客厅3：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_kt_photo3')" id = "pgyw_house_kt_photo3" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">厨房1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_cf_photo1')" id = "pgyw_house_cf_photo1" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">厨房2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_cf_photo2')" id = "pgyw_house_cf_photo2" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">卫生间1：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_wsj_photo1')" id = "pgyw_house_wsj_photo1" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
   <div class="col-sm-12 col-xs-12">
  <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6">卫生间2：</p>  					 
  <p style = "color:rgb(0, 0, 255); font-size:14px;text-align:left;margin-top:15px" class = "col-sm-6 col-xs-6" >示例</p>
     <p style = "font-size:14px;text-align:left;margin-top:15px" class = "col-sm-12 col-xs-12">实例说明：有小区门牌号</p>  	
  <img class = "col-sm-6 col-xs-6 col-sm-offset-3 col-xm-offset-3" src="images/tjzp.jpg" onClick = "getImage(this, 'pgyw_house_wsj_photo2')" id = "pgyw_house_wsj_photo2" style="margin-top:10px">
  </div>
   <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  
</div>




<div class="col-sm-12 col-xs-12">
<button onClick = "banlipinggu()" type="button" style="font-size:40px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7;margin-bottom:70px" class="btn col-sm-12 col-xs-12">下&nbsp;&nbsp;一&nbsp;&nbsp;步</button>
</div>
</div>

</div>

<div id = "senddiv" hidden = "hidden">
   <div class="row" style = "background-color:#258ee7;padding-bottom:10px;padding-top:10px">
       <p style = "text-align:center;color:white;margin-bottom:0px;font-size:30px" class  = "col-xs-12 col-sm-12">派送方式</p>
   </div>
   
  
	
	<div class = "row" style = "margin-top:20px;padding-bottom:20px">
<div id = "zq" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "SendSelect(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	自取
	</label>
	
</div>
<div id = "zqdiv" hidden = "hidden" style = "margin-left:20px;margin-top:20px"class="col-sm-12 col-xs-12 " >
	  <span style = "font-size:20px;text-align:left">自取地址：</span>
	  <span style = "font-size:20px;text-align:left;color:red" >青岛市黄岛区龙兴大道23号</span>
	</div>
</div>
<div class = "row" style = "padding-top:20px;padding-bottom:20px">
<div id = "psyh" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "SendSelect(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	派送银行
	</label>

</div>
	
  <div  id = "psyhdiv" hidden = "hidden"  class="col-sm-12 col-xs-12 " style="margin-bottom:20px">
      <div class="col-sm-12 col-xs-12" style = "margin-top:20px;"> 
	   <p style = "font-size:20px;text-align:left;margin-top:2px" class = "col-sm-6 col-xs-6 ">选择银行</p>
	  <div style="font-size:22px;margin-top:5px" class="btn-group col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">    
	    <button type="button" style= "width:100%" class="btn btn-primary dropdown-toggle" id="dropdown-yh1" data-toggle="dropdown"> 请选择银行        
		  <span class="caret"></span>   
		</button>   
     		<ul class="dropdown-menu" role="menu">        
			 <li onclick="yhchoice1(this)">南京银行</li>       
			 <li onclick="yhchoice1(this)">南京银行</li>        
			 <li onclick="yhchoice1(this)">中国银行</li>        
			 <li onclick="yhchoice1(this)">潮州银行</li>       
			 <li onclick="yhchoice1(this)">中国建设银行</li>   
			 </ul>
	  </div>
	  </div>
  </div>
</div>
<div class = "row" style = "padding-top:20px;padding-bottom:20px">
<div id = "kd" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "SendSelect(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	快递
	</label>
</div>
</div>
	
	
	

   <div id = "kddiv" hidden = "hidden" class="col-sm-12 col-xs-12 " style="padding:0px;margin-bottom:20px">

    <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding:0px"class = "col-sm-3 col-xs-3">姓名</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-9">
	  <input style=" font-size:20px" type="text" class="form-control" id="sdName" placeholder="">
	</div>
    </div>
	  <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding:0px"class = "col-sm-3 col-xs-3">电话</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-9">
	  <input style=" font-size:20px" type="text" class="form-control" id="sdTele" placeholder="">
	</div>
    </div>
	  <div class="col-sm-12 col-xs-12 " >
    <p style = "font-size:15px;text-align:left;margin-top:27px;padding:0px"class = "col-sm-3 col-xs-3">快递地址</p>
	<div style = "margin-top:20px" class = "col-sm-9 col-xs-9">
	  <input style=" font-size:20px" type="text" class="form-control" id="sdAddress" placeholder="">
	</div>
    </div>
  </div>
     <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  <div class = "col-sm-12 col-xs-12">
   <p style = "text-align:center;font-size:20px">是否代办后期业务</p>
  </div>

  	<div class = "row" style = "margin-top:20px;padding-bottom:20px">
<div id = "dbhq" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "DaibanSelect(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	是
	</label>
</div>

</div>
<div class = "row" style = "padding-top:20px;padding-bottom:20px">
<div id = "bdbhq" style="background-color:#efefef;text-align:center;border-radius:4px;padding:8px" onclick = "DaibanSelect(this)" class="col-sm-8  col-sm-offset-2 col-xs-8 col-xs-offset-2">
	<img style = "display:inline" src="images/input-unchecked.png" alt="Smiley face" >
	<label  style = "display:inline;color:#969393;font-size:30px;vertical-align: middle;" >
	否
	</label>
</div>
</div>

	  <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  <div class = "row" style = "margin-top:20px;padding-bottom:20px">
    <div  class="col-sm-12 col-xs-12 " >
	  <p class="col-sm-8 col-xs-8 " style = "margin-top: 6px; font-size: 20px;">使用积分</p>
	  <input  style="zoom:120%;position:absolute;right:40px" type="checkbox"> 
	 
	</div>
	    <div  class="col-sm-12 col-xs-12 " >
	  <p class="col-sm-6 col-xs-6 " style = "font-size:20px">应付款 ￥200</p><p  style = "font-size:20px; color:red;position:absolute;right:40px">实付款 ￥20</p>
	</div>
	
	 <div class = "col-sm-12 col-xs-12">
  <hr style = "border-top: 2px solid #cce">
  </div>
  </div>
	<div class="col-sm-12 col-xs-12">
<button onClick = "setSend()" type="button" style="font-size:40px;padding-left:30px;padding-right:30px;color:#ffffff;background-color:#258ee7;margin-bottom:70px" class="btn col-sm-12 col-xs-12">提交订单</button>
</div>
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