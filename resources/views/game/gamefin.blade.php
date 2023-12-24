@extends('base_page')

@section('content')
    <div class="container">
        <div class="row full-height">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('logos/archery_target2.png') }}" height="200" width="200" alt="">
                <h1 class="text-dark mt-5"><b>Permainan Berakhir!</b></h1>
                <div class="mt-5"></div>
                <a href="/get-game-detail/{{ $game_id }}" class="btn btn-dark btn-lg ml-3">Lihat Hasil Permainan</a>
                <div class="mt-3"></div>
                <a href="{{ route('welcome') }}" class="btn btn-dark btn-lg ml-3">Kembali ke Halaman Awal</a>
            </div>
        </div>
    </div>
@endsection
