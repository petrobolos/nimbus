@extends('layouts.app')

@section('title', 'You are banned')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">You are banned.</div>

                    <div class="card-body">
                        <p>
                            @if (auth()->user()->isPermabanned())
                                This ban will not expire.
                            @else
                                This ban will expire on {{ humanReadableDatetime(auth()->user()->banned_until) }}
                            @endif
                        </p>
                        <p>
                            If you wish to dispute this ban, please contact the <a href="#">administrator</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
