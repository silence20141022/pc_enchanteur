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
</head>
<body>
<script type="text/javascript">
    Ext.onReady(function () {
        var store = Ext.create('Ext.data.JsonStore', {
            fields: ['pc_detail', 'pc_arrive', 'wap_detail', 'wap_arrive', 'datestr'],
            pageSize: 30,
            proxy: {
                type: 'ajax',
                url: '/index.php?c=Admin&a=loadreport',
                reader: {
                    type: 'json',
                    totalProperty: 'total',
                    root: 'data'
                }
            },
            autoLoad: true
        });
        var pgbar = Ext.create('Ext.toolbar.Paging', {
            displayMsg: '显示 {0} - {1} 条,共计 {2} 条',
            store: store,
            displayInfo: true
        });
        var gridpanel = Ext.create('Ext.grid.Panel', {
            title: '报表统计',
            region: 'center',
            store: store,
            selModel: {selType: 'checkboxmodel'},
            bbar: pgbar,
            columns: [
                {xtype: 'rownumberer', width: 35},
                {header: '日期', dataIndex: 'datestr', width: 180},
                {header: 'PC端监控代码访问数', dataIndex: 'pc_arrive', width: 180},
                {header: 'WAP端监控代码访问数', dataIndex: 'wap_arrive', width: 180},
                {header: '查看PC端访问明细', dataIndex: 'pc_detail', width: 120,renderer:render},
                {header: '查看WAP端访问明细', dataIndex: 'wap_detail', width: 120,renderer:render}
            ],
            listeners: {
                cellclick: function (gd, td, cellIndex, record, tr, rowIndex, e, eOpts) {
                    if (cellIndex == 5 ) {
                        reportdetail(record.get("datestr"),'enchanteur_pc');
                    }
                    if (cellIndex ==6 ) {
                        reportdetail(record.get("datestr"),'enchanteur_m');
                    }
                }
            }
        });
        var viewport = Ext.create('Ext.container.Viewport', {
            layout: 'border',
            items: [gridpanel]
        });
    });
    function render(value, cellmeta, record, rowIndex, columnIndex, store) {
        var rtn = "";
        var dataindex = cellmeta.column.dataIndex;
        switch (dataindex) {
            case "pc_detail":
            case "wap_detail":
                    rtn = '<span class="glyphicon glyphicon-list"></span>';
                break;
        }
        return rtn;
    }
    function reportdetail(datestr,code2) {
        Ext.Ajax.request({
            url: '/index.php?c=Admin&a=loadreportdetail',
            params: {datestr: datestr,code2:code2},
            success: function (response, option) {
                var data=Ext.decode(response.responseText);
                var store_detail = Ext.create('Ext.data.JsonStore', {
                    fields: ['id', 'datestr', 'code1', 'code2', 'code3', 'times'],
                    data:data
                });
                var gridpanel_detail = Ext.create('Ext.grid.Panel', {
                    region: 'center',
                    store: store_detail,
                    selModel: {selType: 'checkboxmodel'},
                    columns: [
                        {xtype: 'rownumberer', width: 35},
                        {header: '日期', dataIndex: 'datestr', width: 90},
                        {header: 'CODE1', dataIndex: 'code1', width: 110},
                        {header: 'CODE2', dataIndex: 'code2', width: 110},
                        {header: 'CODE3', dataIndex: 'code3', flex:1},
                        {header: '访问次数', dataIndex: 'times', width: 80}
                    ]
                });
                var win = Ext.create("Ext.window.Window", {
                    title: "访问明细",
                    width: 820,
                    height: 500,
                    closeAction: 'destroy',
                    layout: "border",
                    modal: true,
                    items: [gridpanel_detail]
                });
                win.show();
            }
        });
    }
</script>
</body>
</html>