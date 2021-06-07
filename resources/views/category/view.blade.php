<?php
?>
@extends('layouts.board')
@section('title', '板選択')
@section('content')
@foreach($boards as $board)

    <li><a href="{{ action('BoardController@index', $board->id) }}">{{ $board->board }}</a></li>
@endforeach
@endsection
