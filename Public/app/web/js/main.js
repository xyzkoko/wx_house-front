$(function(){
   userInfo = {}
   getUserInfo = function()
   {
	  
	   console.info('uu');
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=User.Info';
	   obj.param = {};
	  
	 
	   obj.func = function(data){
			 userInfo = data	
			
			 if(userInfo.status == 3)
			 {
				 alert(userInfo.status)
				    $('#tip')[0].style.display = 'inline'
					 $('#tip').click(function(){ window.location.href='./userinfo.php'});;
			      
			 }
			 else
			 {
				
				 GetShowYewu();
			 }
			 
             $('#imagePhoto')[0].src = data.headimgurl;
			 $('#pName')[0].innerHTML = data.nickname;			 
		}
       Ajax(obj);  
   }
   
   
     GetShowYewu = function()
  {
	
		
		var obj = {};
	    obj.url = 'http://www.allwinits.com/?service=Business.GetBusinessList';
	    obj.param = {};
		obj.param.uid = 1
		obj.param.day = 7;
	    obj.func = function(data){
		 
		if(data.code == 0)
		{
			
			 for(var i in data)
			 {
				if(data[i] != 0)
				{
				
					if((data[i].sign_status==3) || (data[i].assess_status==2))
                    {
						//	alert("sign_status=" + data[i].sign_status + "," +　 data[i].assess_status)
						 $('#tip')[0].style.display = 'inline'
					    $('#tip').click(function(){ window.location.href='./myYeWu.php'});
						break;
					}					
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
   
   getUserInfo();
   myYewu = function()
   {
	   window.location.href='./myYeWu.php';
   }
   
   TuiJian = function()
   {
	   if($('#tuijian').is(':hidden'))
	   {
		   $('#tuijian').show();
		   $('#content').hide()
	   }
	   else
	   {
		    $('#tuijian').hide();
			 $('#content').show()
	   }
   }
   
   Sign = function()
   {
	
	   
	    var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=User.Sign';
	   obj.param = {};
	  
	 
	   obj.func = function(data){
			 if(data.code == 0)
             {
				 var tip = showTip("签到成功，获取" + data.points+"积分");
				 tip.show();
			 }	
             else if(data.code == 1)
			 {
				  var tip = showTip("今日已签到");
				 tip.show();
			 }				 
		}
       Ajax(obj);
   }
   
   
   ChangeUrl = function(index)
   {
			
		
	   if(index == 0)
	   {
		 	
	
		   if(userInfo.code == 0 && userInfo.mobile)
		   {
			  if(userInfo.roleid == 2)
			   {
				   if(userInfo.status == 1)
			   {
				     var tip = new showTip('个人信息审核中！')
				   tip.show(); //window.location.href='./business.php';
			   }
			   else if(userInfo.status == 0)
			   {
				  
				var tip = new showTip('个人信息未完善！', function(){
					 window.location.href='./changeInfo.php';
		        })
				tip.show();
			   }
			    else if(userInfo.status == 2)
			   {
				   window.location.href='./business.php';
				
			   }
			   else if(userInfo.status == 3)
			   {
				   var tip = new showTip('个人信息审核未通过！')
				  tip.show();
			   }
			   }
			   else
			   {
				     var tip = new showTip('非中介会员不能办理此业务')
				   tip.show(); 
			   }
		   }
		   else if(userInfo.mobile == undefined || userInfo.mobile == null)
		   {
			  
			    var tip = new showTip('未绑定手机！', function(){
					 window.location.href='./register.php';
				})
				tip.show();
				
		   }
	   }
		 
	   else if(index == 1)
		  window.location.href='./business.php';
	   else if(index == 2 || index == 3)
	   {
		   if(userInfo.code == 0)
			   window.location.href='./userinfo.php';
		   else if(userInfo.code == 1)
			   window.location.href='./register.php';
	   }
	   else if(index == 4)
       {
		    window.location.href='./helper.php';
	   }		   
   }
});