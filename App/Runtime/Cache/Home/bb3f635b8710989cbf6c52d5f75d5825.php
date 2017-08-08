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
        <script src="/Public/plupload.full.min.js" type="text/javascript"></script>
        <link href="/Public/bootstrap32/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>       
        <script src="/Public/jquery-1.12.0.min.js" type="text/javascript"></script>           
    </head>
    <body>
        <script type="text/javascript">
            Ext.onReady(function() {
                var field_id = Ext.create('Ext.form.field.Hidden', {
                    name: 'config_id'
                });
                var field_carousel_interval = Ext.create('Ext.form.field.Text', {
                    name: 'carousel_interval',
                    fieldLabel: '轮播图时间间隔/毫秒',
                    labelWidth: 150,
                    allowBlank: false,
                    blankText: '时间间隔不能为空!'
                });
                var formpanel = Ext.create('Ext.form.Panel', {
                    title: '网站基础参数配置',
                    region: 'center',
                    fieldDefaults: {
                        margin: '10 10 0 10',
                        msgTarget: 'under'
                    },
                    items: [field_carousel_interval, field_id
                    ],
                    buttonAlign: 'center',
                    buttons: [{text: '保存', handler: function() {
                                var formdata = Ext.encode(formpanel.getForm().getValues());
                                Ext.Ajax.request({
                                    url: '/index.php?c=Admin&a=configsave',
                                    method: "POST",
                                    params: {formdata: formdata},
                                    success: function(response, option) {
                                        if (response.responseText) {
                                            Ext.MessageBox.alert('提示', '保存成功！');
                                        }
                                    }
                                });
                            }
                        }]
                });
                var viewport = Ext.create('Ext.container.Viewport', {
                    layout: 'border',
                    items: [formpanel]
                });
                Ext.Ajax.request({
                    url: '/index.php?c=Admin&a=loadconfig',
                    method: "POST",
                    success: function(response, option) {
                        var formdata = Ext.decode(response.responseText);
                        formpanel.getForm().setValues(formdata);
                    }
                });
            }
            );
        </script> 
    </body>
</html>