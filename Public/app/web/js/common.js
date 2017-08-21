$(function(){
	 console.info("common.js")
	 NetWait = function()
	{
		 this.show = function()
		{
			var leftDis =  document.body.clientWidth / 2 - 50;
			var topDis = $(window).height()/2 - 50;
			var str = '<div style = "position:absolute;left:' +leftDis + 'px;top:'   + topDis + 'px" class="ta_c"><img class="Rotation img" src="images/tjzp1.jpg" width="100" height="100"/><p style = "margin-top:30px;text-align:center;color:white;font-size:30px">加载中</p></div>' ;
			$('#showTip').append(str);
			
			$("#showTipBk").css('display','block'); 
			
		}
		
		this.close = function()
		{
			$('#showTip').empty();
			
			$("#showTipBk").css('display','none'); 
		}
		return this;
	}
	 
    Ajax = function (obj)
    {
		
		var netMask = new NetWait();
		netMask.show();
		
         var data = {};
         for(var i in obj.param)
         {
          data[i] = obj.param[i]
         }
   
        $.ajax(
           {
	      url : obj.url,
		  data,
		  type:'post',  
          cache:false,  
          dataType:'json', 
		  success:function(data) { 
		      
             netMask.close();
		 
             if(data.ret =="200" )
			 {  
		        obj.func(data.data);
             }
			 else
			 {  
                 alert("未知错误,错误码为" +data.ret + "。错误描述：" + data.msg );
             }  
         }, 
	    }
      );
    }
	 
	
	getUserInfo = function()
	{
		
		var obj = {};
		obj.url = 'http://www.allwinits.com/?service=User.Info';
		obj.param = {};
		obj.func = function(data){
			
			 if(data.code == 0)
			 {
				 $('#imagePhoto')[0].src = data.headimgurl;
				 $('#pName')[0].innerHTML = data.nickname;
				 if(data.roleid != null && data.roleid != undefined && data.mobile != null && data.mobile != undefined)
				 {
					 window.location.href='./userinfo.php';
				 }
			 }
			 else if(data.code == 1)
			 {
				 alert('用户未绑定');
			 }
		};
		Ajax(obj);
      
	}
	g_func = function(){};
	console.info(g_func);
	
	AutoSize = function (Img, maxWidth, maxHeight) {  
            var image = new Image();  
            //原图片原始地址（用于获取原图片的真实宽高，当<img>标签指定了宽、高时不受影响）  
            image.src = Img.src;    
            // 当图片比图片框小时不做任何改变   
            if (image.width < maxWidth&& image.height < maxHeight) {  
                Img.width = image.width;  
                Img.height = image.height;  
				console.info("a")
            }  
            else //原图片宽高比例 大于 图片框宽高比例,则以框的宽为标准缩放，反之以框的高为标准缩放  

        {  
            if (maxWidth/ maxHeight  <= image.width / image.height) //原图片宽高比例 大于 图片框宽高比例  
            {  
                Img.width = maxWidth;   //以框的宽度为标准  
                Img.height = maxWidth* (image.height / image.width);  
				console.info("ab")
            }   
            else {   //原图片宽高比例 小于 图片框宽高比例  
                Img.width = maxHeight  * (image.width / image.height);  
                Img.height = maxHeight  ;   //以框的高度为标准  
				console.info("abc")
            }  
        }  
}
	
	showBigImage = function(obj,url,width,height)
	{
		var show = new showImage(obj,url,width, height);
		show.show();
	}
	
	showImage = function(obj,url,width, height)
	{
		console.info(obj.id);
		console.info(url)
		this.image = url;
	    this.width = document.body.clientWidth * width;
		this.height = window.screen.height * height;
		this.top = window.screen.height - this.height;
		 this.show = function()
		 {
			var leftDis =  document.body.clientWidth / 2 - this.width / 2;
			var str = '<div  class = "text-center" style = "display:block;z-index:1000;position:absolute;width:' + this.width + 'px;height:' + this.height + 'px;left:' + leftDis + 'px;top:' +this.top/2 + 'px;">';// + this.tip + '</div>';
			
			str += '<image onclick = "closeTip()" style="position:relative" src =' + url + '></div>' ;
			console.info(str)
			$('#showTip').append(str);
			
			$("#showTipBk").css('display','block'); 
			var divp =  $('#showTip').children();
			var divc = divp.children();
			
			console.info(this.height + ';' + divc[0].style.height)
		
			
			AutoSize(divc[0],this.width,this.height)
			console.info(divc[0].width + ";" + divc[0].height + ";" + this.width + ";" + this.height)
				divc[0].style.top = (this.height - divc[0].height) / 2 + "px";
			
		 }
	}
	
	
	
		showTip = function(tip, func)
	{
		console.info(func);
		this.tip =tip;
		if(func != undefined)
		g_func = func;
		//console.info(this.tip);
		this.width = document.body.clientWidth * 0.7;
		this.height = window.screen.height * 0.3;
	    console.info("width =",this.width);
		 this.show = function()
		{
			var leftDis =  document.body.clientWidth / 2 - this.width / 2;
			var str = '<div  class = "text-center" style = "background-color:#ffffff;display:block;z-index:1000;position:absolute;width:' + this.width + 'px;height:' + this.height + 'px;left:' + leftDis + 'px;top:' +$(window).height()/3 + 'px;">';// + this.tip + '</div>';
			str += '<p class = "col-sm-12" style = "font-size:30px;margin-Top:20px">提示</p>'
			str += '<div class = "col-sm-12 " style = "top:10%;height:30%;font-size:20px"><p >' + this.tip + '</p>';
			str += '<div class = "col-sm-12"><hr style = "border-top: 2px solid #cce;margin:8px"></div></div>'
			str += '<button style = "font-size:30px;position: absolute;font-size: 24px; bottom: 3%;width: 40%;display: block;left: 30%;" type="button" class="btn btn-primary col-sm-4 " onclick = "closeTip()">确定</button></div>' ;
			console.info(str)
			$('#showTip').append(str);
			
			$("#showTipBk").css('display','block'); 
			
		}
		
		this.close = function()
		{
			g_func();
			$('#showTip').empty();
			
			$("#showTipBk").css('display','none'); 
		}
			return this;
	};
	
	closeTip = function(){
		g_func();
		$('#showTip').empty();
			
			$("#showTipBk").css('display','none'); 
	}
});