@extends('layouts.game')

@section('title', 'Game')

@section('content')
    <div class="container">
        <game-component :game="{{ json_encode($game) }}"></game-component>
    </div>
@endsection
