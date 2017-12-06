<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- 引入样式 -->
    <title>Hello Programer</title>
    
    <link rel="stylesheet" href="<?php echo e('/gui/css/btn.css'); ?>">
    <link rel="stylesheet" href="<?php echo e('/gui/css/gui.css'); ?>">
    <link rel="stylesheet" href="<?php echo e('/gui/css/label.css'); ?>">
    
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/react/15.4.2/react.min.js"></script>
    <script src="https://cdn.bootcss.com/react/15.4.2/react-dom.min.js"></script>
    <script src="https://cdn.bootcss.com/babel-standalone/6.22.1/babel.min.js"></script>
    <style>
        body {
            font-size: 1.25rem/16px;
            background-color: #e6e6e6;
            font-family: "Helvetica Neue", Helvetica, Verdana, Arial, sans-serif;

        }
        .header {
            margin: 30px;
        }

        .home {
            width: 1240px;
            margin: 0 auto 0 auto;
            padding-top: 1px;
            box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
            background-color:#fff;
        }
        .bg{
            padding-top:50px;
            background:url('../m/hb.png') repeat;
        }

        .nav {
            background-color:rgba(246,246,246,0.5);
        }

        .nav ul {
            margin-top: 10px;
            padding: 15px 30px 15px 30px;
            overflow: hidden;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .nav ul li {
            float: left;
            list-style: none;
            margin-left: 30px;
            font-size:20px;
            color: #777;
        }

        .main {
            padding: 10px 60px 20px 60px;
            overflow: hidden;
        }

        .title {
            margin-top: 30px;
            color: #515151;
        }

        .title-sup {
            font-size: 0.9rem;
            color: #999;
        }

        .article-list {
            width: 800px;
            margin-top: 20px;
            float: left;
        }

        .article-recommend {
            width: 250px;
            margin-top: 20px;
            margin-left: 50px;
            float: left;
            padding: 10px;
            overflow: hidden;
        }

        .article-recommend ul {
            margin: 0;
        }

        .article-recommend li{
            padding:0 !important;
            margin-bottom:5px !important;
        }
        .article-recommend li a{
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #21759b;
            font-size: 1.1rem;
        }

        .gui-list {

        }

        .gui-list li {
            font-size: 16px;
            padding: 5px;
            margin-bottom: 15px;
        }

        .gui-list-title {
            display: inline-block;
            color: #21759b;
            font-size: 1.25rem;
            margin-bottom: 5px;
        }

        .gui-list-content {
            color: #757575;
            font-size: 1rem;
        }

        @keyframes  action_skew{
            0%{transform: skew(-40deg);opacity: 0;}
            50%{ transform: skew(40deg);opacity: 0.2;}
            100%{ transform: skew(0deg);opacity: 1;}
        }

        @keyframes  action_rotateY{
            0%{transform: rotateY(0deg);opacity: 0;}
            50%{ transform: rotateY(180deg);opacity: 0.2;}
            100%{ transform: rotateY(360deg);opacity: 1;}
        }

        @keyframes  action_translateY{
            0%{transform: translateY(50px);opacity: 0;}
            100%{ transform: translateY(0px);opacity: 1;}
        }

        @keyframes  action_scale{
            0%{
                transform:scale(0.2);
                opacity:0;
            }

            100%{
                transform:scale(1);
                opacity:1;
            }
        }

        
        .search-input {
            height:25px;
            width:200px;
            border:1px solid #ddd;
            padding:0 10px;
        }
        .search-input:focus{
            border:1px solid #01B169;
        }

        .br{
            float:left;
            height:25px;
            margin-right:10px;
            border-radius:50%;border:3px solid rgb(140, 211, 98);
        }
    </style>
</head>
<body>
<div class="bg">
    <div class="gui-block-center div home" id="box_action_skew">
        <div class="header">
            <h1 class="title">慢性胃犯贱</h1>
            <h2 class="title-sup">静坐多思己过，闲谈莫论人非</h2>
        </div>

        <div class="nav">
            <ul>
                <li>首页</li>
                <li>帮你谷歌</li>
                <li>联系</li>
                <li><input autocomplete="off" type="text" placeholder="帮你搜索想找点什么" class="search-input"></li>
            </ul>
        </div>
        <div class="main">
            <div class="article-list" id="article-list">

            </div>
            <div class="article-recommend" id="recommend-list">

            </div>
        </div>

        <div class="main">

        </div>
    </div>
</div>
<script type="text/babel">

    function test(data)
    {
        let html_arr = [];

        for (let i = 0; i < data.length; i++) {
            html_arr.push(
                <li>
                    <div>
                        <a href="javascript:;" className="gui-list-title">{data[i].title}</a>
                        <div className="gui-list-content">{data[i].content}</div>
                    </div>
                </li>
            )
        }
        return html_arr;
    }

    let ArticleList = React.createClass({
        
        getInitialState: function () {
            return {
                list: [],
                next: ''
            };
        },
        componentDidMount: function () {
            this.serverRequest = $.get(this.props.source, function (result) {
                this.setState({
                    list: result.data.list,
                    next: result.data.has_next,
                });
            }.bind(this));
        },
        
        componentWillUnmount: function () {
            this.serverRequest.abort();
        },

        render: function () {
            return (
                <ul className="gui-list">
                {
                    this.state.list.map(function (item){
                        return<li>
                            <div>
                                <a href="javascript:;" className="gui-list-title">{item.title}</a>
                                <div className="gui-list-content">{item.content}</div>
                            </div>
                        </li>
                    })
                }
                </ul>
            );
        }
    });

    let RecommendList = React.createClass({
        
        getInitialState: function () {
            return {
                list: [],
                next: ''
            };
        },
        handleClick: function(event) {
            this.setState({liked: !this.state.liked});
        },
        componentDidMount: function () {
            this.serverRequest = $.get(this.props.source, function (result) {
                this.setState({
                    list: result.data.list,
                    next: result.data.has_next,
                });
            }.bind(this));
        },
        componentWillUnmount: function () {
            this.serverRequest.abort();
        },
        render: function () {
            return (
                <ul className="gui-list anim_fade_image">
                    {
                        this.state.list.map(function (item) {
                            return <li><a href="javascript:;"><div className="br"></div>PHP</a></li>
                        })
                    }
                </ul>
            );
        }
    });

    ReactDOM.render(
        <ArticleList source="http://func.com/index_article"/>,
        document.getElementById('article-list')
    );

    ReactDOM.render(
        <RecommendList source="http://func.com/index_recommend"/>,
        document.getElementById('recommend-list')
    );

</script>
</body>
</html>
