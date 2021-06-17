<?php
?>

@extends('layouts.board')



@section('title', $thread['thread'] )

@section('content')

<h1>{{$thread['thread']}}　{{$thread['writes']}}レス</h1>

<h2><a href="{{ action('BoardController@index',$thread['board_id']) }}">掲示板に戻る</a>
    　｜　<a href="{{ action('ThreadController@list',$thread['board_id']) }}">スレッド一覧に戻る</a>
        　｜　<a href=" {{action('CategoryController@index')}}">カテゴリ一覧</a></h2>


    @foreach($responses as $response)
        <h3>氏名：<a href="mailto:{{$response['email']}}">{{$response['name']}}</a>　投稿時間：{{$response['created_at']}}</h3>
        <h3>投稿内容</h3>
        <pre>{{$response['response']}}</pre>
        @if ($response['image1']==true)
            <a href="{{ asset('bbs_image/'.$response['image1'])}}" target="_blank">
                <img src="{{ asset('bbs_thumb/'.$response['image1'])}}">
            </a>
        @endif
        @if ($response['image2']==true)
            <a href="{{ asset('bbs_image/'.$response['image2'])}}" target="_blank">
                <img src=" {{ asset('bbs_thumb/'.$response['image2'])}}">
            </a>
        @endif
    @endforeach

<h3>レス書き込み</h3>
{{Form::open(['action' => 'BoardController@res','method' => 'post', 'files' => true])}}
{{Form::token()}}
{{Form::hidden('board_id', $thread['board_id'])}}
{{Form::hidden('thread_id', $thread['id'])}}
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



@endsection
