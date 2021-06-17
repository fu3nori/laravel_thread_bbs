<?php
?>
@extends('layouts.board')
@section('title', '掲示板選択')
@section('content')
<h2><a href= "{{ action('CategoryController@index')}}">カテゴリー選択に戻る</a></h2>
<h1>掲示板選択</h1>
    @foreach($boards as $board)
        <h2><a href="{{ action('BoardController@index', $board->id) }}">{{ $board->board }}</a></h2>
    @endforeach
@endsection
