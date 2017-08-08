<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/Public/Extjs42/resources/css/ext-all-gray.css" rel="stylesheet" type="text/css"/>
        <script src="/Public/Extjs42/bootstrap.js" type="text/javascript"></script> 
        <link href="/Public/bootstrap32/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>   
        <script src="/Public/pan.js" type="text/javascript"></script> 
    </head>
    <body>
        <script type="text/javascript">
            var store_cat;
            Ext.onReady(function() {
                var toolbar = Ext.create('Ext.toolbar.Toolbar', {
                    items: [
                        {
                            text: '<span class="glyphicon glyphicon-plus"></span>&nbsp;添加', handler: function() {
                                window.location.href = "/index.php?c=Admin&a=articleedit";
                            }
                        }
                        , '-', {
                            text: '<span class="glyphicon glyphicon-edit"></span>&nbsp;修改', handler: function() {
                                var recs = gridpanel.getSelectionModel().getSelection();
                                if (!recs || recs.length <= 0) {
                                    Ext.Msg.alert("提示", "请选择修改记录!");
                                    return;
                                }
                                window.location.href = "/index.php?c=Admin&a=articleedit&article_id=" + recs[0].get('article_id');
                            }
                        }
                        , '-', {
                            text: '<span class="glyphicon glyphicon-trash"></span>&nbsp;删除', handler: function() {
                                var recs = gridpanel.getSelectionModel().getSelection();
                                if (recs.length == 0) {
                                    Ext.Msg.alert("提示", "请选择要删除的记录!");
                                    return;
                                }
                                Ext.Ajax.request({
                                    url: '/index.php?c=Admin&a=delarticle',
                                    params: {article_id: recs[0].get("article_id")},
                                    success: function(response, option) {
                                        if (response.responseText) {
                                            Ext.Msg.alert("提示", "删除成功!");
                                            store.remove(recs[0]);
                                        }
                                    }
                                });
                            }
                        }
                    ]
                });
                //为了文章类型中文显示特初始化的store
                store_cat = Ext.create('Ext.data.JsonStore', {
                    fields: ['code', 'name'],
                    data: [{code: '107', name: '品牌资讯'}, {code: '108', name: '真男人魅力'}, {code: '2', name: '品牌故事'}]
                });
                var store = Ext.create('Ext.data.JsonStore', {
                    fields: ['article_id', 'title', 'content', 'is_open', 'cat_id', 'add_time', 'link', 'img_url', 'lastupdatetime', 'description'],
                    pageSize: 20,
                    proxy: {
                        type: 'ajax',
                        url: '/index.php?c=Admin&a=articleload',
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
                    title: '文章管理',
                    region: 'center',
                    store: store,
                    tbar: toolbar,
                    selModel: {selType: 'checkboxmodel'},
                    bbar: pgbar,
                    columns: [
                        {xtype: 'rownumberer', width: 35},
                        {header: 'article_id', dataIndex: 'article_id', hidden: true},
                        {header: '标题', dataIndex: 'title', width: 150, flex: 1},
                        {header: '文章类型', dataIndex: 'cat_id', width: 100, renderer: render},
                        {header: '是否发布', dataIndex: 'is_open', width: 80, renderer: render},
                        {header: '缩略图文件', dataIndex: 'img_url', width: 170},
                        {header: '发布时间', dataIndex: 'add_time', width: 140},
                        {header: '最后更新时间', dataIndex: 'lastupdatetime', width: 140}
                    ]
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
                    case "is_open":
                        rtn = value == 1 ? "是" : "否";
                        break
                    case "cat_id":
                        var rec = store_cat.findRecord('code', value);
                        rtn = rec.get("name");
                        break;
                }
                return rtn;
            }
        </script>  
    </body>
</html>