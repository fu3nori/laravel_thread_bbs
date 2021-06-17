<?php
?>
@extends('layouts.board')
@section('title', '掲示板選択')
@section('content')
<h1>掲示板選択</h1>
    @foreach($boards as $board)
        <h2><a href="{{ action('BoardController@index', $board->id) }}">{{ $board->board }}</a></h2>
    @endforeach
@endsection
