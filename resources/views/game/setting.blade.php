@extends('base_page')

@section('content')
    <div class="container">
        <div class="row full-height">
            <div class="col-sm-12 text-center">
                <h1 class="text-dark mt-5">Pengaturan</b></h1>
                <form action="/new-process" method="POST">
                    @csrf
                    <div class="mt-5"></div>
                    <div class="form-group row" style="justify-content: center">
                        <div class="col-sm-2">
                            <label for="total_session">
                                <p class="text-dark">Total Sesi</p>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" min="1" id="total_session"
                                name="total_session" required placeholder="Total Sesi">
                        </div>
                    </div>
                    <div class="mt-5"></div>
                    <div class="form-group row" style="justify-content: center">
                        <div class="col-sm-2">
                            <label for="total_player">
                                <p class="text-dark">Total Pemain</p>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" min="1" id="total_player" name="total_player"
                                required placeholder="Total Player">
                        </div>
                    </div>
                    <div class="mt-5"></div>
                    <div id="playerNameInputField"></div>
                    <div class="mt-5"></div>
                    <button type="submit" class="btn btn-dark btn-lg">Simpan</button>

                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
