<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>艾诗-香水沐浴-后台登录</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <link href="/Public/style.css" rel="stylesheet" type="text/css"/> 
        <link href="/Public/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <img src="/Public/img/logo.png" alt="" class="img-responsive"/>
        </div>
        <div style="height: 2px;background-color: blueviolet"></div>
        <div class="container" style="padding-top: 80px">
            <div class="carousel slide" id="carousel-595514" data-ride="carousel" style="width:645px;float:left" >
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-595514">
                    </li> 
                    <li data-slide-to="1" data-target="#carousel-595514">
                    </li> 
                </ol>
                <div class="carousel-inner">
                    <div class="item active">                       
                        <img src="/Public/img/login_01.jpg" alt=""/>  
                    </div> 
                    <div class="item">                       
                        <img src="/Public/img/login_02.jpg" alt=""/>  
                    </div> 
                </div>         
            </div> 
            <div style="border: 1px solid blueviolet;float: right;width:350px;padding: 50px 50px 42px 50px;"> 
                <label for="user_name">登录名</label>
                <div class="input-group" style="margin-bottom: 20px"> 
                    <span class="input-group-addon icon iconfont">&#xe605;</span>
                    <input type="text" class="form-control" id="user_name" placeholder="请输入登录账号"> 
                </div>     
                <label for="password">登录密码</label>
                <div class="input-group"> 
                    <span class="input-group-addon icon iconfont">&#xe608;</span>
                    <input type="password" class="form-control" id="password"   placeholder='请输入登录密码'>
                </div>
                <div style="height:35px">   <label style="color:red" id="validate"></label>  </div>
                <button type="submit" id='btn_login' class="btn btn-primary btn-group-justified">登录</button>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#btn_login').bind('click', function() {
                    var user_name = $("#user_name").val();
                    var password = $("#password").val();
                    if (!user_name) {
                        $("#validate").text("账号不能为空!");
                        return;
                    }
                    if (!password) {
                        $("#validate").text("密码不能为空!");
                        return;
                    }
                    $.ajax({
                        url: "/index.php?c=Index&a=dologin&user_name=" + user_name + "&password=" + password,
                        success: function(result) {
                            if (result == "success") {
                                window.location.href = '/index.php?c=Admin&a=index';
                            }
                            else {
                                $("#validate").text("用户名/密码不正确!");
                            }
                        }
                    });
                });
                $("input").bind('focus', function() {
                    $("#validate").text("");
                });
            });
        </script>
    </body>
</html>