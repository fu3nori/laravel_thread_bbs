@extends('layouts.startapp')

@section('title','view')
@section('menubar')
    @parent
    <a href="/start">インデックスページ</a> ビューページ 管理ページ
@endsection
@section('content')
    @include('layouts.logomark')

@foreach($articles as $article)
    <div class="view">
        <li>氏名：{{$article['name']}}</li>
        <li>タイトル：{{$article['title']}}</li>
        <li>投稿日：{{$article['created_at']}}</li>
        <li>本文：</li><pre class="view">{{$article['text']}}</pre>
    </div>
@endforeach
@endsection

@section('footer')
            2021
@endsection
