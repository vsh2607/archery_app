@extends('base_page')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <h1>Sesi {{ $game_session }}</h1>

                </div>
            </div>
            <form action="/session-next" id="myForm" method="POST">
                @csrf
                <input type="hidden" value="{{ $game_id }}" name="game_id">
                <input type="hidden" value="{{ $game_session }}" name="game_session">
                <div class="row mt-3">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center; background-color:black">
                                        <p style="color: white">#</p>
                                    </th>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <th style="text-align: center; vertical-align: top; background-color:black">
                                            <p style="color: white">Tembakan {{ $i }}</p>
                                        </th>
                                    @endfor
                                    <th style="text-align: center; background-color:black">
                                        <p style="color: white">Total Skor</p>
                                    </th>
                                </tr>
                            </thead>


                            <tbody id="game-table">
                                @if ($session_data == null)
                                    @foreach ($game_player_names as $key => $player)
                                        <input type="hidden" name="game_player_names[]" value="{{ $player }}">
                                        <tr class="player{{ $key }}-row">
                                            <th style="width: 100px">
                                                {{ $player }}
                                            </th>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <td>
                                                    <input type="number" min="0" max="10"
                                                        class="form-control score-input-{{ $key }} highlighted"
                                                        data-row="{{ $key }}" data-colmn="{{ $i }}"
                                                        required name="score_input[]">
                                                </td>
                                            @endfor
                                            <td class="player{{ $key }}-total-score clear-class"><b>0</b></td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if ($session_data != null)
                                    @foreach ($session_data as $key => $player)
                                        <input type="hidden" name="game_player_names[]"
                                            value="{{ $player->player_name }}">
                                        <tr class="player{{ $key }}-row">
                                            <th style="width: 100px">
                                                {{ $player->player_name }}
                                            </th>
                                            @for ($i = 1; $i <= 10; $i++)
                                                @php
                                                    $var = 'player_shot' . $i;
                                                @endphp
                                                <td>
                                                    <input type="number" min="0" max="10"
                                                        value="{{ (int) $player->$var }}"
                                                        class="form-control score-input-{{ $key }} highlighted"
                                                        data-row="{{ $key }}" data-colmn="{{ $i }}"
                                                        required name="score_input[]">
                                                </td>
                                            @endfor
                                            <td class="player{{ $key }}-total-score clear-class">
                                                <b>{{ $player->player_total_score }}</b></td>
                                        </tr>
                                    @endforeach
                                @endif


                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h2>Tombol Skor</h2>
                        <div class="d-flex flex-wrap">
                            <button type="button" class="btn btn-danger btn-lg mx-2 mt-3 btn-score">0</button>
                            <button type="button" class="btn btn-danger btn-lg mx-2 mt-3 btn-score">1</button>
                            <button type="button" class="btn btn-danger btn-lg mx-2 mt-3 btn-score">2</button>
                            <button type="button" class="btn btn-warning btn-lg mx-2 mt-3 btn-score">3</button>
                            <button type="button" class="btn btn-warning btn-lg mx-2 mt-3 btn-score">4</button>
                            <button type="button" class="btn btn-warning btn-lg mx-2 mt-3 btn-score">5</button>
                            <button type="button" class="btn btn-primary btn-lg mx-2 mt-3 btn-score">6</button>
                            <button type="button" class="btn btn-primary btn-lg mx-2 mt-3 btn-score">7</button>
                            <button type="button" class="btn btn-primary btn-lg mx-2 mt-3 btn-score">8</button>
                            <button type="button" class="btn btn-success btn-lg mx-2 mt-3 btn-score">9</button>
                            <button type="button" class="btn btn-success btn-lg mx-2 mt-3 btn-score">10</button>
                            <button type="button" class="btn btn-dark btn-lg mx-2 mt-3" id="clear_button"
                                type="button"><b>Clear</b></button>
                            <button class="btn btn-dark btn-lg mx-2 mt-3" id="previous_button"
                                type="submit"><b>Previous</b></button>
                            <button class="btn btn-dark btn-lg mx-2 mt-3" id="next_button"
                                type="submit"><b>Next</b></button>
                        </div>
                    </div>
                </div>
        </div>
        </form>

    </div>
@endsection
