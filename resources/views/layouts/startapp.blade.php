<?php
?>
<html>
<head>
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
            font-size: 16px;
        }
        h2 {
            color: #364e96;/*文字色*/
            padding: 0.5em 0;/*上下の余白*/
            border-top: solid 3px #364e96;/*上線*/
            border-bottom: solid 3px #364e96;/*下線*/
            font-size: 14px;
        }

        div {
            color: #364e96;/*文字色*/
            padding: 0.5em 0;/*上下の余白*/
            font-size: 12px;
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


        div.view {
            width:300px;
            border:solid 1px cadetblue;
        }

        div_admin.view {
            width:600px;
            border:solid 1px cadetblue;
        }

    </style>
</head>

<body>


<h1>@yield('title')</h1>
@section('menubar')
<h2>※メニュー</h2>
<ul>
    <li>@show</li>
</ul>
<hr size="1">
<div class="content">
@yield('content')
</div>

<div class="footer">
@yield('footer')
</div>
</body>
</html>
