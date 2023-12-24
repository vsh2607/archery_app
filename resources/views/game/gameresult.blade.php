@extends('base_page')
@section('content')
    <div class="container mt-5">
        @php
            $date = new DateTime($game_results->game_player_date);
            $formattedDate = $date->format('d F Y');
        @endphp

        <h1 class="text-primary">Permainan #{{ $game_results->id }} {{ $formattedDate }}</h1>
        <div class="mt-5"></div>
        <div class="row">
            <div class="col-8">
                @foreach ($game_results->sessions as $game_result)
                    <div class="row">
                        <div class="row">
                            <div class="col-8">
                                <h3>Sesi {{ $game_result->session_number }}</h3>
                                <div class="mt-3"></div>
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
                                    <tbody>
                                        @foreach ($game_result->playerSessions as $key => $player)
                                            <tr class="player{{ $key }}-row">
                                                <th style="width: 100px">
                                                    {{ $player->player_name }}
                                                </th>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    @php
                                                        $var = 'player_shot' . $i;
                                                    @endphp
                                                    <td>
                                                        {{ (int) $player->$var }}

                                                    </td>
                                                @endfor
                                                <td class="player{{ $key }}-total-score clear-class">
                                                    <b>{{ $player->player_total_score }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="mt-5"></div>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-dark px-5 mb-5">Kembali</a>

        


      
        
    </div>
@endsection
