<?php
?>
@extends('layouts.board')

@section('title', 'カテゴリ管理メニュー')
@section('content')
@include('layouts.admin_menu')
<p>入力ミスでエラーが出た場合はリロードボタンをクリックしてください</p>
<h1>カテゴリー管理</h1>
<h2>カテゴリー新規作成</h2>
カテゴリー名：<br>
{{Form::open(['url' => '/thread_admin/category'])}}
{{Form::token()}}
{{--ここからのpostは新規作成になる--}}
{{Form::hidden('method', 'insert')}}

{{Form::text('category', null, ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'カテゴリー名'])}}<br>
ソート優先度(半角整数入力　0が最優先、数値が上がるごとに後になる)：<br>
{{Form::text('sort', 0, ['class' => 'form-control', 'id' => 'inputCategory', 'placeholder' => 'ソート順'])}}<br>

{{Form::submit('新規作成', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}

<p><input type="button" value="リロード" onclick="window.location.reload();"></p>
<hr>

<h2>カテゴリー更新</h2>

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

<?php $i = 1; ?>
@foreach($categorys as $category)
    <?php $i++; ?>
    カテゴリー名：{{$category['category']}}<br>
    {{Form::open(['url' => '/thread_admin/category'])}}
    {{Form::token()}}
    削除{{Form::checkbox('delete', '1', false)}}<br>
    {{Form::hidden('id', $category['id'])}}
    {{--ここからのpostは更新になる--}}
    {{Form::hidden('method', 'update')}}

    {{Form::text('category'.$category['id'], $category['category'], ['class' => 'form-control', 'id' => 'inputCategory'.$i, 'placeholder' => 'カテゴリー名'])}}<br>
    ソート優先度(半角整数入力　0が最優先、数値が上がるごとに後になる)：{{$category['sort']}}<br>
    {{Form::text('sort'.$category['id'], $category['sort'], ['class' => 'form-control', 'id' => 'inputCategory'.$i, 'placeholder' => 'ソート順'])}}<br>

    {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
    {{Form::close()}}
    <hr>
@endforeach

@endsection
