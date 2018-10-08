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
        .pieBar{float:left; width:29%; height:100%;}
        .line{float:right; width:70%; height:100%;}
    </style>
</head>
<body>
<div class="container">
    <div class="pieBar">
        <div id="pie" style="width:100%; height:400px;"></div>
        <div id="pie2" style="width:100%; height:400px;"></div>
    </div>
    <div class="line">
        <div id="line" style="width:100%; height:50%;"></div>
        <div id="line2" style="width:100%; height:50%;"></div>
    </div>
</div>
</body>
<script type="text/javascript">
    let myChartPie = echarts.init(document.getElementById('pie'), 'macarons');
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
    // 获取年份封装
    function getyear (x) {
        let date = new Date();
        year = date.getFullYear();
        if (x) {
            year = date.getFullYear() - x;
        }
        return year;
    }
    myChartPie.setOption({
        title: {
            text: '全部病种对比'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'right',
            data:['其他','阴虱、疥疮', '男科性病', '尿道炎', '精液异常', '射精障碍', '阳痿', '早泄', '前列腺炎', '包皮包茎', '包皮龟头炎', '7月活动']
        },
        series: [
            {
                name:'病种',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:<?php echo ($result['其他']); ?>, name:'其他'},
                    {value:<?php echo ($result['阴虱、疥疮']); ?>, name:'阴虱、疥疮'},
                    {value:<?php echo ($result['男科性病']); ?>, name:'男科性病'},
                    {value:<?php echo ($result['尿道炎']); ?>, name:'尿道炎'},
                    {value:<?php echo ($result['精液异常']); ?>, name:'精液异常'},
                    {value:<?php echo ($result['射精障碍']); ?>, name:'射精障碍'},
                    {value:<?php echo ($result['阳痿']); ?>, name:'阳痿'},
                    {value:<?php echo ($result['早泄']); ?>, name:'早泄'},
                    {value:<?php echo ($result['前列腺炎']); ?>, name:'前列腺炎'},
                    {value:<?php echo ($result['包皮包茎']); ?>, name:'包皮包茎'},
                    {value:<?php echo ($result['包皮龟头炎']); ?>, name:'包皮龟头炎'},
                    {value:<?php echo ($result['7月活动']); ?>, name:'7月活动'}
                ]
            }
        ]
    });
    myChartLine.setOption({
        title: {
            text: '近3年详细数据(男女比例)'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['男','女']
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
            data: [getyear(2), getyear(1), getyear()]
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'男',
                type:'line',
                stack: '总量',
                data:[<?php echo ($yeardata['beforeSex'][0]['count']); ?>, <?php echo ($yeardata['lastSex'][0]['count']); ?>, <?php echo ($yeardata['currBoy'][0]['count']); ?>]
            },
            {
                name:'女',
                type:'line',
                stack: '总量',
                data:[<?php echo ($yeardata['beforeBoy'][0]['count']); ?>, <?php echo ($yeardata['lastBoy'][0]['count']); ?>, <?php echo ($yeardata['currGirl'][0]['count']); ?>]
            },
            {
                name:'总数',
                type:'line',
                stack: '总量',
                data:[<?php echo ($yeardata['beforeGirl'][0]['count']); ?>, <?php echo ($yeardata['lastGirl'][0]['count']); ?>, <?php echo ($yeardata['currSex'][0]['count']); ?>]
            },

        ]
    });

</script>
</html>