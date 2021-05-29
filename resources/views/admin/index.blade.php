@extends('layouts.startapp')

@section('title','admin')
@section('menubar')
    @parent
    管理ページ
@endsection
@section('content')
    @include('layouts.logomark')
    <p>{{$msg}}</p>
    @foreach($articles as $article)
        <div class="div_admin">
            <li>ID:{{$article['id']}}</li>
            {{Form::open(['url' => '/admin/edit', 'files' => true])}}
            {{Form::token()}}
            削除{{Form::checkbox('delete', '0', false)}}<br>
            {{Form::hidden('id', $article['id'])}}
            {{Form::text('name', $article['name'], ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
            <br>
            {{Form::text('title', $article['title'], ['class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'タイトル'])}}
            <br>
            {{Form::textarea('text', $article['text'], ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
            <br>
            {{Form::submit('変更', ['class'=>'btn btn-primary btn-block'])}}
            {{Form::close()}}
        </div>
    @endforeach
    {{ $articles->links() }}
@endsection



@section('footer')
    2021
@endsection

