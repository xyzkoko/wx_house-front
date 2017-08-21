
$(function(){
	 getPosition = function(){
				
		 wx.getLocation({
             type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
    success: function (res) {
        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
        var speed = res.speed; // 速度，以米/每秒计
        var accuracy = res.accuracy; // 位置精度
		

			
		
    var ggPoint = new BMap.Point(longitude,latitude);

    //地图初始化
    var bm = new BMap.Map("bdmap");
    bm.centerAndZoom(ggPoint, 15);
    bm.addControl(new BMap.NavigationControl());

    //添加gps marker和label
    var markergg = new BMap.Marker(ggPoint);
    bm.addOverlay(markergg); //添加GPS marker
    var labelgg = new BMap.Label("未转换的GPS坐标（错误）",{offset:new BMap.Size(20,-10)});
    markergg.setLabel(labelgg); //添加GPS label

    //坐标转换完之后的回调函数
    translateCallback = function (data){
		
      if(data.status === 0) {
			
		  console.info("daaaa=", data)
         data.points[0].lat;
		 data.points[0].lng;
		 		var aj = $.ajax( {  
        url:'http://api.map.baidu.com/geocoder/v2/?ak=btsVVWf0TM1zUBEbzFz6QqWF&location=' +  data.points[0].lat + ',' +  data.points[0].lng + '&output=json&pois=0',// 跳转到 action  
  
    type:'get',  
   
   dataType: "jsonp",
    success:function(ops) {  
	  
	   $('#address')[0].value = ops.result.formatted_address + ops.result.sematic_description
     },  
     error : function() {  
          // view("异常！");  
        //  alert("异常！");  
     }  
     });
		
      }
    }

    setTimeout(function(){
        var convertor = new BMap.Convertor();
        var pointArr = [];
        pointArr.push(ggPoint);
			
        convertor.translate(pointArr, 1, 5, translateCallback)
    }, 1000);

		//alert(latitude);
	
		
		
     }
		 });
	 }
	 
	 	 
	 /**
 * 获取serviceId
 * @param localId1 本地id
 * @param colname 列名
 * @param tablename 表名
 * @param filename 文件名
 */
    upImg = function(localId, name){
		
	wx.uploadImage({
		localId : localId.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得
		isShowProgressTips : 1, // 默认为1，显示进度提示
		success : function(res) {
			var serverId = res.serverId; // 返回图片的服务器端ID
			if(name == "mtzp_button")
			{
				mtzp_serverId = serverId;
			}
			else 
				yyzz_serverId = serverId;
			
			
		//	$('#mgbd')[0].innerHTML = serverId;
			//downloadImage(localId1.toString(),serverId,colname,tablename,filename,fileform,remark);
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
downloadImage = function(localId1,serverId,colname,tablename,filename,fileform,remark){
		$.ajax({
			type : "POST",
			url :  'http://www.allwinits.com/?service=WeiChat.PostImage',
			data:{type:'ss',media_id:serverId},
			async : false,
			success : function(result) {
				  $('#yyzz_button')[0].src = 'data:image/jpg;base64,' + result;
		
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
    yyzz_serverId = 0, mtzp_serverId = 0;
    getImage = function(obj, id)
	{   
	
		 wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
				console.info("res = ",res);
              var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			
			 obj.src = localIds
			  upImg(localIds, id);
           }
       });
	}
	
	
	
	 
	 ChangeInfo = function()
	 {
		
	
		var show ;
		if(yyzz_serverId == 0)
		{
			show = showTip('请上传营业执照')
            show.show();
            return ;			
		}
		else if(mtzp_serverId == 0)
		{
			show = showTip('请上传门头照')
            show.show();
            return ;
		}
		else if($("#address")[0].value == "")
		{
				show = showTip('地址不能为空！')
            show.show();
            return ;
		}
		var netMask = new NetWait();
		netMask.show();
		
		 var aj = $.ajax( {  
        url:'http://www.allwinits.com/?service=Role.PutBrokerInfo',// 跳转到 action  
    data:{  
         licence_photo: yyzz_serverId,
         head_photo: mtzp_serverId,
         address:$("#address")[0].value		 
     },  
    type:'post',  
    cache:false,  
	async: true,
    dataType:'json',  
    success:function(data) { 
        
		netMask.close();
	     if(data.ret =="200" ){
			
			 if(data.data.code == 0)
			 {
				new showTip("修改成功,等待管理人员审核！", function(){  window.location.href='./userinfo.php';}).show();
			 }
			 else if(data.data.code == 1)
			 {
				new showTip("您还未绑定手机！").show();
			 }
			 else if(data.data.code == 2)
			 {
				new showTip("每周只能修改一次！").show();
			 }
			 else if(data.data.code == 3)
			 {
				 new showTip("图片上传错误！").show();
			 }
			 else
			 {
				  new showTip("出现异常，请重试！").show();
			 }
		 }
     },  
     error : function() {  
         
     }  
     });
	 }
	
	 setTimeout(function(){getPosition()}, 200);
	 
	 });