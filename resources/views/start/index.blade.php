<?php
?>
@extends('layouts.startapp')

@section('title','index')
@section('menubar')
    @parent
    インデックスページ <a href= "{{ action('StartController@view') }}">ビューページ</a> 管理ページ
@endsection


@section('content')
@include('layouts.logomark')
<h1>start</h1>
<h1>ポスト作成</h1>

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
{{Form::open(['url' => '/start', 'files' => true])}}
{{Form::token()}}
    {{Form::text('title', null, ['class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'タイトル'])}}
    <br>
    {{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
    <br>
    {{Form::textarea('text', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
    <br>
    {{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
@endsection

@section('footer')
    2021
@endsection


