@extends('pages.game.game')

@section('content')
    <div class="container">
        <game-component
            :initial-game="{{ json_encode($game, JSON_THROW_ON_ERROR) }}"
            :demo-information="{{ json_encode($demo, JSON_THROW_ON_ERROR) }}"
        ></game-component>
    </div>
@endsection
