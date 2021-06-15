<?php
?>
@section('menu')
    <h2><a href="{{action("ThreadAdminController@category")}}">カテゴリ管理</a>　｜　
    <a href="{{action("ThreadAdminController@board")}}">カテゴリ配下掲示板管理</a>　｜　
    <a href="{{action("ThreadAdminController@response")}}">スレッド・レス管理</a>　｜　
    <a href="{{action("HomeController@index")}}">ホームに戻る</a><h2>
@show
