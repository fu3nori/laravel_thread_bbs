<?php
?>
{{Form::open(['url' => '/question', 'files' => true])}}

{{Form::label('title','タイトル')}}
{{Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'タイトル'])}}
<br><br>
{{Form::label('docs','本文')}}
{{Form::textarea('docs', null, ['class' => 'form-control', 'id' => 'docs', 'placeholder' => '本文', 'rows' => '3'])}}
<br><br>
{{Form::submit('送信', ['class'=>'btn btn-primary btn-block'])}}
{{Form::close()}}
