<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="<?php echo ($staticPath); ?>/js/echart.js"></script>
    <script src="<?php echo ($staticPath); ?>/js/macarons.js"></script>
    <title>月趋势报表</title>
    <style>
        .container{height:800px; width:100%; position:fixed; top:0; left:0; bottom:0; right:0; margin:auto;}
        .pieBar{float:left; width:30%; height:100%;}
        .line{float:right; width:70%; height:100%;}
    </style>
</head>
<body>
    <div class="container">
        <div class="pieBar">
            <div id="pie" style="width:100%; height:400px;"></div>
            <div id="bar" style="width:100%; height:400px;"></div>
        </div>
        <div class="line">
            <div id="line" style="width:100%; height:100%;"></div>
        </div>
    </div>
</body>
<script type="text/javascript">
    let myChartPie = echarts.init(document.getElementById('pie'), 'macarons');
    let myChartBar = echarts.init(document.getElementById('bar'), 'macarons');
    let myChartLine = echarts.init(document.getElementById('line'), 'macarons');
    let date = new Date();
    // 获取月份封装
    function getTime (x) {
        let date = new Date();
        date.setMonth((date.getMonth() + 1) - x);
        let year = date.getFullYear();
        let month = date.getMonth() + 1;

        if (month < 10) {
            month = '0' + month;
        }

        return year + '-' + month;
    }



    // 使用刚指定的配置项和数据显示图表。
    myChartPie.setOption({
        title: {
            text: '本月数据'
        },
        tooltip: {},
        legend: {
            orient: 'vertical',
            x: 'right',
            data: ['预约', '预到', '已到', '未到', '全流失', '半流失', '已诊治'],
        },
        series: [
            {
                name: '本月数据',
                type: 'pie',
                radius: '55%',
                data: [
                    {value: <?php echo ($currMonthReser[0]['count']); ?>, name: '预约'},
                    {value: <?php echo ($currMonthAdvan[0]['count']); ?>, name: '预到'},
                    {value: <?php echo ($currMonthArrival[0]['count']); ?>, name: '已到'},
                    {value: <?php echo ($currMonthOutArrival[0]['count']); ?>, name: '未到'},
                    {value: <?php echo ($currMonthTotal[0]['count']); ?>, name: '全流失'},
                    {value: <?php echo ($currMonthHalf[0]['count']); ?>, name: '半流失'},
                    {value: <?php echo ($currMonthTreat[0]['count']); ?>, name: '已诊治'}
                ],
            }
        ],
    });

    // 柱状图
    myChartBar.setOption({
        tooltip: {},
        legend: {
            data: ['本月数据'],
        },
        xAxis: {
            data: ['预约', '预到', '已到', '未到', '全流失', '半流失', '已诊治'],
        },
        yAxis: {},
        series: [{
            name: '本月数据',
            type: 'bar',
            data: [<?php echo ($currMonthReser[0]['count']); ?>, <?php echo ($currMonthAdvan[0]['count']); ?>, <?php echo ($currMonthArrival[0]['count']); ?>, <?php echo ($currMonthOutArrival[0]['count']); ?>, <?php echo ($currMonthTotal[0]['count']); ?>, <?php echo ($currMonthHalf[0]['count']); ?>, <?php echo ($currMonthTreat[0]['count']); ?>],
        }],
    });

    // 趋势线性图
    myChartLine.setOption({
        title: {
            text: '近7个月的数据'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['预约', '预到', '已到', '未到', '全流失', '半流失', '已诊治']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: [getTime(7), getTime(6), getTime(5), getTime(4), getTime(3), getTime(2), getTime(1)]
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'预约',
                type:'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthReser'][0]['count']); ?>, <?php echo ($month['fiveMonthReser'][0]['count']); ?>, <?php echo ($month['fourMonthReser'][0]['count']); ?>, <?php echo ($month['threeMonthReser'][0]['count']); ?>, <?php echo ($month['twoMonthReser'][0]['count']); ?>, <?php echo ($month['oneMonthReser'][0]['count']); ?>, <?php echo ($currMonthReser[0]['count']); ?>]
            },
            {
                name:'预到',
                type:'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthAdvan'][0]['count']); ?>, <?php echo ($month['fiveMonthAdvan'][0]['count']); ?>, <?php echo ($month['fourMonthAdvan'][0]['count']); ?>, <?php echo ($month['threeMonthAdvan'][0]['count']); ?>, <?php echo ($month['twoMonthAdvan'][0]['count']); ?>, <?php echo ($month['oneMonthAdvan'][0]['count']); ?>, <?php echo ($currMonthAdvan[0]['count']); ?>,]
            },
            {
                name:'已到',
                type:'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthArrival'][0]['count']); ?>, <?php echo ($month['fiveMonthArrival'][0]['count']); ?>, <?php echo ($month['fourMonthArrival'][0]['count']); ?>, <?php echo ($month['threeMonthArrival'][0]['count']); ?>, <?php echo ($month['twoMonthArrival'][0]['count']); ?>, <?php echo ($month['oneMonthArrival'][0]['count']); ?>, <?php echo ($currMonthArrival[0]['count']); ?>,]
            },
            {
                name:'未到',
                type:'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthOutArrival'][0]['count']); ?>, <?php echo ($month['fiveMonthOutArrival'][0]['count']); ?>, <?php echo ($month['fourMonthOutArrival'][0]['count']); ?>, <?php echo ($month['threeMonthOutArrival'][0]['count']); ?>, <?php echo ($month['twoMonthOutArrival'][0]['count']); ?>, <?php echo ($month['oneMonthOutArrival'][0]['count']); ?>, <?php echo ($currMonthOutArrival[0]['count']); ?>]
            },
            {
                name:'全流失',
                type:'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthTotal'][0]['count']); ?>, <?php echo ($month['fiveMonthTotal'][0]['count']); ?>, <?php echo ($month['fourMonthTotal'][0]['count']); ?>, <?php echo ($month['threeMonthTotal'][0]['count']); ?>, <?php echo ($month['twoMonthTotal'][0]['count']); ?>, <?php echo ($month['oneMonthTotal'][0]['count']); ?>, <?php echo ($currMonthTotal[0]['count']); ?>]
            },
            {
                name: '半流失',
                type: 'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthHalf'][0]['count']); ?>, <?php echo ($month['fiveMonthHalf'][0]['count']); ?>, <?php echo ($month['fourMonthHalf'][0]['count']); ?>, <?php echo ($month['threeMonthHalf'][0]['count']); ?>, <?php echo ($month['twoMonthHalf'][0]['count']); ?>, <?php echo ($month['oneMonthHalf'][0]['count']); ?>, <?php echo ($currMonthHalf[0]['count']); ?>]
            },
            {
                name: '已诊治',
                type: 'line',
                stack: '总量',
                data:[<?php echo ($month['sixMonthTreat'][0]['count']); ?>, <?php echo ($month['fiveMonthTreat'][0]['count']); ?>, <?php echo ($month['fourMonthTreat'][0]['count']); ?>, <?php echo ($month['threeMonthTreat'][0]['count']); ?>, <?php echo ($month['twoMonthTreat'][0]['count']); ?>, <?php echo ($month['oneMonthTreat'][0]['count']); ?>, <?php echo ($currMonthTreat[0]['count']); ?>]
            }
        ]
    });

</script>
</html>