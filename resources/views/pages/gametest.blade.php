@extends('layouts.game')

@section('content')
    <div class="container">
        <!-- Game Component Start -->

        <div class="row">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <span>
                            <strong>
                                Game Type | No: Game ID
                            </strong>
                        </span>
                    </div>
                    <img src="{{ asset('images/fighters/goku/goku.gif') }}" alt="Goku" class="img-fluid card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title">
                            Goku
                        </h5>
                        <p class="card-text">
                            Goku description
                        </p>
                    </div>
                </div>

                <!-- Game Stats Component Start -->
                <div class="table-responsive text-center">
                    <table class="table table-sm table-bordered align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">HP</th>
                                <th scope="col">SP</th>
                                <th scope="col">Attack</th>
                                <th scope="col">Defense</th>
                                <th scope="col">Speed</th>
                                <th scope="col">Special</th>
                                <th scope="col">Spirit</th>
                            </tr>
                        </thead>
                        <tbody class="table-striped">
                            <tr>
                                <th scope="row">You</th>
                                <td>HP</td>
                                <td>SP</td>
                                <td>Attack</td>
                                <td>Defense</td>
                                <td>Speed</td>
                                <td>Special</td>
                                <td>Spirit</td>
                            </tr>
                            <tr>
                                <th scope="row">Opponent</th>
                                <td>HP</td>
                                <td>SP</td>
                                <td>Attack</td>
                                <td>Defense</td>
                                <td>Speed</td>
                                <td>Special</td>
                                <td>Spirit</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Game Stats Component End -->

                <!-- Game Abilities Component Start -->
            </div>

            <aside class="col-md-4">
                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-warning btn-block" type="button">Report Issue</button>
                    <button class="btn btn-danger btn-block" type="button">Disconnect</button>
                </div>
                <!-- Game Chat Component Start -->
                <div class="position-sticky">
                    <form role="form">
                        <div class="mb-3">
                            <label for="game-log" class="sr-only">Game Log</label>
                            <textarea
                                class="form-control form-control-lg"
                                id="game-log"
                                name="game-log"
                                style="resize: none"
                                placeholder="Game info will be displayed here."
                                disabled="disabled"
                                rows="20">
                </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="game-chat" class="sr-only">Game Chat</label>
                            <textarea
                                class="form-control form-control-lg"
                                id="game-chat"
                                name="game-chat"
                                style="resize: none"
                                placeholder="Chat with your opponent here.">
                </textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Chat</button>
                            <button class="btn btn-secondary btn-block" type="reset">Clear</button>
                        </div>
                    </form>
                </div>
                <!-- Game Chat Component End -->
            </aside>
        </div>

        <div class="row">
            <div class="col-9">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                    <!-- Ability -->
                    <div class="col d-flex align-items-start">
                        <div class="btn-group-vertical me-3 gap-1">
                            <button class="btn btn-sm btn-primary me-3" type="button">Use</button>
                            <button class="btn btn-sm btn-secondary me-3" type="button">Info</button>
                        </div>
                        <div>
                            <div class="d-flex align-content-between">
                                <h4 class="fw-bold mb-0">Title</h4>
                                <span class="badge rounded-pill bg-danger">HP</span>
                                <span class="badge rounded-pill bg-primary">SP</span>
                            </div>
                            <p>Paragraph text</p>
                        </div>
                    </div>
                    <!-- Ability -->
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
        <!-- Game Component End -->
    </div>
@endsection
