@extends('layouts.game')

@section('title', $game->description)

@section('meta-robots', 'noindex,nofollow')

@section('meta-description', $game->description)

@section('content')
    <div class="container">
        <game-component :initial-game="{{ json_encode($game, JSON_THROW_ON_ERROR) }}">
        </game-component>
    </div>
@endsection
