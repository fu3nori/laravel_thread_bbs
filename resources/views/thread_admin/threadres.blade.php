<?php
?>

        @extends('layouts.board')
        @section('title', $thread['thread'] )

        @section('content')
            <h2>{{$msg}}</h2>
            <h1>{{$thread['thread']}}　{{$thread['writes']}}レス</h1>
            @foreach($responses as $response)


                <br>
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
                {{Form::open(['url' => '/thread_admin/deleteres'])}}
                {{Form::hidden('thread_id', $id)}}
                {{Form::hidden('response_id', $response['id'])}}
                {{Form::hidden('mode', 'delete')}}
                {{Form::submit('該当レス削除', ['class'=>'btn btn-primary btn-block'])}}
                {{Form::close()}}
            @endforeach

