 imageSerIds = {};
$(function(){
	 choice = 0;
	 preChoice = 0;
	 bid = 0;
	 console.info('jbs')
	 	 SendIndex = 0;
		 dabanHouqi = -1;
		 
   userInfo = {}
   getUserInfo = function()
   {
	  
	 
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=User.Info';
	   obj.param = {};
	  
	 
	   obj.func = function(data){
			 userInfo = data	
			
			 $('#yPrice')[0].innerHTML = '￥' + Math.ceil(userInfo.sign_money) * 2;
			  $('#hPrice')[0].innerHTML = '￥' + Math.ceil(userInfo.sign_money);
             $('#imagePhoto')[0].src = data.headimgurl;
			 $('#pName')[0].innerHTML = data.nickname;			 
		}
       Ajax(obj);  
   }
   
   getUserInfo();
   mainChioce = function()
   {
	 //  var netWait = new NetWait();
	  // netWait.show();
	   console.info('aaa')
       if($('#chujuwangqian')[0].style.backgroundColor != 'rgb(239, 239, 239)')
	      choice = 1; 
	   if($('#chujupgbg')[0].style.backgroundColor != 'rgb(239, 239, 239)')
	      choice = 2;
       if($('#chujupgbg')[0].style.backgroundColor != 'rgb(239, 239, 239)' && $('#chujuwangqian')[0].style.backgroundColor != 'rgb(239, 239, 239)')	
          choice = 3;

       if(choice == 1 || choice == 3)	
	    $('#wqyw').removeAttr('hidden');
        
	   else if(choice == 2)
	     $('#pgbgdiv').removeAttr('hidden');
	   else
	   {
		   new showTip("请选择要办业务！").show();
		    return;
	   }
		 
	   $('#mainDiv').attr('hidden', 'hidden');
	   var sign = 0, assess = 0;
	   if(choice ==  1 || choice == 3)
		   sign = 1;
	   if(choice == 2 || choice == 3)
		   assess = 1;
	   		var aj = $.ajax( {  
        url:'http://www.allwinits.com/?service=Business.PostBusiness',// 跳转到 action  
    data:{  
             sign : sign,  
             assess : assess,  
            
    },  
    type:'post',  
    cache:false,  
    dataType:'json',  
    success:function(data) {  
	   
        if(data.ret =="200" ){ 
           	
		    if(data.data.code == 0)
			{
				bid = data.data.bid;
			}
               
		    else if(data.data.code == 1)
			{ var tip = showTip('您还未绑定手机信息！'); tip.show();setTimeout(tip.close, 4000);}
			 else if(data.data.code == 2)
			{ var tip = showTip('您的信息还未通过审核！'); tip.show();setTimeout(tip.close, 4000);}
				
        }else{  
         
        }  
     },  
     error : function() {  
         
     }  
});
	   
	   
   }
   
  
   
    getImage = function(obj, id)
	{   
	
		wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
				
              var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			  obj.src = localIds
			  upImg(localIds, id);
           }
        });
	}
	
	 upImg = function(localId, name)
	 {
	
	    wx.uploadImage({
		localId : localId.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得
		isShowProgressTips : 1, // 默认为1，显示进度提示
		success : function(res) {
			var serverId = res.serverId; // 返回图片的服务器端ID
			imageSerIds[name] = serverId;
		}
	    });
     }
	 
	 WQCommitShowTip = function()
	 {
	   if(  $('#dropdown-yh')[0].innerHTML.indexOf("请选择银行")!= -1)
	   {
		   var tip = showTip("请选择银行！");
		   tip.show();
		   return 0;
	   }
	   else if(imageSerIds.pgyw_house_photo1 == undefined)
	   {
		     var tip = showTip("请上传房屋外部照片1");
		   tip.show();
		   return 0;
	   }
	    else if(imageSerIds.pgyw_house_photo2 == undefined)
	   {
		     var tip = showTip("请上传房屋外部照片2");
		   tip.show();
		   return 0;
	   }
	    else if(imageSerIds.pgyw_house_photo3 == undefined)
	   {
		     var tip = showTip("请上传房屋外部照片3");
		   tip.show();
		   return 0;
	   }
	    else if(imageSerIds.pgyw_house_photo4 == undefined)
	   {
		     var tip = showTip("请上传房屋外部照片4");
		   tip.show();
		   return 0;
	   }
	    else if(imageSerIds.pgyw_house_kt_photo3 == undefined || imageSerIds.pgyw_house_kt_photo1 == undefined || imageSerIds.pgyw_house_kt_photo2 == undefined)
		{
			var tip = showTip("至少上传2张客厅照片");
		   tip.show();
		   return 0;
		}
		else if(imageSerIds.pgyw_house_in_photo1 == undefined || imageSerIds.pgyw_house_in_photo2 == undefined || imageSerIds.pgyw_house_in_photo3 == undefined)
		{
			var tip = showTip("至少上传2张卧室照片");
		   tip.show();
		   return 0;
		}
		else if(imageSerIds.pgyw_house_cf_photo1 == undefined || imageSerIds.pgyw_house_cf_photo2 == undefined )
		{
			var tip = showTip("至少上传1张厨房照片");
		   tip.show();
		   return 0;
		}
		else if(imageSerIds.pgyw_house_wsj_photo1 == undefined || imageSerIds.pgyw_house_wsj_photo2 == undefined )
		{
			var tip = showTip("至少上传1张卫生间照片");
		   tip.show();
		   return 0;
		}
	     return 1;
	 }
	
   CommitShowTip = function()
   {
	   if($('#wqyw_sell_name')[0].value == "")
	   {
		   var tip = showTip("卖方姓名不能为空！");
		   tip.show();
		   return 0;
	   }
	   else if( $('#wqyw_sell_phone')[0].value == "")
	   {
		   var tip = showTip("卖方联系电话不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if(  $('#wqyw_sell_id')[0].value == "")
	   {
		   var tip = showTip("卖方身份证号码不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if( imageSerIds.wqyw_sell_id_photo == undefined)
	   {
		   var tip = showTip("请上传卖方身份证照片");
		   tip.show();
		    return 0;
	   }
	   else if( imageSerIds.wqyw_sell_id_photo_back == undefined)
	   {
		   var tip = showTip("请上传卖方身份证反面照片");
		   tip.show();
		    return 0;
	   }
	   
	   
	   else if($('#wqyw_buy_name')[0].value == "")
	   {
		   var tip = showTip("买方姓名不能为空！");
		   tip.show();
		   return 0;
	   }
	   else if( $('#wqyw_buy_phone')[0].value == "")
	   {
		   var tip = showTip("买方联系电话不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if(  $('#wqyw_buy_id')[0].value == "")
	   {
		   var tip = showTip("买方身份证号码不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if( imageSerIds.wqyw_buy_id_photo == undefined)
	   {
		   var tip = showTip("请上传买方身份证照片");
		   tip.show();
		    return 0;
	   }
	   else if( imageSerIds.wqyw_buy_id_photo_back == undefined)
	   {
		   var tip = showTip("请上传买方身份证反面照片");
		   tip.show();
		    return 0;
	   }
	   
	   else if($('#wqyw_business_price')[0].value == "")
	   {
		   var tip = showTip("成交价不能为空！");
		   tip.show();
		   return 0;
	   }
	   else if($('#wqyw_business_loan')[0].value == "")
	   {
		   var tip = showTip("商贷金额不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if($('#wqyw_business_fund')[0].value == "")
	   {
		   var tip = showTip("公积金贷款金额不能为空！");
		   tip.show();
		    return 0;
	   }
	    else if( imageSerIds.wqyw_business_photo == undefined)
	   {
		   var tip = showTip("请上传购房合同照片");
		   tip.show();
		    return 0;
	   }
	   
	   else if($('#wqyw_house_address')[0].value == "")
	   {
		   var tip = showTip("房产地址不能为空！");
		   tip.show();
		   return 0;
	   }
	   else if(imageSerIds.wqyw_house_prove1_photo == undefined || imageSerIds.wqyw_house_prove2_photo == undefined)
	   {
		   var tip = showTip("至少上传两张张房产扫描件！");
		   tip.show();
		   return 0;
	   }
	    else if(imageSerIds.wqyw_house_fund_photo == undefined)
	   {
		   var tip = showTip("请上传维修基金发票！");
		   tip.show();
		    return 0;
	   }
	    else if( imageSerIds.wqyw_house_prove_photo == undefined)
	   {
		   var tip = showTip("请上传购房证明照片");
		   tip.show();
		    return 0;
	   }
	 
	   
	    return 1;
   }
   
   setSend = function()
   {
	   
	 
	  
	   console.info("setSend");
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=Business.PostBusinessStatus';
	   obj.param = {};
	   obj.param.bid = bid;
	   obj.param.type = SendIndex;
	   if(SendIndex == 1)
	   {
		    
	     obj.param.address  = "微信用户;" + userInfo.mobile + ";青岛市黄岛区龙兴大道23号";
	   }
	   else if(SendIndex == 2)
	   {
		  
		   var str =  $('#dropdown-yh1')[0].innerHTML;
		   str = str.replace('<span class="caret"></span>',"");
		  
		   if(str.indexOf("请选择银行") != -1)
		   {
			   var tip = new showTip('请选择银行');
			   tip.show();
			   return;
		   }
	       obj.param.address = "微信用户;" + userInfo.mobile + ";" + str;
	   }
		else if(SendIndex == 3)
        {
			 if(  $('#sdName')[0].value == '' ||  $('#sdTele')[0].value  == '' || $('#sdAddress')[0].value == '')
		   {
			   var tip = new showTip('信息不完善！');
			   tip.show();
			   return;
		   }
			obj.param.address = $('#sdName')[0].value +";" + $('#sdTele')[0].value + ";" + $('#sdAddress')[0].value;
		}		
       obj.param.isAgency =dabanHouqi;	
	   if(dabanHouqi == -1)
	   {
		    var tip = new showTip('请选择是否代办后期业务');
			   tip.show();
			   return;
	   }

       obj.func = function(data){
			
			 if(data.code == 0)
			 {
				 var tip = new showTip("已提交！等待审核", function(){  window.location.href='./main.php';});
				 tip.show();
			 }
			 else if(data.code == 1)
			 {
				 var tip = new showTip('用户未绑定');
				  tip.show();
			 }
			 else if(data.code == 2)
			 {
				   var tip = new showTip('角色未审核');
				   tip.show();
			 }
			 else
			 {
				var tip = new showTip('提交失败');
				tip.show();
			 }
			
		};
       Ajax(obj);	   
   }
 
   banliwangqian = function()
   {
	  
	   if(!CommitShowTip())
		   return;
       nowChoice = 0
   	  
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=Business.PutBusinessSign';
	   obj.param = {};
	   obj.param.bid = bid;
	
	   obj.param.seller_name = $('#wqyw_sell_name')[0].value;
	   obj.param.seller_mobile = $('#wqyw_sell_phone')[0].value;
	   obj.param.seller_ID = $('#wqyw_sell_id')[0].value;
	   obj.param.seller_ID1_photo = imageSerIds.wqyw_sell_id_photo; 
	   obj.param.seller_ID2_photo = imageSerIds.wqyw_sell_id_photo_back;  
	   
	   obj.param.buyer_name = $('#wqyw_buy_name')[0].value;
	   obj.param.buyer_mobile = $('#wqyw_buy_phone')[0].value;
	   obj.param.buyer_ID = $('#wqyw_buy_id')[0].value;
	   obj.param.buyer_ID1_photo = imageSerIds.wqyw_buy_id_photo;   
	   obj.param.buyer_ID2_photo = imageSerIds.wqyw_buy_id_photo_back;   
	   
	   obj.param.business_price = $('#wqyw_business_price')[0].value;
	   obj.param.business_loan = $('#wqyw_business_loan')[0].value;
	   obj.param.business_fund = $('#wqyw_business_fund')[0].value;
	   obj.param.business_photo = imageSerIds.wqyw_business_photo;  
	   
	   obj.param.house_address = $('#wqyw_house_address')[0].value;
	   obj.param.house_prove1_photo = imageSerIds.wqyw_house_prove1_photo; 
	   obj.param.house_prove2_photo = imageSerIds.wqyw_house_prove2_photo; 
	   obj.param.house_prove3_photo = imageSerIds.wqyw_house_prove3_photo; 
	   obj.param.house_prove4_photo = imageSerIds.wqyw_house_prove4_photo; 
	   obj.param.house_fund_photo = imageSerIds.wqyw_house_fund_photo;   
	   obj.param.house_prove_photo = imageSerIds.wqyw_house_prove_photo; 
	   
	 
	   obj.func = function(data){
			
			 if(data.code == 0)
			 {
				 if(choice == 3)
				 {
					  $('#wqyw').attr('hidden', 'hidden');
	                 $('#pgbgdiv').removeAttr('hidden');
	                 scrollTo(0,0);
				 }
				else if(choice == 1)
				{
					  $('#wqyw').attr('hidden', 'hidden');
	                 $('#senddiv').removeAttr('hidden');
	                 scrollTo(0,0);
				}
			 }
			  else if(data.code == 1)
			 {
				 var tip = new showTip('用户未绑定');
				  tip.show();
			 }
			 else if(data.code == 2)
			 {
				   var tip = new showTip('角色未审核');
				   tip.show();
			 }
			 else
			 {
				var tip = new showTip('提交失败');
				tip.show();
			 }
		};
Ajax(obj);
	   
   }
   
   yhchoice1 = function(obj)
   {
	    $('#dropdown-yh1')[0].innerHTML = obj.innerText + "<span class='caret'></span>";
   }
   
   yhchoice = function(obj)
   {
         console.info(obj.innerHTML);
	     console.info( $('#dropdown-yh'));
	     $('#dropdown-yh')[0].innerHTML = obj.innerText + "<span class='caret'></span>";
   };
	 
   DaibanSelect = function(obj)
   {
	   	//灰色
		 if(obj.style.backgroundColor == 'rgb(239, 239, 239)')
	     {
		    obj.style.backgroundColor = '#3498db'
			
		   if(obj == $('#dbhq')[0])
		   {
			   dabanHouqi = 1
			  var child = $('#dbhq').children();
			  child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
			  
			  $('#bdbhq')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#bdbhq').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			 	 
		   }
		    else if(obj == $('#bdbhq')[0])
		   {
			 dabanHouqi = 0;
			 var child = $('#bdbhq').children();
			 child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
			  
			  $('#dbhq')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#dbhq').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
		   }
		 }
   }
   
   
   
	SendSelect = function(obj)
	{
		
		//灰色
		 if(obj.style.backgroundColor == 'rgb(239, 239, 239)')
	     {
		    obj.style.backgroundColor = '#3498db'
			SendIndex = 1;
		   if(obj == $('#zq')[0])
		   {
			  var child = $('#zq').children();
			  child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
			  
			  $('#psyh')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#psyh').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			 	  $('#kd')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#kd').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			  $('#zqdiv').removeAttr('hidden')
					  $('#psyhdiv').attr('hidden', 'hidden');
					   $('#kddiv').attr('hidden', 'hidden');
		   }
		    else if(obj == $('#psyh')[0])
		   {
			   SendIndex = 2;
			 var child = $('#psyh').children();
			 child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
			  
			  $('#zq')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#zq').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			 	  $('#kd')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#kd').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			   $('#psyhdiv').removeAttr('hidden')
					  $('#zqdiv').attr('hidden', 'hidden');
					   $('#kddiv').attr('hidden', 'hidden');
		   }
	         else if(obj == $('#kd')[0])
		   {
			   SendIndex = 3;
			 var child = $('#kd').children();
			 child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
			  
			  $('#psyh')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#psyh').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			 
			 	  $('#zq')[0].style.backgroundColor = 'rgb(239, 239, 239)'
			  
			   var child = $('#zq').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
			  $('#kddiv').removeAttr('hidden')
					  $('#psyhdiv').attr('hidden', 'hidden');
					   $('#zqdiv').attr('hidden', 'hidden');
		   }
	   }
	}
   
  changeColor =function (obj)
  {
	  console.info(obj)
     if(obj.style.backgroundColor == 'rgb(239, 239, 239)')
	 {
		 obj.style.backgroundColor = '#3498db'
		 if(obj == $('#chujuwangqian')[0])
		 {
			 var child = $('#chujuwangqian').children();
			 child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
		 }
		 else
		 {
			  var child = $('#chujupgbg').children();
			 child[1].style.color = 'white'
			  child[0].src = "./images/input-checked.png"
		 }
	
	 }
	   
	 else
	 {
	     obj.style.backgroundColor = 'rgb(239, 239, 239)';
		  if(obj == $('#chujuwangqian')[0])
		 {
			 var child = $('#chujuwangqian').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
		 }
		 else
		 {
			  var child = $('#chujupgbg').children();
			 child[1].style.color = '#969393'
			 child[0].src = "./images/input-unchecked.png"
		 }
	 }
  }
  
     nowChoice = 0;
	  $("#zq").click(function () {
		    $("#addApeend").empty();
			var str = '';
			console.info($(this));
			if ($(this).attr("checked"))
			{
				 var id = this.id;
				 console.info("id=" + id)
				 //自取
				 if(id == 'zq')
				 {
					 $('#zqdiv').removeAttr('hidden')
					  $('#psyhdiv').attr('hidden', 'hidden');
					   $('#kddiv').attr('hidden', 'hidden');
					 nowChoice = 1;
				 }
				 //银行
				 else if(id == 'psyh')
				 {
					  $('#psyhdiv').removeAttr('hidden')
					  $('#zqdiv').attr('hidden', 'hidden');
					   $('#kddiv').attr('hidden', 'hidden');
					 nowChoice = 1;
				 }
				 //快递
				 else if(id == 'kd')
				 {
					  $('#zqdiv').removeAttr('hidden')
					  $('#psyhdiv').attr('hidden', 'hidden');
					   $('#kddiv').attr('hidden', 'hidden');
					 nowChoice = 2;
					
				 }
				 
			}				  
	  });
  
  banlipinggu = function()
  {
	 if(!WQCommitShowTip())
		  return;
	  // str=str.replace('<span class="caret"></span>',"");
	  
	  
	  
	   var obj = {};
	   obj.url = 'http://www.allwinits.com/?service=Business.PutBusinessAssess';
	   obj.param = {};
	   obj.param.bid = bid;
	 
	   var str =  $('#dropdown-yh')[0].innerHTML;
	   obj.param.bank_name = str.replace('<span class="caret"></span>',"");
	   obj.param.house_out1_photo = imageSerIds.pgyw_house_photo1;
	   obj.param.house_out2_photo = imageSerIds.pgyw_house_photo2;
	   obj.param.house_out3_photo = imageSerIds.pgyw_house_photo3; 
	   obj.param.house_out4_photo = imageSerIds.pgyw_house_photo4;  
	   
	    obj.param.house_bedroom1_photo = imageSerIds.pgyw_house_in_photo1;
	   obj.param.house_bedroom2_photo = imageSerIds.pgyw_house_in_photo2;
	   obj.param.house_bedroom3_photo = imageSerIds.pgyw_house_in_photo3; 
	   
	     obj.param.house_living1_photo = imageSerIds.pgyw_house_kt_photo3;
	   obj.param.house_living2_photo = imageSerIds.pgyw_house_kt_photo3;
	   obj.param.house_living3_photo = imageSerIds.pgyw_house_kt_photo3; 
	   
	     obj.param.house_kitchen1_photo = imageSerIds.pgyw_house_cf_photo1;
	   obj.param.house_kitchen2_photo = imageSerIds.pgyw_house_cf_photo2;
	  // obj.param.house_kitchen3_photo = imageSerIds.pgyw_house_cf_photo3; 
	  
	        obj.param.house_toilet1_photo = imageSerIds.pgyw_house_wsj_photo1;
	   obj.param.house_toilet2_photo = imageSerIds.pgyw_house_wsj_photo2;
	 
	 
	   obj.func = function(data){
			
			 if(data.code == 0)
			 {
				   $('#pgbgdiv').attr('hidden', 'hidden');
	            $('#senddiv').removeAttr('hidden');
	            scrollTo(0,0);
			 }
			 else if(data.code == 1)
			 {
				 var tip = new showTip('用户未绑定');
				  tip.show();
			 }
			 else if(data.code == 2)
			 {
				   var tip = new showTip('角色未审核');
				   tip.show();
			 }
			 else
			 {
				var tip = new showTip('提交失败');
				tip.show();
			 }
		};
		
        Ajax(obj);
	  
	   
	 
  }
	  
	 
});




