@extends('layouts.bbs')

@section('content')


    @foreach($categorys as $category)

            <li>ID：{{$category['id']}}</li>
            <li><a href="{{ action('CategoryController@index', $category->id) }}">{{ $category->id }}</a></li>

    @endforeach
@endsection



@section('footer')
    2021
@endsection
