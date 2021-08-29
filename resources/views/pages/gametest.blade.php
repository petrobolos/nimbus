@extends('layouts.game')

@section('content')
    <div class="container">
        <!-- Game Component Start -->

        <div class="row">
            <aside class="col-3">
                <h4>Abilities:</h4>
                <div class="col d-flex align-items-start">
                    <div class="btn-group-vertical me-3 gap-1">
                        <button class="btn btn-sm btn-primary me-3" type="button">Use</button>
                        <button class="btn btn-sm btn-secondary me-3" type="button">Info</button>
                    </div>
                    <div>
                        <div class="d-flex align-content-between">
                            <h4 class="fw-bold mb-0"><abbr title="An extended description of what this does.">Title</abbr></h4>
                        </div>
                        <span class="badge bg-danger rounded-pill">HP</span>
                        <span class="badge bg-primary rounded-pill">SP</span>
                        <p>Paragraph text</p>
                    </div>
                </div>
                <hr />
                <h4>Switch:</h4>
                <div class="col d-flex align-items-start">
                    <div class="btn-group-vertical me-3 gap-1">
                        <button class="btn btn-sm btn-primary me-3" type="button">Use</button>
                        <button class="btn btn-sm btn-secondary me-3" type="button">Info</button>
                    </div>
                    <div>
                        <div class="d-flex align-content-between">
                            <h4 class="fw-bold mb-0">Title</h4>
                        </div>
                        <span class="badge bg-danger rounded-pill">HP</span>
                        <span class="badge bg-primary rounded-pill">SP</span>
                        <p>Paragraph text</p>
                    </div>
                </div>
            </aside>

            <div class="col-md-6">
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
                        <div class="progress">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                role="progressbar"
                                aria-valuenow="75"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: 75%"
                            >
                                HP: 75%
                            </div>
                        </div>
                        <div class="progress">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                role="progressbar"
                                aria-valuenow="75"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: 75%"
                            >
                                SP: 75%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Game Stats Component Start -->
                <div class="table-responsive text-center">
                    <table class="table table-sm table-bordered align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">HP Bonus</th>
                                <th scope="col">SP Bonus</th>
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

            <aside class="col-md-3">
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
        <!-- Game Component End -->
    </div>
@endsection
