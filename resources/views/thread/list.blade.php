<?php
    ?>
@extends('layouts.board')

@section('content')

@section('title', 'スレッド一覧')
<h1>スレッド一覧</h1>
@foreach($threads as $thread)
    <h2><a href= "{{ action('ThreadController@view',$thread['id']) }}"> {{$thread['thread']}} ({{$thread['writes']}})</a></h2>
@endforeach



@endsection
