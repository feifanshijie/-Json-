<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title>红枣会文档系统</title>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <style>
        body,h1,h2,h3,h4,h5,p,ul,ol,li{margin:0px;padding:0px; background: #fff;}
        /*body{font: 12px/1.5 "SimSun","Microsoft Yahei","SimHei"; background: #fff}*/
        ul,ol,li{list-style: none;}
        img{vertical-align: middle;border:none;}
        a:link,a:visited{text-decoration: none;color:#333;}
        input{vertical-align: middle;}
        *{margin:0;padding:0}
        li{
            list-style:none;
        }
        .nav{
            float:left;
            width:350px;
            height:auto;
            background-color:#fff;

            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .nav-top{
            width:350px;
            height:80px;
            padding:15px 25px;
            border-bottom:1px solid #ddd;
            border-right:1px solid #2196f3;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            line-height:50px;
            color:#757575;
            font-size: 21px;
            font-weight: 500;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        }
        .nav ul{
            border-right:1px solid #ddd;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .nav ul li{

        }
        .show_list a{
            color:#01B169;
        }
        .show_list:hover {
            color:#01B169;
            background-color:rgba(0, 0, 0, 0.12);
        }
        .nav-item:hover{
            color:#01B169;
            background-color:rgba(0, 0, 0, 0.12);
        }

        .nav ul li a
        {
            display: block;
            width: 100%;
            height: 100%;
            padding:10px 10px;
            text-decoration:none;
            color:rgba(0, 0, 0, 0.87);
            font-size:18px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .nav-first{
            background-color:#EEF1F3;
        }
        .main{
            width:calc(100% - 350px);
            width:-webkit-calc(100% - 350px);
            width:-moz-calc(100% - 350px);
            height:auto;
            overflow:hidden;
        }
        .top{
            float:left;
            padding:10px;
            width:100%;
            height:80px;
            background-color:#2196f3;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .content{
            float:left;
            width:calc(100% - 350px);
            width:-webkit-calc(100% - 350px);
            width:-moz-calc(100% - 350px);
            height:auto;
            background-color:#ddd;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            min-height:890px;border-right: none;
        }
        .content_right{
            width:100%;
            float: left;min-height:890px;border-right: none;
        }
        .content{border-right: 1px solid #dadada;}
        .my_localtion{padding: 12px 0 11px 30px;border-bottom: 1px solid #ccc}
    </style>
</head>
<body>
    <div>
        <div class="nav">
            <div class="nav-top">
                <span>红枣会文档</span>&nbsp;<small>v0.1</small>
            </div>
            <ul>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-first">
                    <a class="show_list" href="javascript:;"><?php echo e($v['title']); ?></a>
                    <ul>
                        <?php $__currentLoopData = $v['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="show_list" href="javascript:;"><?php echo e($v['title']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="main">
            <div class="top">

            </div>
            <div class="content_right">
                <p class="my_localtion">您的位置是：<span  id="localtion_text" >首页 >> 接口概述</span></p>
                <iframe src="doc.html" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" width="847" height=100% id="iframepage" name="iframepage" onLoad="iFrameHeight()" ></iframe>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" language="javascript">
    $(".show_list").click(function(){
        $(this).next('ul').toggle();
    });
    function iFrameHeight() {
        var ifm= document.getElementById("iframepage");
        var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
        if(ifm != null && subWeb != null) {
            ifm.height = subWeb.body.scrollHeight;
        }
    }
</script>
</html>