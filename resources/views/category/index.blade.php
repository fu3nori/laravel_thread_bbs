@extends('layouts.bbs')

@section('content')


    @foreach($categorys as $category)

            <li><a href="{{ action('CategoryController@view', $category->id) }}">{{ $category->category }}</a></li>
    @endforeach
@endsection



@section('footer')
    2021
@endsection
