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
			
             $('#imagePhoto')[0].src = data.headimgurl;
			 $('#pName')[0].innerHTML = data.nickname;			 
		}
       Ajax(obj);  
   }
  getUserInfo();
   
   
   datechoice = function(obj)
   {
	    $('#dropdown-yh')[0].innerHTML = obj.innerText + "<span class='caret'></span>";
		ShowYewu();
   
   }
   
   

   
   
   
  
  
  AddYeWu = function(data)
  {
  var str = "<div id = 'jiaoyiInfoDiv" + data.bid + "class = 'col-sm-12 col-xs-12' style = 'padding-left:0px;padding-right:0px;padding-bottom:10px'>"
			str += " <p style = 'padding-left:10px' class = 'col-sm-6 col-xs-6'>业务号：" + data.bid + "</p>"
			str += "   <p style = 'text-align:right' class = 'col-sm-6 col-xs-6'>" + data.create_dt + "</p>  <div class = 'col-sm-12 col-xs-12'>"
			str += " <span style = 'margin-left:10px' class='label ";
			var wangqian = data.sign;
			if(wangqian)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			
			str += ">网签 <span style = 'color:red'>（业务成功）</span></span> <span class='label ";
			var pinggu = data.assess;
			if(pinggu)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			str += ">评估报告<span style = 'color:red'>（业务成功）</span></span> <span class='label ";
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
			var sta = data.status;
			if(sta == 1)
				str += "正在审核"
			else
				str += '审核通过'
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
  
  ShowYewu = function()
{
	
		
		var obj = {};
	    obj.url = 'http://www.allwinits.com/?service=Business.GetBusinessList';
	    obj.param = {};
		obj.param.uid = 1
		obj.param.day = 7;
	    obj.func = function(data){
		
		if(data.code == 0)
		{
			$('#myYeWu').empty();
			//$('#myYeWu').remove();
			 for(var i in data)
			 {
				// 	for(var j in data[i])
				// $('#abc')[0].innerHTML += j + '-' + data[i][j] + ";"
			 //
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
ShowYewu();
   
});