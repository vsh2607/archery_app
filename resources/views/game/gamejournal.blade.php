@extends('base_page')
@section('content')
    <div class="mt-5"></div>
    <div class="mt-5"></div>
    <div class="mt-5"></div>
    <div class="container mt-5">
    
        <table id="myJournal" class="table table-striped table-bordered" style="width: 100%">
            <thead class="thead-dark">
                <tr>
                    <th>Kode Permainan</th>
                    <th>Tanggal Permainan</th>
                    <th>Jumlah Sesi</th>
                    <th>Jumlah Pemain</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>



                @foreach ($games as $game)
                    @php
                        $date = new DateTime($game->game_player_date);
                        $formattedDate = $date->format('d F Y');
                    @endphp

                    <tr>
                        <td>Permainan #{{ $game->id }}</td>
                        <td>{{ $formattedDate }}</td>
                        <td>{{ $game->game_player_session }}</td>
                        <td>{{ $game->game_player_total }}</td>
                        <td>
                            <a href="/get-game-detail/{{ $game->id }}" class="btn btn-xl btn-success">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5"></div>
        <div class="mt-5"></div>
        <div class="mt-5"></div>

        <a href="javascript:history.back()" class="btn btn-dark px-5">Kembali</a>
    </div>
@endsection
