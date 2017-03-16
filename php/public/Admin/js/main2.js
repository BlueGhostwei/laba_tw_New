$(function(){
	
//	首页幻灯片
	if( $(".slideBox").length>0 ){
		$(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,delayTime:700});
	}

	
// 首页投放分布
if( $("#tb1").length>0 ){
	var myChart = echarts.init(document.getElementById('tb1'));
	// 指定图表的配置项和数据
	var option = {
		title: {
			text: ''
		},
		tooltip : {
			trigger: 'axis',
			axisPointer : {            // 坐标轴指示器，坐标轴触发有效
				type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
			}
		},
		legend: {
			data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎','百度','谷歌','必应','其他']
		},
		grid: {
			left: '3%',
			right: '4%',
			bottom: '3%',
			containLabel: true
		},
		xAxis : [
			{
				type : 'category',
				data : ['周一','周二','周三','周四','周五','周六','周日']
			}
		],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : [
			{
				name:'直接访问',
				type:'bar',
				data:[320, 332, 301, 334, 390, 330, 320]
			},
			{
				name:'邮件营销',
				type:'bar',
				stack: '广告',
				data:[120, 132, 101, 134, 90, 230, 210]
			},
			{
				name:'联盟广告',
				type:'bar',
				stack: '广告',
				data:[220, 182, 191, 234, 290, 330, 310]
			},
			{
				name:'视频广告',
				type:'bar',
				stack: '广告',
				data:[150, 232, 201, 154, 190, 330, 410]
			},
			{
				name:'搜索引擎',
				type:'bar',
				data:[862, 1018, 964, 1026, 1679, 1600, 1570],
				markLine : {
					lineStyle: {
						normal: {
							type: 'dashed'
						}
					},
					data : [
						[{type : 'min'}, {type : 'max'}]
					]
				}
			},
			{
				name:'百度',
				type:'bar',
				barWidth : 5,
				stack: '搜索引擎',
				data:[620, 732, 701, 734, 1090, 1130, 1120]
			},
			{
				name:'谷歌',
				type:'bar',
				stack: '搜索引擎',
				data:[120, 132, 101, 134, 290, 230, 220]
			},
			{
				name:'必应',
				type:'bar',
				stack: '搜索引擎',
				data:[60, 72, 71, 74, 190, 130, 110]
			},
			{
				name:'其他',
				type:'bar',
				stack: '搜索引擎',
				data:[62, 82, 91, 84, 109, 110, 120]
			}
		]
	};
	// 使用刚指定的配置项和数据显示图表。
	myChart.setOption(option);	
}

//首页任务管理
	$(".tab1>ul>li>a").click(function(){
		var index=$(this).parent("li").index();
		$(this).parent("li").addClass("cur").siblings("li").removeClass("cur");
		$(this).parents(".tab1").next(".tab1_body").find("table").removeClass("cur").eq(index).addClass("cur");
		return false;
	});


/*	首页表格排序	*/
if( $('#datatable1').length>0 ){
	$('#datatable1').DataTable({
		"searching" : false,
		"paging" : false,
		"lengthChange" : false,
		"info" : false,
		"columnDefs" : [{
        	"targets": 'nosort',
			"orderable": false
		}],
		"order" : [[0,"asc"]]
	});
}
/*	
	$('.data-table').dataTable({
        "searching": false,  //是否允许Datatables开启本地搜索
        "paging": false,  //是否开启本地分页
        "lengthChange": false,  //是否允许用户改变表格每页显示的记录数
        "info": false,   //控制是否显示表格左下角的信息
        "columnDefs": [{
            "targets": 'nosort',  //列的样式名
            "orderable": false    //包含上样式名‘nosort’的禁止排序
        }],
        //跟数组下标一样，第一列从0开始，这里表格初始化时，第四列默认降序
        "order": [3]  //asc升序   desc降序  "order": [[ 3, "desc" ]]默认第四列为降序排列
    });
*/


/*	媒体供应商_活动订单	*/
/*	$(".nav_hdorder .tab li a").click(function(){
		$(this).parent("li").addClass("cur").siblings("li").removeClass("cur");
		return false;
	});
*/







});	


//	首页搜索条左边时间
function showtime(){
	var now = new Date();
	var nmonth = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][now.getMonth()];		//月份 0-11
	var nday = ['Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat'][now.getDay()];		//星期	Tue
	var ndate = now.getDate();		//日期	18
	var nampm = now.getHours() < 12 ? 'AM' : 'PM';			//上午下午	
	var ntime = now.getHours()+":"+now.getMinutes();	//+":"+now.getSeconds();			//时间	18:20
	$(".s_date").html('<span class="sp1"><span>'+nday+'</span><b>'+ndate+'</b><i>'+nmonth+'</i></span><span class="sp2"><span>'+nampm+'</span><b>'+ntime+'</b></span>');
	setTimeout(function(){
		showtime();
	},1000);
}





function SetFrameHeight(o) {
       var mainheight = $(o).contents().find("body").children("div").height() + 30;
       $(o).height(mainheight);
 }










