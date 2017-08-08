<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/Public/Extjs42/resources/css/ext-all-gray.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/Extjs42/bootstrap.js" type="text/javascript"></script>
        <link href="/Public/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/pan.js" type="text/javascript"></script>
        <link href="/Public/bootstrap32/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/jquery-2.1.1.min.js" type="text/javascript"></script>  
        <script src="/Public/bootstrap32/js/bootstrap.js" type="text/javascript"></script>
        <link href="/Public/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
        <style>
            body,html{
                font-family:'Microsoft YaHei','Hiragino Sans GB',Helvetica,Arial,'Lucida Grande',sans-serif !important;
            }
            .list-group-item:first-child {
                border-top-left-radius: 0px;
                border-top-right-radius: 0px;
            }
            .list-group-item:last-child {
                margin-bottom: 0;
                border-bottom-right-radius: 0px; 
                border-bottom-left-radius: 0px;  
            }
        </style>
        <script type="text/javascript">
            Ext.onReady(function() {
                var menu_html =
                        '<a id="menu_spcenter"  class="list-group-item">特价中心</a>' +
                        '<a id="menu_nspcenter"  class="list-group-item">新特价中心(PC)</a>' +
                        '<a id="menu_wapspcenter"  class="list-group-item">新特价中心(WAP)</a>' +
                        '<a id="menu_article"  class="list-group-item">文章管理</a>' +
                      /*  '<a id="menu_statistics"  class="list-group-item">网站统计</a>' +*/
                        '<a id="menu_report"  class="list-group-item">监控代码访问统计</a>'+
                        '<a id="menu_config"  class="list-group-item">常用配置</a>';
                var panel = Ext.create('Ext.panel.Panel', {
                    region: 'west',
                    width: 200,
                    title: '功能菜单',
                    html: menu_html
                });
                var panel_top = Ext.create('Ext.panel.Panel', {
                    region: 'north',
                    height: 80,
                    html: '<div><table class="table"><tr><td style="width:50%"><img src="/Public/img/logo.png"/></td>' +
                            '<td style="width:40%;vertical-align: middle"><span style="font-size:15px;font-weight:bold;color:gray">艾诗官网-后台管理</span></td>' +
                            '<td style="text-align:right;width:10%;vertical-align: middle;padding-right:10px"><a style="cursor: pointer" id="log_out"><i class="icon iconfont">&#xe609;</i>退出</a></td></tr><table></div>'
                });
                var viewport = new Ext.container.Viewport({
                    layout: 'border',
                    items: [panel_top, panel,
                        {
                            region: 'center',
                            layout: 'fit',
                            id: 'mainContent',
                            collasible: true,
                            margin: '-1 0 0 0',
                            contentEl: 'contentIframe'
                        }]
                });
                //模板加载特价中心
                Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=splist';
                $("#menu_spcenter").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=splist';
                });
                $("#menu_nspcenter").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=nspcenter';
                });
                $("#menu_wapspcenter").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=wapnspcenter';
                });
                $("#menu_article").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=articlelist';
                });
               /* $("#menu_statistics").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=statistics';
                });*/
                $("#menu_report").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=report';
                });
                $("#menu_config").click(function() {
                    Ext.getDom("contentIframe").src = '/index.php?c=Admin&a=webconfig';
                });
                $("#log_out").click(function() {
                    $.ajax({
                        url: "/index.php?c=Admin&a=logout",
                        success: function(result) {
                            if (result) {
                                window.location.href = '/index.php?c=Index&a=login';
                            }
                        }
                    });
                });

            });
        </script>
    </head>
    <body> 
        <iframe id="contentIframe" width="100%" height="100%" name="mainContent" frameborder="no" border="0" marginwidth="0" marginheight="0"></iframe>
    </body>
</html>