<?php
?>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
            font-size: 16px;
            line-height: 1.5;

            background-color: #FCF9F2;
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #364e96;/*文字色*/
            padding: 0.5em 0;/*上下の余白*/
            border-top: solid 3px #364e96;/*上線*/
            border-bottom: solid 3px #364e96;/*下線*/
            font-size: 18px;
        }
        h2 {
            color: #364e96;/*文字色*/
            padding: 0.5em 0;/*上下の余白*/
            border-top: solid 3px #364e96;/*上線*/
            border-bottom: solid 3px #364e96;/*下線*/
            font-size: 16px;
        }

        div {
            color: #364e96;/*文字色*/
            padding: 0.5em 0;/*上下の余白*/
            font-size: 16px;
        }

        span {
            color: #D65331;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        pre.view{
            width:300px;
            white-space: pre-wrap;
            word-break: break-all;
        }
     </style>
</head>

<body>



<div class="container">
    @yield('content')
</div>



</body>
</html>
