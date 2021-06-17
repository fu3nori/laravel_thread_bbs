@extends('layouts.board')
@section('title', 'カテゴリー選択')
@section('content')
    <h2><a href="../">トップに戻る</a></h2>
    <h1>カテゴリー選択</h1>
    @foreach($categorys as $category)

            <h2><a href="{{ action('CategoryController@view', $category->id) }}">{{ $category->category }}</a></h2>
    @endforeach
@endsection



@section('footer')
    2021
@endsection
