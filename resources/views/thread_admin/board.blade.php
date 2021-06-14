<?php
?>
@extends('layouts.board')

@section('title', 'カテゴリ配下掲示板管理メニュー')
@section('content')
    {{--システムメッセージ--}}
    <p>{{$msg}}</p>
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>カテゴリ配下掲示板管理メニュー</h1>
    <p>カテゴリを選んで掲示板を作成します。また、過去に作った掲示板を削除できます。</p>
    {{Form::open(['url' => '/thread_admin/board'])}}
    <h2>カテゴリー選択</h2>
    {{Form::select('category_id', $lists, null) }}<br>
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

    {{--ここからは削除--}}

    @foreach($boards as $board)
        {{Form::open(['url' => '/thread_admin/board'])}}
        {{Form::hidden('method', 'delete')}}
        {{Form::hidden('board', $board['board'])}}
        {{Form::hidden('id', $board['id'])}}
        <p>掲示板名：{{$board['board']}}<br>
        掲示板ID：{{$board['id']}}</p>
        {{Form::submit('掲示板削除', ['class'=>'btn btn-primary btn-block'])}}
        {{Form::close()}}
    @endforeach
    {{Form::close()}}
@endsection
