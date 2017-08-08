<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/Public/Extjs42/resources/css/ext-all-gray.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/Extjs42/bootstrap.js" type="text/javascript"></script> 
        <script src="/Public/pan.js" type="text/javascript"></script>
        <link href="/Public/bootstrap32/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/jquery-2.1.1.min.js" type="text/javascript"></script>  
        <script src="/Public/bootstrap32/js/bootstrap.js" type="text/javascript"></script>
        <script src="/Public/echart/echarts-all.js" type="text/javascript"></script>
    </head>
    <body>
        <script type="text/javascript">
            Ext.onReady(function() {
                Ext.Ajax.request({
                    url: '/index.php?c=Admin&a=loadstatistics',
                    method: "POST",
                    success: function(response, option) {
                        var json_result = Ext.decode(response.responseText);
                        inichart1(json_result);
                    }
                });
            });
            function inichart1(chartdata) {
                var xAxis = [];
                var seriesdata1 = [];
                var seriesdata2 = [];
                var seriesdata3 = [];
                var seriesdata4 = [];
                Ext.each(chartdata, function(item) {
                    xAxis.push(item.date);
                    seriesdata1.push(item.pc_visit);
                    seriesdata2.push(item.pc_arrive);
                    seriesdata3.push(item.wap_visit);
                    seriesdata4.push(item.wap_arrive);
                })
                var itemstyle = {
                    normal: {
                        label: {
                            show: true,
                            position: 'top'
                        }
                    }
                };
                var option1 = {
                    title: {
                        text: 'ENCHANTEUR访问量实时统计'                        
                    },
                    legend: {
                        data: ['PC端访问量', 'PC端到达量', 'WAP端访问量', 'WAP端到达量']
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: xAxis
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    grid: {
                        x: 50,
                        y: 70,
                        x2: 20,
                        y2: 30
                                // width: {totalWidth} - x - x2,
                                // height: {totalHeight} - y - y2,
                                // backgroundColor: 'rgba(0,0,0,0)',
                                //borderWidth: 1,
                                //borderColor: '#ccc'
                    },
                    series: [
                        {
                            name: 'PC端访问量',
                            type: 'bar',
                            data: seriesdata1,
                            itemStyle: itemstyle
                        },
                        {
                            name: 'PC端到达量',
                            type: 'bar',
                            data: seriesdata2,
                            itemStyle: itemstyle
                        },
                        {
                            name: 'WAP端访问量',
                            type: 'bar',
                            data: seriesdata3,
                            itemStyle: itemstyle
                        },
                        {
                            name: 'WAP端到达量',
                            type: 'bar',
                            data: seriesdata4,
                            itemStyle: itemstyle
                        }
                    ]
                };
                var myChart1 = echarts.init(document.getElementById("chart_1"));
                myChart1.setOption(option1);
            }
        </script>
        <div id="chart_1" style="height:500px;"> </div>
    </body>
</html>