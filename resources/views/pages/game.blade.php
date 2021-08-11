@extends('layouts.game')

@section('title', 'Game')

@section('content')
    <div class="container">
        <game-component :game="{{ json_encode($game, JSON_THROW_ON_ERROR) }}"></game-component>
    </div>
@endsection
