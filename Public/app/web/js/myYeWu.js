$(function(){
   userInfo = {}
   day = 7;
   getUserInfo = function()
   {
	  
	   console.info('uu');
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=User.Info';
	   obj.param = {};
	  
	 
	   obj.func = function(data){
			 userInfo = data	
			
             $('#imagePhoto')[0].src = data.headimgurl;
			 $('#pName')[0].innerHTML = data.nickname;		
		 
		}
       Ajax(obj);  
   }
  getUserInfo();
   
   
   datechoice = function(obj)
   {
	    $('#dropdown-yh')[0].innerHTML = obj.innerText + "<span class='caret'></span>";
		//alert(obj.innerText == "最近七天")
		if(obj.innerText == "最近一周")
		{
			day = 7;
		}
		else if(obj.innerText == "最近一月")
		{
				day = 30;
		}
		else if(obj.innerText == "最近三月")
		{
				day = 90;
		}
		else if(obj.innerText == "最近半年")
		{
				day = 180;
		}
		else if(obj.innerText == "最近一年")
		{
				day = 365;
		}
		ShowYewu();
   
   }
   
   

   
   GetStatus = function(stau, index)
   {
	   if(index == 0)
	   {
		   if(stau == 0)
		   {
			   return "未提交"
		   }
		   else if(stau == 1)
		   {
			   return "待审核"
		   }
		    else if(stau == 2)
		   {
			   return "审核通过"
		   }
		    else if(stau == 3)
		   {
			   return "审核失败"
		   }
		   else if(stau == 4)
		   {
			   return "业务取消，已退款"
		   }
		   else
			   return "未办理"
	   }
	   else if(index == 1)
	   {
		    if(stau == 0)
		   {
			   return "未提交"
		   }
		   else if(stau == 1)
		   {
			   return "待审核"
		   }
		    else if(stau == 2)
		   {
			   return "待支付"
		   }
		    else if(stau == 3)
		   {
			   return "支付成功"
		   }
		   else if(stau == 4)
			   return "业务取消"
		     else
			   return "未办理"
	   }
	    else if(index == 2)
		{
		
			 if(stau == 0)
		   {
			   return "未提交"
		   }
		   else if(stau == 1)
		   {
			   return "受理中"
		   }
		    else if(stau == 2)
		   {
			   return "物流配送"
		   }
		    else if(stau == 3)
		   {
			   return "业务成功"
		   }
		   else if(stau == 4)
			   return "业务取消"
		}
   }
   
  PayMoney = function(id)
  {
	  var obj = {};
	   obj.url = 'http://www.allwinits.com/?service= Business.TestWxPay';
	   obj.param = {};
	   obj.param.bid = id;
	 
	   obj.func = function(data){
			alert(data.code)
		 if(data.code == 0)
		 {
			 var tip = showTip('支付成功！', function(){  window.location.reload()})
		 }
		}
       Ajax(obj);  
	  
	 
  }
  
  AddYeWu = function(data)
  {
  var str = "<div id = " + data.bid + "class = 'col-sm-12 col-xs-12' style = 'padding-left:0px;padding-right:0px;padding-bottom:10px'>"
			str += " <p style = 'padding-left:10px' class = 'col-sm-6 col-xs-6'>业务号：" + data.bid + "</p>"
			str += "   <p style = 'text-align:right' class = 'col-sm-6 col-xs-6'>" + data.create_dt + "</p>  <div class = 'col-sm-12 col-xs-12'>"
			str += " <span style = 'margin-left:10px' class='label ";
			var wangqian = data.sign_status;
			if(wangqian)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			
			str += ">网签 <span style = 'color:red'>（  " + GetStatus(data.sign_status, 0) + "）</span></span> <span class='label ";
			var pinggu = data.assess_status;
			if(pinggu)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			str += ">评估报告<span "
			if(data.assess_status == 2)
			{
				str += " onClick = 'PayMoney(" + data.bid + ")'";
			}
			str += " style = 'color:red'>（ " + GetStatus(data.assess_status, 1) +"）</span></span> <span class='label ";
			var daiban = data.isAgency;
		
			if(daiban)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			str += ">代办后期</span> <label style = 'position:absolute;right:5px'>"
			str +=  GetStatus(data.status, 2);
			/*var sta = data.status;
			if(sta == 1)
				str += "正在审核"
			else
				str += '审核通过'*/
			str += "</label> <p style = 'padding-left:10px;padding-top:10px;margin-bottom:0px' class = 'col-sm-12 col-xs-12'>"
			var paso = data.type
			if(paso == 1)
			{
				str += '自取:'
				
			}
			else if(paso == 2)
			{
				str += '派送银行:'
			}
			else
			{
				str += '物流快递:'
			}
			str += data.address
			str += "</div> </div><div class = 'col-sm-12 col-xs-12'><hr style = 'border-top: 2px solid #cce'></div>"
			
			$('#myYeWu').append(str);
  }
  
  
  
     MyShowYewu = function()
  {
	
		
		var obj = {};
	    obj.url = 'http://www.allwinits.com/?service=Business.GetBusinessList';
	    obj.param = {};
		obj.param.uid = 1
		obj.param.day = day;
		
	    obj.func = function(data){
		 
		if(data.code == 0)
		{
			
			 for(var i in data)
			 {
				if(data[i] != 0)
				{
				  AddYeWu(data[i]);					
				}
					
			
			 }
			 
		}
		else if(data.code == 1)
		{
				 alert('用户未绑定');
		}
	};
	Ajax(obj);
		
       
	
}
  

   MyShowYewu();
});