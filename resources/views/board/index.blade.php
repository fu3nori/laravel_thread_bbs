<?php
?>
<p>スレッド作成</p>

{{Form::open(['action' => 'BoardController@post'])}}
{{Form::token()}}
{{Form::text('title', null, ['class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'タイトル'])}}
<br>
{{Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '氏名'])}}
<br>
{{Form::text('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'メール'])}}
<br>
{{Form::textarea('text', null, ['class' => 'form-control', 'id' => 'inputText', 'placeholder' => '本文'])}}
<br>
{{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
