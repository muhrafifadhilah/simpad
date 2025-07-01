@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 well">
            <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                @csrf
                
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @error('userid')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <legend>Login Page</legend>
                
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="userid" 
                               class="form-control @error('userid') is-invalid @enderror" 
                               placeholder="User ID" 
                               value="{{ old('userid') }}"
                               autocomplete="off" 
                               required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Password" 
                               autocomplete="off" 
                               required>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" 
                           class="form-check-input" 
                           id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        height: 90vh; /* Membuat body memiliki tinggi 100% dari viewport */
        margin: 0;
        display: flex;
        justify-content: center; /* Memusatkan secara horizontal */
        align-items: center; /* Memusatkan secara vertikal */
        background-image: url('{{ asset("assets/img/semut-pemda.png") }}');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center 90px;
    }

    .container-fluid {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .row {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .col-md-3 {
        background-color: rgba(255, 255, 255, 0.4); /* Warna putih dengan transparansi 80% */
        min-width: 450px;
        height: auto;
        max-width: 400px;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 10px; /* Membuat sudut kolom login menjadi melengkung */
        backdrop-filter: blur(10px); /* Menambahkan efek blur pada latar belakang */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Memberikan bayangan halus di sekitar form */
    }
</style>
@endsection
