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
{{Form::open(['action' => 'BoardController@post'])}}
{{Form::token()}}
{{Form::hidden('board_id', $id)}}
{{Form::text('thread', null, ['class' => 'form-control', 'id' => 'inputThread', 'placeholder' => 'タイトル'])}}
<br>
{{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
<br>
{{Form::text('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'メール'])}}
<br>
{{Form::textarea('response', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
<br>
{{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
<hr>

@foreach($datas as $data)

    <h1>タイトル：{{$data['thread']}} 投稿日時：{{$data['created_at']}}</h1>
    @foreach($data['responses'] as $res)
        <h3>氏名：{{$res['name']}} email：{{$res['email']}} 投稿時間{{$res['created_at']}}</h3>
        <h3>投稿内容</h3>
        <pre>{{$res['response']}}</pre>
        {{$res['image1']}}{{$res['image2']}}
    @endforeach
@endforeach

@endsection
