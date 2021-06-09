<?php
?>
@extends('layouts.board')

@section('content')

@section('title', 'スレッドプレビュー・スレッド作成')


<p>スレッド作成</p>
@if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{Form::open(['action' => 'BoardController@post','method' => 'post', 'files' => true])}}
{{Form::token()}}
{{Form::hidden('board_id', $id)}}


タイトル：<br>{{Form::text('thread', null, ['class' => 'form-control', 'id' => 'inputThread', 'placeholder' => 'タイトル'])}}
<br>
氏名：<br>{{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
<br>
メール：<br>{{Form::text('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'メール'])}}
<br>
本文：<br>{{Form::textarea('response', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
<br>
画像１：<br>{{Form::file('image1', ['id' => 'image1'])}}
<br>
画像２：<br>{{Form::file('image2', ['id' => 'image1'])}}

<br>
{{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
<hr>

@foreach($datas as $data)

    <h1>タイトル：{{$data['thread']}} 投稿日時：{{$data['created_at']}}  スレッドID：{{$data['id']}}</h1>
    @foreach($data['responses'] as $res)
        <h3>氏名：{{$res['name']}} email：{{$res['email']}} 投稿時間{{$res['created_at']}}</h3>
        <h3>投稿内容</h3>
        <pre>{{$res['response']}}</pre>
        {{$res['image1']}}{{$res['image2']}}
    @endforeach
    <h3>レス書き込み</h3>
    {{Form::open(['action' => 'BoardController@res','method' => 'post', 'files' => true])}}
    {{Form::token()}}
    {{Form::hidden('board_id', $id)}}
    {{Form::hidden('thread_id', $data['id'])}}
    <br>
    氏名：<br>{{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
    <br>
    メール：<br>{{Form::text('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'メール'])}}
    <br>
    本文：<br>{{Form::textarea('response', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
    <br>
    画像１：<br>{{Form::file('image1', ['id' => 'image1'])}}
    <br>
    画像２：<br>{{Form::file('image2', ['id' => 'image1'])}}
    <br>
    {{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}
    <hr>

@endforeach

@endsection
