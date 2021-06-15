<?php
?>
@extends('layouts.board')

@section('content')

@section('title', 'スレッド掲示板管理メニュー')
<h1>スレッド掲示板管理メニュー</h1>


<h2><a href="{{action("ThreadAdminController@category")}}">カテゴリ管理</a></h2>
<h2><a href="{{action("ThreadAdminController@board")}}">カテゴリ配下掲示板管理</a></h2>
<h2><a href="{{action("ThreadAdminController@thread")}}">スレッド管理</a></h2>
<h2><a href="{{action("HomeController@index")}}">ホームに戻る</a>

@endsection


