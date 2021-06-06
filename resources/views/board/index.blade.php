<?php
?>
<p>スレッド作成</p>
@if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{Form::open(['action' => 'BoardController@post'])}}
{{Form::token()}}
{{Form::hidden('board_id', $id)}}
{{Form::text('thread', null, ['class' => 'form-control', 'id' => 'inputThread', 'placeholder' => 'タイトル'])}}
<br>
{{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
<br>
{{Form::text('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'メール'])}}
<br>
{{Form::textarea('response', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
<br>
{{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
<hr>
@foreach($datas as $data)
{{var_dump($data['thread'])}}
    <?php // protectedデータにアクセスする為には"\0*\0"."items"と書く必要がある ?>
    @foreach($data["\0*\0"."items"] as $response)
        {{var_dump($response)}}
    @endforeach

@endforeach
