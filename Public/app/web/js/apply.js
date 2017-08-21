
$(function(){
	$(':input').labelauty();

	
	getUserInfo();

	
	
	
	playerRegister = function()
	{
	
		var phone = $('#yanzheng_phone')[0].value;
		nowChoice = 2;
		var simCode = $('#yanzheng_code')[0].value;
		console.info("phone=" + phone + "simCode=" + simCode);
		var friend = $('#friend_code')[0].value;
		if(phone == "" || phone == undefined)
		{
			console.info("kkk");
			showTip("请输入手机号码!").show();
			return;
		}
		else if(simCode == "" || simCode == undefined)
		{
			showTip("请输入验证码！").show();
			return ;
		}
		else if(nowChoice == 0)
		{
			showTip("请选择会员类型！").show();
			return ;
		}
		
		
		 var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=User.Register';
	   obj.param = {};
	   obj.param.mobile = phone;
	   obj.param.code = simCode;
	   obj.param.roleid = nowChoice;
	   
	   if(friend == null || friend == undefined || friend == "")
	   {}
        else
	      obj.param.friend = friend;
		  obj.param.time = new Date().getTime();
	   obj.func = function(data){
			  if(data.code == 1)
			{var tip = showTip('绑定成功！', function(){  window.location.href='./userinfo.php';}); tip.show();setTimeout(tip.close, 4000);
		     
			}
               
		    else if(data.code == 2)
			{ var tip = showTip('您已经绑定！',function(){  window.location.href='./userinfo.php';}); tip.show();setTimeout(tip.close, 4000);
		
		    }
			 else if(data.code == 3)
			{ var tip = showTip('验证码错误！'); tip.show();setTimeout(tip.close, 4000);}		 
		}
       Ajax(obj); 
		
		/*var aj = $.ajax( {  
        url:'http://www.allwinits.com/?service=User.Register',// 跳转到 action  
    data:{  
             mobile : phone,  
             code : simCode,  
             roleid : nowChoice,
			 friend:friend,
			 time:new Date().getTime()
    },  
    type:'post',  
    cache:false,  
    dataType:'json',  
    success:function(data) {  
	    console.info("data=",data);
        if(data.ret =="200" ){  
		    if(data.data.code == 1)
			{var tip = showTip('绑定成功！', function(){  window.location.href='./userinfo.php';}); tip.show();setTimeout(tip.close, 4000);
		     
			}
               
		    else if(data.data.code == 2)
			{ var tip = showTip('您已经绑定！',function(){  window.location.href='./userinfo.php';}); tip.show();setTimeout(tip.close, 4000);
		
		    }
			 else if(data.data.code == 3)
			{ var tip = showTip('验证码错误！'); tip.show();setTimeout(tip.close, 4000);}
				
        }else{  
         
        }  
     },  
     error : function() {  
         
     }  
});*/
	}
	
	yhchoice = function(obj)
      {
         console.info(obj.innerHTML);
	     console.info( $('#dropdown-yh'));
	    $('#dropdown-yh')[0].innerHTML = obj.innerText + "<span class='caret'></span>";
     };
	 

	 
	 CountTime = function()
	 {
		  var obj = $('#phoneMessage');
		
		
		 var text = obj[0].value;
		  var num ;
		 if(text == '获取验证码')
		 {
			 text = '120s';
			 obj[0].value = 120 + 's';
			 obj.attr('disabled', 'disabled');
		 }
			 
		 var num = parseInt(text);
		 num -= 1;
		 // console.info('' + num);
		 if(num > 0)
		 {
			 setTimeout("CountTime()",1000)
			 obj[0].value =num + 's';
		 }
		 else
		 {
			 obj[0].value  = '获取验证码'
			 obj.removeAttr('disabled');
		 }
	 }
	 
	 getMessage = function ()
	 {
		 var phoneNum = $('#yanzheng_phone')[0].value;
		 if(phoneNum.length < 11 || phoneNum.charAt(0) != '1')
		 {
			 showTip('请输入正确的手机号码!').show();
			 return ;
		 }
		 else
		 {
			  	var aj = $.ajax( {  
        url:'http://www.allwinits.com/?service=Message.SendCode',// 跳转到 action  
    data:{  
             mobile : phoneNum  
    },  
    type:'post',  
    cache:false,  
    dataType:'json',  
    success:function(data) {  
	    console.info("data=",data);
        if(data.ret =="200" ){  
             if(data.data.code == 1)
				 console.info('发送成功');
        }else{  
         
        }  
     },  
     error : function() {  
          // view("异常！");  
        //  alert("发送验证码异常！");  
     }  
});
	
		 }
		// console.info('abc');
		CountTime();
			 
	 }
	 
	 
	 /**
 * 获取serviceId
 * @param localId1 本地id
 * @param colname 列名
 * @param tablename 表名
 * @param filename 文件名
 */
    upImg = function(localId1,colname,tablename,filename,fileform,remark){
	wx.uploadImage({
		localId : localId1.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得
		isShowProgressTips : 1, // 默认为1，显示进度提示
		success : function(res) {
			var serverId = res.serverId; // 返回图片的服务器端ID
			
			$('#mgbd')[0].innerHTML = serverId;
			downloadImage(localId1.toString(),serverId,colname,tablename,filename,fileform,remark);
		}
	});
   }
   
   
   /**
 * 通过serviceId 下载附件
 * @param localId1
 * @param serverId
 * @param colname
 * @param tablename
 * @param filename
 */
function downloadImage(localId1,serverId,colname,tablename,filename,fileform,remark){
		$.ajax({
			type : "POST",
			url :  'http://www.allwinits.com/?service=WeiChat.PostImage',
			data:{type:'ss',media_id:serverId},
			async : false,
			success : function(result) {
				  $('#imagePhoto')[0].src = 'data:image/jpg;base64,' + result;
		
				if (!result) return;
				var data = result.data;
				$('#yyzz_button').display = "none";
				var str = '<image style = "width:83px; height:83px" src = ' + data + '/>';
				 $("#yyzz_div").append(str); 

			},
            error : function(result) {
                checkDialog({"title":"错误","content":"上传图片出错！"});
			}
		});	
}

	yyzzLoad = function(){
		 console.info('营业执照');
		 var tablename = 'yyzz';
		 var colname = 'yyzz';
		 var filename = 'yyzz';
		 var fileform = '';
		 var remark = "营业执照";
		 wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
				console.info("res = ",res);
              var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			
			 // $('#imagePhoto')[0].src = localIds
			  upImg(localIds,colname,tablename,filename,fileform,remark);
           }
       });
	}
	
	
	
	
	
	
	   nowChoice = 0;
	  $(".choice.huyuan").click(function () {
		    $("#addApeend").empty();
			var str = '';
			console.info($(this));
			if ($(this).attr("checked"))
			{
				 var id = this.id;
				 //后期商家
				 if(id == 'hqsjhy')
				 {
					 nowChoice = 3;
					str = "<hr style = 'border-top: 2px solid #cce'><div class = 'col-sm-12'><p class = 'col-sm-2 col-sm-offset-2'>营业执照：</p>  \
					   <p class = 'float:left' style = 'color:rgb(0, 0, 255);padding-left:-10px'>示例</p><img src = 'images/tjzp.jpg' \
					   class = 'col-sm-2 col-sm-offset-2';style = 'width:60px;height:60px'></img></div>";
				 }
				 //银行
				 else if(id == 'yhhy')
				 {
					 nowChoice = 1;
					str = "<hr style = 'border-top: 2px solid #cce'> <div id = 'yyzz_div' class = 'col-sm-12'><p style= 'color:#8C8383;font-size:16px' class = 'col-sm-12 col-sm-offset-1'>选择银行:</p><div style = 'font-size:22px' class='btn-group col-sm-8 col-sm-offset-2'>\
                      <button type='button' class='btn btn-primary dropdown-toggle' id = 'dropdown-yh'data-toggle='dropdown'> 请选择银行\
                      <span class='caret'></span>\
                      </button>\
                      <ul class='dropdown-menu' role='menu'>\
                      <li onclick = 'yhchoice(this)'>南京银行</li>\
                      <li onclick = 'yhchoice(this)'>南京银行</li>\
                      <li onclick = 'yhchoice(this)'>中国银行</a></li>\
                      <li onclick = 'yhchoice(this)'>潮州银行</a></li><li><a href='#'>潮州银行</a></li><li><a href='#'>潮州银行</a></li><li><a href='#'>潮州银行</a></li><li><a href='#'>潮州银行</a></li><li><a href='#'>潮州银行</a></li>\
                      <li onclick = 'yhchoice(this)'>中国建设银行</a></li>\
                      </ul></div>\
                      </div>"
				 }
				 else if(id == 'zjhy')
				 {
					 nowChoice = 2;
					str = "<hr style = 'border-top: 2px solid #cce'><div class = 'col-sm-12'><p class = 'col-sm-2 col-sm-offset-2'>营业执照：</p>  \
					   <p class = 'float:left' style = 'color:rgb(0, 0, 255);padding-left:-10px'>示例</p><img onclick='yyzzLoad()' id = 'yyzz_button' src = 'images/tjzp.jpg' \
					   class = 'col-sm-2 col-sm-offset-2';style = 'width:60px;height:60px'></img></div><hr class = 'col-sm-12' style = 'border-top: 2px solid #cce'><div class = 'col-sm-12'><p class = 'col-sm-2 col-sm-offset-2'>门头照片：</p>  \
					   <p class = 'float:left' style = 'color:rgb(0, 0, 255);padding-left:-10px'>示例</p><img src = 'images/tjzp.jpg' \
					   class = 'col-sm-2 col-sm-offset-2';style = 'width:60px;height:60px'></img></div> <hr class = 'col-sm-12' style = 'border-top: 2px solid #cce'><div class='col-sm-10 col-sm-offset-1' style = 'margin-bottom:20px'>\
                       <div class='col-sm-1'>\
	             	   <span class='glyphicon glyphicon-map-marker' style = 'top:20px; float:right'></span>\
		               </div>\
		               <div class='col-sm-9'>\
			           <input style = 'height:70px; font-size:32px' type='text' class='form-control' id='firstname' \
				       placeholder='请输入地址'>\
		               </div>\
		               <div class = 'col-sm-2'>\
			           <button style = 'height:70px; font-size:16px' type='button' class='btn btn-default col-sm-12'>获取地址</button>\
                       </div>\
	                   </div>";
				 }
				 
				// $("#addApeend").append(str); 
			}				  
	  });
	  
	 
});




