<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Template</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="external nofollow" >
    <style>
        html,body{
            width: 100%;
            height: 100%;
        }
        *{
            margin: 0;
            border: 0;
        }
        .jumbotron{
            margin-top: 10%;
        }
        .jumbotron>span{
            margin: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="jumbotron">
                <h1>Title:{{$post->title}}</h1>
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"> {{$post->view_count}} views</span>
                <p>Content:{{$post->content}}</p>
            </div>
        </div>
    </div>
</div>

<!-- jQuery文件-->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>

</script>
</body>
</html>