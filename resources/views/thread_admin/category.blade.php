<?php
?>
@extends('layouts.board')

@section('content')


<h1>カテゴリー管理</h1>
<h2>カテゴリー新規作成</h2>
カテゴリー名：<br>
{{Form::open(['url' => '/thread_admin/category'])}}
{{Form::token()}}
{{--ここからのpostは新規作成になる--}}
{{Form::hidden('method', 'insert')}}

{{Form::text('category', null, ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'カテゴリー名'])}}<br>
ソート優先度(0が最優先、数値が上がるごとに後になる)：<br>
{{Form::text('sort', null, ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'ソート順'])}}<br>

{{Form::submit('新規作成', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
<hr>



<h2>カテゴリー更新</h2>
@foreach($categorys as $category)
    カテゴリー名：{{$category['category']}}<br>
    {{Form::open(['url' => '/thread_admin/category'])}}
    {{Form::token()}}
    削除{{Form::checkbox('delete', '0', false)}}<br>
    {{Form::hidden('id', $category['id'])}}
    {{--ここからのpostは更新になる--}}
    {{Form::hidden('method', 'update')}}

    {{Form::text('category', $category['category'], ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'カテゴリー名'])}}<br>
    ソート優先度(0が最優先、数値が上がるごとに後になる)：{{$category['sort']}}<br>
    {{Form::text('sort', $category['sort'], ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'ソート順'])}}<br>

    {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}
    <hr>

@endforeach

@endsection
