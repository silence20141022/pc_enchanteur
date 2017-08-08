<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>特价中心_艾诗-香水沐浴</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Public/Extjs42/resources/css/ext-all-gray.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Extjs42/bootstrap.js" type="text/javascript"></script>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="/Public/plupload.full.min.js" type="text/javascript"></script>
    <style>
        .table {
            margin-bottom: 0px;
        }

        .full {
            border: solid 1px #333;
            height: 55px;
        }

        tr {
            height: 50px;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 2px;
            text-align: center;
            vertical-align: middle;
            border: solid 1px;
        }

        .active_td {
            border-color: #0000cc !important;
        }

        img {
            height: 50px;
        }
    </style>
    <script type="text/javascript">
        var currentid;
        Ext.onReady(function () {
            var html = '<table class="table" ><tbody>' +
                    '<tr>' +
                    '<td colspan="6"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="6"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="6"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="6"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="6"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="3" style="width: 646px"></td><td colspan="3" width="598px"></td>' +
                    '</tr></tbody></table>';
            Ext.Ajax.request({
                url: '/index.php?c=Admin&a=loadwapnsp',
                method: "POST",
                success: function (response, option) {
                    //alert(response.responseText);html
                    var json = Ext.decode(response.responseText);
                    html = '<div id="container">' + json.layout + '</div>';
                    var panel = Ext.create('Ext.panel.Panel', {
                        region: 'center',
                        title: 'WAP端特价中心页面布局',
                        autoScroll: true,
                        html: html
                    })
                    var field_id = Ext.create('Ext.form.field.Text', {
                        id: 'field_id',
                        readOnly: true,
                        fieldLabel: '网格ID'
                    });
                    var field_link = Ext.create('Ext.form.field.Text', {
                        id: 'field_link',
                        name: 'link',
                        fieldLabel: '链接'
                    });

                    var field_bind = Ext.create('Ext.form.field.Text', {
                        id: 'field_bind',
                        name: 'bind',
                        fieldLabel: '绑定监控代码'
                    });
                    var btn_upload = Ext.create('Ext.button.Button', {
                        id: 'btn_upload',
                        margin: '10 10 10 10',
                        text: '图片上传'
                    });
                    var img_icon = Ext.create('Ext.Img', {
                        id: 'img_icon',
                        width: 240,
                        height: 120,
                        margin: '0 5',
                        src: 'http://www.sencha.com/img/20110215-feat-html5.png'
                    });
                    var formpanel = Ext.create('Ext.form.Panel', {
                        title: '信息维护',
                        region: 'east',
                        width: 400,
                        fieldDefaults: {
                            margin: '10 10 10 10',
                            labelAlign: 'top',
                            width: '95%'
                        },
                        items: [field_link, field_bind, btn_upload, img_icon, field_id],
                        buttonAlign: 'center',
                        buttons: [{
                            text: '保存', handler: function () {
                                if (currentid) {
                                    $('#' + currentid).html('');
                                    var child = '<a target="_blank" href="' + Ext.getCmp('field_link').getValue();
                                    child += '" onclick="' + Ext.getCmp('field_bind').getValue() + '">';
                                    child += ' <img  src="http://www.enchanteur.com.cn' + Ext.getCmp('img_icon').src + '" /></a>';
                                    // alert(child);
                                    $('#' + currentid).append(child);
                                }
                                Ext.Ajax.request({
                                    url: '/index.php?c=Admin&a=nspsave',
                                    method: "POST",
                                    params: {'layout': $('#container').html(), type: 'wap'},
                                    success: function (response, option) {
                                        if (response.responseText) {
                                            Ext.MessageBox.alert('提示', '保存成功！');
                                        }
                                    }
                                });
                            }
                        }],
                        buttonAlign: 'center'
                    });
                    var viewport = Ext.create('Ext.container.Viewport', {
                        layout: 'border',
                        items: [formpanel, panel]
                    });
                    var tds = $("#container td");
                    $.each(tds, function (index, item) {
                        $(this).attr('id', 'td_' + index);
                    })
                    tds.bind('click', function () {
                        $(".active_td").removeClass('active_td');
                        var href = $(this).children('a').attr('href');
                        Ext.getCmp('field_link').setValue(href);
                        var bind = $(this).children('a').attr('onclick');
                        Ext.getCmp('field_bind').setValue(bind);
                        var src = $(this).find('img').attr('src');
                        Ext.getCmp('img_icon').setSrc(src);
                        currentid = $(this).attr('id');
                        Ext.getCmp('field_id').setValue(currentid);
                        $(this).addClass('active_td');
                    })
                    var full_divs = $("#container").find(".full");
                    $.each(full_divs, function (index, item) {
                        $(this).attr('id', 'div_' + index);
                    })
                    full_divs.bind('click', function () {
                        $(".active_td").removeClass('active_td');
                        var href = $(this).children('a').attr('href');
                        Ext.getCmp('field_link').setValue(href);
                        var bind = $(this).children('a').attr('onclick');
                        Ext.getCmp('field_bind').setValue(bind);
                        var src = $(this).find('img').attr('src');
                        Ext.getCmp('img_icon').setSrc(src);
                        currentid = $(this).attr('id');
                        Ext.getCmp('field_id').setValue(currentid);
                        $(this).addClass('active_td');
                    })
                    var uploader = new plupload.Uploader({
                        runtimes: 'html5,flash,silverlight,html4',
                        browse_button: 'btn_upload', // you can pass an id...
                        url: '/index.php?c=Admin&a=upload',
                        flash_swf_url: '/Public/Moxie.swf',
                        silverlight_xap_url: '/Public/Moxie.xap',
                        filters: {
                            max_file_size: '50mb',
                            mime_types: [
                                {title: "Image files", extensions: "*"},
                                {title: "Zip files", extensions: "zip,rar"}
                            ]
                        }
                    });
                    uploader.init();
                    uploader.bind('FilesAdded', function (up, files) {
                        uploader.start();
                    });
                    uploader.bind('FileUploaded', function (up, file, response) {
                        var json = $.parseJSON(response.response);
                        // $('#' + currentid).append('<a href="' + Ext.getCmp('field_link').getValue() + '" target="_blank"><img  src="/Uploads/' + json.file.savename + '" /></a>');
                        Ext.getCmp('img_icon').setSrc('/Uploads/' + json.file.savename);
                    });
                }
            });
        });

    </script>
</head>
<body>
</body>
</html>