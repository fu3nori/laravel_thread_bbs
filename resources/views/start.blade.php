<?php
?>
@extends('layouts.startapp')

@section('title','index')
@section('menubar')
    @parent
    インデックスページ
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
<form method="post" action="/start">
    @csrf
    タイトル<BR>
    <input type="text" name="title" value="{{old('title')}}">
    <br>
    テキスト<BR>
    <input type="text" name="text" value="{{old('text')}}">
    <br>
    <input type="submit">
</form>
@endsection

@section('footer')
    2021
@endsection


