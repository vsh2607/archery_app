@extends('base_page')

@section('content')
    <div class="container">
        <div class="row full-height">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('logos/archery_target.png') }}" height="200" width="200" alt="">
                <h1 class="text-dark mt-5"><b>Selamat Datang di Archery!</b></h1>
                <div class="mt-5"></div>
                <a href="{{ route('new-game') }}" class="btn btn-dark btn-lg mr-5">Mulai Permainan</a>
                <div class="mt-3"></div>
                <a href="{{ route('journal-game') }}" class="btn btn-dark btn-lg ml-3">Lihat Journal Permainan</a>
            </div>
        </div>
    </div>
@endsection
