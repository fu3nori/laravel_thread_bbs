<?php
?>
@extends('layouts.board')

@section('title', 'カテゴリ配下掲示板管理メニュー')
@section('content')
    <h1>カテゴリ配下掲示板管理メニュー</h1>
    <p>カテゴリを選んで掲示板を作成します。また、過去に作った掲示板を削除できます。</p>
    {{Form::open(['url' => '/thread_admin/board'])}}
    <h2>カテゴリー選択</h2>
    {{Form::select('id', $lists, null) }}<br>
    <h2>掲示板名</h2>
    {{--ここからのpostは新規作成になる--}}
    {{Form::hidden('method', 'insert')}}
    {{Form::text('board', null, ['class' => 'form-control', 'id' => 'inputBoard', 'placeholder' => '掲示板名'])}}<br>
    <h2>ソート</h2>
    <p>ソート優先度(半角整数入力　0が最優先、数値が上がるごとに後になる)</p>
    {{Form::text('sort', 0, ['class' => 'form-control', 'id' => 'sortBoard', 'placeholder' => 'ソート順'])}}<br>
    {{Form::submit('作成', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}
    <hr>
    <h1>掲示板削除</h1>
    <p><b>警告：掲示板を削除すると、掲示板内全てのスレッドと書き込みも物理削除されます</b></p>
    {{Form::open(['url' => '/thread_admin/board'])}}
    {{--ここからは削除--}}
    {{Form::hidden('method', 'delete')}}
    @foreach($boards as $board)
        <p>掲示板名：{{$board['board']}}<br>
        掲示板ID：{{$board['id']}}</p>
    @endforeach
    {{Form::close()}}
@endsection
