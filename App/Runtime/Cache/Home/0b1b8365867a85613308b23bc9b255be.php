<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <title>特价中心_艾诗-香水沐浴</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="/Public/style.css" rel="stylesheet" type="text/css"/>
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 0px;
            text-align: center;
            vertical-align: middle;
        }
        .container {
            padding-right: 0px;
            padding-left: 0px;
            margin-right: auto;
            margin-left: auto;
            width: 1244px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: '/index.php?c=Index&a=loadimgmap',//提交访问的URL
                type: 'GET',//提交的方法
                dataType: 'json',//返回的内容的类型，由于PHP文件是直接echo的，那么这里就是text
                timeout: 1000,//超时时间
                error: function () { //如果出错，执行函数
                    alert('Error loading XML document');
                },
                success: function (data) {
                   var maps=eval(data);
                    $.each(maps, function (index, item) {
                        $("#" + item.part_id).css({
                            "position": "relative",
                            "overflow": "hidden",
                            'height': item.height
                        }).append(item.mapdetail);
                        $("#" + item.part_id).find('img').css({
                            'border': 'none',
                            'width': item.width+'px',
                            'position': 'absolute',
                            'top': 0,
                            'left': '50%',
                            'margin-left': -(item.width / 2) + 'px'
                        });
                    })
                }
            })
        })
    </script>
</head>
<body>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<div class="container">
    <table width="100%">
        <tr>
            <td rowspan="2" style="padding-left: 0px">
                <a href="/index.php?c=Index&a=index">
                    <img src="/Public/img/logo.png" alt=""/>
                </a>
            </td>
            <td class="text-align:right" style="padding-right:0px">
                <ul class="list-group list-inline">
                    <li class="list-group-item-top">
                        <a href="http://mall.jd.com/index-197186.html" target="blank"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_JDbuy']);">
                            <img src="/Public/img/jingdong.png" alt=""/>
                        </a>
                    </li>
                    <li class="list-group-item-top">
                        <a href="https://enchanteur.tmall.com/" target="blank" id="smq1_02"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_tmallbuy']);">
                            <img src="/Public/img/tianmao.png" alt=""/>
                        </a>
                    </li>
                    <li class="list-group-item-top">
                        <a href="http://weibo.com/p/1006063432920512/home?from=page_100606&mod=TAB#place" target="blank"
                           style="color:#EE86A7" onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_weibo']);">
                            官方微博
                        </a>
                    </li>
                    <li class="list-group-item-top">
                        <a href="/index.php?c=Index&a=commercial_network" style="color:#EE86A7"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_sale']);">
                            销售网点
                        </a>
                    </li>
                    <li class="list-group-item-top">
                        <a href="http://www.wipro-unza.com/china/" target="blank" style="color:#EE86A7"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_group']);">
                            集团网站
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                <a href="/index.php?c=Index&a=product_validate"
                   onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_check']);">
                    <img src="/Public/img/search.png" alt=""/>
                </a>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <img src="/Public/img/nav_background_left.png" alt=""/>
            </td>
            <td style="width: 100%;">
                <ul class="nav nav-pills" style="background-image:url(/Public/img/nav_bc2.png);font-family:  ">
                    <li>
                        <a href="/index.php?c=Index&a=index"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_firtpage']);"
                           style="color: #EE86A7;font-weight: bold;margin-left: 70px;font-family:'Microsoft YaHei'">首页</a>
                    </li>
                    <li style="padding-top: 8px"><img src="/Public/img/nav_divide.png" alt=""/></li>
                    <li>
                        <a href="/index.php?c=Index&a=liaojie_aishi"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_know']);"
                           style="color: #EE86A7;font-weight: bold">了解艾诗</a>
                    </li>
                    <li style="padding-top: 8px"><img src="/Public/img/nav_divide.png" alt=""/></li>
                    <li>
                        <a href="/index.php?c=Index&a=aishi_product"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_production']);"
                           style="color: #EE86A7;font-weight: bold">产品系列</a>
                    </li>
                    <li style="padding-top: 8px"><img src="/Public/img/nav_divide.png" alt=""/></li>
                    <li>
                        <a href="/index.php?c=Index&a=enchanteur_article"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_news']);"
                           style="color: #EE86A7;font-weight: bold">最新资讯</a>
                    </li>
                    <li style="padding-top: 8px"><img src="/Public/img/nav_divide.png" alt=""/></li>
                    <li>
                        <a href="/index.php?c=Index&a=enchanteur_woman"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_woman']);"
                           style="color: #EE86A7;font-weight: bold">香氛女人</a>
                    </li>
                    <li style="padding-top: 8px"><img src="/Public/img/nav_divide.png" alt=""/></li>
                    <li>
                        <a href="/index.php?c=Index&a=spcenter"
                           onclick="_smq.push(['custom', 'enchanteur_pc', 'enchanteur_onsale']);exehis('custom','enchanteur_pc','enchanteur_onsale');"
                           style="color: #EE86A7;font-weight: bold"><img src="/Public/img/spcenter_nav.png"
                                                                         style="margin-top:-2px"/>
                        </a>
                    </li>
                </ul>
            </td>
            <td><img src="/Public/img/nav_background_right.png" alt=""/></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    !(function (a, b, c, d, e, f) {
        var g = "", h = a.sessionStorage, i = "__admaster_ta_param__", j = "tmDataLayer" !== d ? "&dl=" + d : "";
        if (a[f] = {}, a[d] = a[d] || [], a[d].push({startTime: +new Date, event: "tm.js"}), h) {
            var k = a.location.search,
                    l = new RegExp("[?&]" + i + "=(.*?)(&|#|$)").exec(k) || [];
            l[1] && h.setItem(i, l[1]), l = h.getItem(i),
            l && (g = "&p=" + l + "&t=" + +new Date)
        }
        var m = b.createElement(c), n = b.getElementsByTagName(c)[0];
        m.src = "//tag.cdnmaster.com/tmjs/tm.js?id=" + e + j + g,
                m.async = !0, n.parentNode.insertBefore(m, n)
    })(window, document, "script", "tmDataLayer", "TM-YHOJ32", "admaster_tm");
    //本系统对监控代码进行数据统计
    function exehis(code1, code2, code3) {
        $.ajax({
            url: '/index.php?c=Index&a=updatereport',//提交访问的URL
            data: {code1: code1, code2: code2, code3: code3},
            success: function (data) {
            }
        })
    }
    $(document).ready(function () {
        $("[onclick]").each(function () {
            var _script = $(this).attr("onclick");
            if (_script.indexOf('_smq.push') >= 0 && _script.indexOf('exehis') < 0) {
                //_smq.push(['custom', 'enchanteur_pc', 'enchanteur_onsale']);
                var params = _script.replace('_smq.push([', '').replace(']);', '');
                _script += 'exehis(' + params + ');';
                $(this).attr("onclick", _script);
            }
        });
    });
</script>


<div class="carousel slide" id="carousel_spcenter" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php if(is_array($slidedetail)): $k = 0; $__LIST__ = $slidedetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k-1 == 0): ?><li class="active" data-slide-to="<?php echo ($k-1); ?>" data-target="#carousel_spcenter">
                </li>
                <?php else: ?>
                <li data-slide-to="<?php echo ($k-1); ?>" data-target="#carousel_spcenter">
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ol>
    <div class="carousel-inner">
        <?php if(is_array($slidedetail)): $k = 0; $__LIST__ = $slidedetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k-1 == 0): ?><div class="item active">
                    <a onclick="<?php echo ($vo["imgscript"]); ?>"
                       href="<?php echo ($vo["linkurl"]); ?>" target="blank">
                        <img src="/Uploads/<?php echo ($vo["imgpath"]); ?>" alt=""/>
                    </a>
                </div>
                <?php else: ?>
                <div class="item">
                    <a onclick="<?php echo ($vo["imgscript"]); ?>"
                       href="<?php echo ($vo["linkurl"]); ?>" target="blank">
                        <img src="/Uploads/<?php echo ($vo["imgpath"]); ?>" alt=""/>
                    </a>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div style="background-image: url(/Uploads/enchanteur_bg.jpg)">
    <?php echo ($data["layout"]); ?>
</div>
<div class="container text-center " style="margin-bottom: -3px">
    <span class="caret_foot"></span>
</div>
<div  style="background-color:  #EE86A7;">
    <div class="container" style="text-align: right;">
        <table width="100%" style="margin-top: 8px;margin-bottom:8px">
            <tr>
                <td> 
                    <img src="/Public/img/bottom_logo.png" alt=""/>
                </td> 
                <td rowspan="2" style="width: 88px;"> 
                    <img src="/Public/img/weixin.png" alt=""/>
                </td>
            </tr>
            <tr>
                <td style="padding-right: 5px"> 
                    <ul class="list-group list-inline list-group-bottom">
                        <li class="list-group-item list-group-item_bottom">
                            <a href="http://www.wipro-unza.com/china/about-us/company-profile/" target="blank" style="color:white">
                                集团介绍</a></li>
                        <li class="list-group-item list-group-item_bottom">|</li>
                        <li class="list-group-item list-group-item_bottom">
                            <a href="http://www.wipro-unza.com/china/contact-us/" target="blank" style="color:white">联系我们</a></li>
                        <li class="list-group-item list-group-item_bottom">|</li>
                        <li class="list-group-item list-group-item_bottom">
                            <a href="http://www.romano-man.com.cn/" target="blank" style="color:white">罗曼诺官网</a></li> 
                    </ul>
                    <span class="list-group-item_bottom">
                        <!-- <a href="http://www.miitbeian.gov.cn/" target="blank" style="color: white">粤ICP备13039503号-3</a>-->
                        版权所有©维布络安舍(广东)日用品有限公司</span>
                </td>
            </tr>
        </table> 
    </div>
</div>
<script type="text/javascript">
    var _py = _py || [];
    _py.push(['a', 'sLs..Xo38SBpgIvEFaTyKrdtDlP']);
    _py.push(['domain', 'stats.ipinyou.com']);
    _py.push(['e', '']);
    -function(d) {
        var s = d.createElement('script'),
                e = d.body.getElementsByTagName('script')[0];
        e.parentNode.insertBefore(s, e),
                f = 'https:' == location.protocol;
        s.src = (f ? 'https' : 'http') + '://' + (f ? 'fm.ipinyou.com' : 'fm.p0y.cn') + '/j/adv.js';
    }(document);
    $(document).ready(function() {
       // if ($('#carousel_spcenter'))
       // {
       //     $('#carousel_spcenter').carousel({interval: <?php echo ($config_data["carousel_interval"]); ?>});
       // }
    });
    //2017-01-10新增的脚本
    window._CWiQ = window._CWiQ || [];
    window.BX_CLIENT_ID = 51343; // 帐号ID
    (function() {
        var c = document.createElement('script')
                , p = 'https:' == document.location.protocol;
        c.type = 'text/javascript';
        c.async = true;
        c.src = (p ? 'https://' : 'http://') + 'tp.ana.cnad.com.cn/boot/0';
        var h = document.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(c, h);
    })();
    _CWiQ.push(['_trackPdmp', '访问过网页的人', 1]);
</script>
<noscript>
<img src="//stats.ipinyou.com/adv.gif?a=sLs..Xo38SBpgIvEFaTyKrdtDlP&e=" style="display:none;"/>
</noscript>
</body>
</html>