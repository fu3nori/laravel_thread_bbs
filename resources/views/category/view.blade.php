<?php
?>
@foreach($boards as $board)

    <li><a href="{{ action('BoardController@index', $board->id) }}">{{ $board->board }}</a></li>
@endforeach
