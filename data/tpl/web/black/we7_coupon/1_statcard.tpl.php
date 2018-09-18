<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	.account-stat-num > div{width:33.333%; float:left; font-size:16px; text-align:center;}
	.account-stat-num > div span{display:block; font-size:30px; font-weight:bold;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWeburl('statcard')?>">会员卡领卡统计</a></li>
</ul>
<div class="panel panel-default">
	<div class="panel-heading">
		会员卡统计
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>会员卡总数<span><?php  echo $total;?></span></div>
			<div>今日领卡<span><?php  echo $today;?></span></div>
			<div>昨日领卡<span><?php  echo $yesterday;?></span></div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		会员卡统计
	</div>
	<div class="panel-body" id="scroll">
		<div class="pull-left">
			<form action="" id="form1">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="do" value="statcard">
				<input type="hidden" name="m" value="we7_coupon">
				<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $starttime),'end' => date('Y-m-d', $endtime)), '')?>
				<input type="hidden" value="" name="scroll">
			</form>
		</div>
		<div style="margin-top:20px">
			<canvas id="myChart" width="1200" height="300"></canvas>
		</div>
	</div>
</div>
<script>
	require({
		paths: {
			'chart': '../../../../addons/we7_coupon/template/style/js/chart.min'
		}
	})
	require(['chart', 'daterangepicker'], function(c) {
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			$('#form1')[0].submit();
		});
		var chart = null;
		var templates = {
			label: '领卡数',
			fillColor : "rgba(149,192,0,0.1)",
			strokeColor : "rgba(149,192,0,1)",
			pointColor : "rgba(149,192,0,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(149,192,0,1)"
		};

		var url = location.href + '&#aaaa';
		$.post(url, function(data){
			var data = $.parseJSON(data)
			var datasets = data.datasets;

			if(!chart) {
				var label = data.label;
				console.dir(label);
				templates.data = datasets;
				var lineChartData = {
					labels : label,
					datasets : [templates]
				};

				var ctx = document.getElementById("myChart").getContext("2d");
				chart = new Chart(ctx).Line(lineChartData, {
					responsive: true
				});
			}
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>