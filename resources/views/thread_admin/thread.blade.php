<?php
?>
@extends('layouts.board')

@section('title', 'スレッド・レス管理')
@section('content')
@include('layouts.admin_menu')
{{--システムメッセージ--}}
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
    <h1>スレッド管理</h1>

    

@endsection
