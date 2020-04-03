<div class="content-page">
    <!-- start content -->
	<div class="content">
		<!-- container -->
        <div class="container">
            <section class="content-header">
              <h1>
                모니터링 상세보기
                <button class="btn btn-inverse fright" onclick="history.back()">목록</button>
              </h1>
            </section>
			<!--/ 모니터링 -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<h5 class="header-title m-t-0">
							<b>모니터링 현황</b>
						</h5>
                        <hr class="m-t-0">
                        <div class="monitor_view <?=( $storage_data[ 0 ]['temp_state'] == 'W' )? 'danger_box' : 'normal_box'?>">
                            <div class="temp_wrap">
                                <span class="temp_tit"><?=$storage_name?></span>
                                <strong class="temp_txt"><?=$storage_data[ 0 ]['temperature']?>℃</strong>
                            </div>
                            <p class="temp_time">최종측정시각 : <?=$storage_data[ 0 ]['reg_date']?></p>
                        </div>
                        <div class="monitor_wrap">
                            <div id="chart_div" style="height:660px;"></div>
                        </div>
					</div>
				</div>
			</div>
			<!-- // 모니터링 -->

		</div><!-- container -->
	</div><!-- content -->
</div><!-- content-page -->
<style>
.monitor_wrap {position: relative; overflow-x: scroll;}
</style>
<script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

var log_data = <?=jsonReturn( $storage_data )?>;
var chart_data = [];
chart_data.push(['시간','온도','MAX', 'MIN']);

log_data = log_data.reverse();

// console.log( log_data );

for(var item of log_data ) {    
    chart_data.push([item.reg_date.substr(5,11), parseFloat( item.temperature ), parseFloat(item.max_temperature), parseFloat(item.min_temperature)]);
}

console.log( chart_data );

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {
	var options = {
        hAxis: { title: '시간', minValue: 0},
		vAxis: { title: '온도', minValue: -20},
        // 그래프 선 설정(MIN, MAX)
		series: {
			1:{ lineWidth:1, color:'red', areaOpacity: 0 },
		    2:{ lineWidth:1, areaOpacity: 0 }
		},
        width:1800,
        height:650,
        // 차트 영역 설정(위치,크기 등)
        chartArea:{left:50,top:100,width:'95%',height:'70%'},
        // 항목 영역 설정(온도, MIN, MAX)
        legend: {position: 'bottom', textStyle: {color: '#444', fontSize: 16}}
	};
    // 데이터
	// var data = google.visualization.arrayToDataTable([
    //     ['시간','온도','MAX', 'MIN'],
    //     ['09:00', 2.4 ,5, -3],
    //     ['09:10', 3.2 ,5, -3],
    //     ['09:20', 2.1 ,5, -3],
    //     ['09:30', 1.6 ,5, -3],
    //     ['09:40', 2.4 ,5, -3],
    //     ['09:50', 3.6 ,5, -3],
    //     ['10:00', 2.2 ,5, -3],
    //     ['10:10', 2.6 ,5, -3],
    //     ['10:20', 4.2 ,5, -3],
    //     ['10:30', 2.7 ,5, -3],
    //     ['10:40', 1.6 ,5, -3],
    //     ['10:50', 4.1 ,5, -3],
    //     ['11:00', 2.7 ,5, -3],
    //     ['11:10', 2.8 ,5, -3],
    //     ['11:20', 3.4 ,5, -3],
    //     ['11:30', 1.8 ,5, -3],
    //     ['11:40', 1.6 ,5, -3],
    //     ['11:50', 3.4 ,5, -3]
    //     ]);

    var data = google.visualization.arrayToDataTable( chart_data );

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
</script>