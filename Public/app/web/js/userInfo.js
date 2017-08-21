
$(function(){
	//是否认证成功
haveInfo = false;
	
ChangeUrl = function ()
{
	console.info('dsds');
	 window.location.href='./changeInfo.php';
}




ShowInfo = function(){
	if(!haveInfo)
		return;
	var abc = $('.table.table-striped:last');
	var kk = abc.find("span");
	var clas = kk.attr('class');
	if(clas.indexOf('glyphicon-chevron-down') != -1)
	{
		kk.removeClass('glyphicon-chevron-down');
		kk.addClass('glyphicon-chevron-right');
			$("#xiangxiInfoDiv").hide(); 
			
			console.info('ff1');
	}
	else
	{
		console.info('ff');
		kk.addClass('glyphicon-chevron-down');
		kk.removeClass('glyphicon-chevron-right');
		
		$('#xiangxiInfoDiv').show(); 
		
      
	}
	
	
}


ShowYewushow =function (data)
	{
		$('#yewuInfoDiv').empty();
	//	for(var i in data)
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
			
			str += ">网签</span> <span class='label ";
			var pinggu = data.assess;
			if(pinggu)
			{
				str += " label-success'"
			}
			else
			{
				str += " label-default'"
			}
			str += ">评估报告</span> <span class='label ";
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
			str += "</label></div> </div><div class = 'col-sm-12 col-xs-12'><hr style = 'border-top: 2px solid #cce'></div>"
			
			$('#yewuInfoDiv').append(str);
		}
	
	}
	
	//abcbili(data)
	
ShowTheObject = function (obj){  
  var des = "";  
    for(var name in obj){  
    des += name + ":" + obj[name] + ";";  
     }  
  dump(name); 
 
} 

ShowYewu = function()
{
	var abc = $('#tableYeWu');
	var kk = abc.find("span");
	var clas = kk.attr('class');
	if(clas.indexOf('glyphicon-chevron-down') != -1)
	{
		kk.removeClass('glyphicon-chevron-down');
		kk.addClass('glyphicon-chevron-right');
			$("#yewuInfoDiv").hide(); 
			
			console.info('ff1');
	}
	else
	{
		console.info('ff');
		kk.addClass('glyphicon-chevron-down');
		kk.removeClass('glyphicon-chevron-right');
		
		$('#yewuInfoDiv').show();
		
		var obj = {};
	    obj.url = 'http://www.allwinits.com/?service=Business.GetBusinessList';
	    obj.param = {};
		obj.param.uid = 1
	    obj.func = function(data){
			
		if(data.code == 0)
		{
			 for(var i in data)
			 {
			//	 alert(data[i]);
			//for(var j in data[i])
				//$('#abc')[0].innerHTML += j + '-' + data[i][j] + ";"
				if(data[i] != 0)
				{
					
					ShowYewushow(data[i]);	
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
}


getUserInfo = function()
{
		
	var obj = {};
	obj.url = 'http://www.allwinits.com/?service=User.Info';
	obj.param = {};
	obj.func = function(data){
		if(data.code == 0)
		{
			
				 if(data.roleid == null || data.roleid == undefined || data.mobile == null || data.mobile == undefined)
				 {
					 window.location.href='./register.php';
					 return;
				 }
				  $('#imagePhoto')[0].src = data.headimgurl;
				 $('#pName')[0].innerHTML = data.nickname;
				$('td')[1].innerHTML = data.uid;
				$('td')[3].innerHTML = data.rolename;
				$('td')[5].innerHTML = data.mobile ;
				$('td')[9].innerHTML = data.points;
				$('#yyzz_img')[0].src = 'data:image/bmp;base64,' + data.licence_photo;
				$('#mt_img')[0].src = 'data:image/bmp;base64,' + data.head_photo;
                $('#yy_address')[0].innerHTML = "营业地址：" + data.address;
				var state = "已审核"
				
				if(data.status == 0)
				{
					state = "未提交详细信息"
					$('td')[11].style.color = 'red'
					$('#shenheResult').click(function(){ChangeUrl()});
					
				}
				else if(data.status == 1)
				{
					state = "认证中"
				}
				
				else if(data.status == 3)
				{
					state = "失败:" + data.audit_error 
					$('td')[11].style.color = 'red'
					$('#shenheResult').click(function(){ChangeUrl()});
				}
				else if(data.status == 2)
				{
					haveInfo = true;
				}
				$('td')[11].innerHTML = state;
		}
			 else if(data.code == 1)
			 {
				 alert('用户未绑定');
			 }
	};
	Ajax(obj);
      
}

getUserInfo();
	 
	
});