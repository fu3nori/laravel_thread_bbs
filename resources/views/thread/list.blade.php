<?php
    ?>
@extends('layouts.board')

@section('content')

@section('title', 'スレッド一覧')

@foreach($threads as $thread)
    <li><a href= "{{ action('ThreadController@view',$thread['id']) }}"> {{$thread['thread']}} ({{$thread['writes']}})</a></li>
@endforeach



@endsection
