<?php
?>
@extends('layouts.board')

@section('title', 'カテゴリ別掲示板管理メニュー')
@section('content')
    <h1>カテゴリ別掲示板管理メニュー</h1>

    {{Form::open(['url' => '/thread_admin/board'])}}
    <h1>カテゴリー選択</h1>
    {{Form::select('category_id', $lists, null) }}<br>
    <h1>掲示板名</h1>
    {{Form::text('board', null, ['class' => 'form-control', 'id' => 'inputBoard', 'placeholder' => '掲示板名'])}}<br><br>
    {{Form::submit('作成', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}
@endsection
