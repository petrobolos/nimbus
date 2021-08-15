@extends('layouts.game')

@section('title', "Game {$game->id}")

@section('content')
    <div class="container">
        <game-component :initial-game="{{ json_encode($game, JSON_THROW_ON_ERROR) }}"></game-component>
    </div>
@endsection
