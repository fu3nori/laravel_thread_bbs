<?php
?>
@extends('layouts.board')

@section('title', 'スレッド・レス管理')
@section('content')
@include('layouts.admin_menu')
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
    <h1>スレッド管理</h1>
    <p><b>警告：スレッドを削除すると、スレッド配下の書き込みも物理削除されます
    <br>スレッド配下のレスを個別削除する場合は下記のスレッドタイトルをクリックしてレス一覧を表示して下さい。</b></p>
    @foreach($threads as $thread)
        {{Form::open(['url' => '/thread_admin/thread'])}}
        掲示板名：{{$thread['board']}}　｜　スレッド名：{{$thread['thread']}}　
        <br>
        {{Form::hidden('id', $thread['id'])}}
        {{Form::hidden('thread', $thread['thread'])}}
        {{Form::submit('スレッド削除', ['class'=>'btn btn-primary btn-block'])}}
        {{Form::close()}}
    @endforeach

@endsection
