<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
</head>
<?php
    $url = $_GET['src'];
    $result = file_get_contents($url, False);
    echo $result;

$content=file_get_contents(" http://www.google.com.hk/search?hl=zh-CN&source=hp&q=%E4%BD%A0%E5%A5%BD&aq=f&aqi=&aql=&oq=&gs_rfai=");
echo $content;


 $content=file_get_contents(" http://www.google.com.hk/search?hl=en&source=hp&q=%E4%BD%A0%E5%A5%BD&aq=f&aqi=&aql=&oq=&gs_rfai=");
echo $content;

?>
<script>
    $(function () {
        $("a").click(function () {
            var url = $(this).attr('href');
            location.href="http://128.1.174.205?src="+url;
            return false;
        })
    })
</script>
<body>
    <a href="http://128.1.174.205?src=www.google.com">百度</a>
</body>
</html>