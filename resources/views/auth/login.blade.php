@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 well" style="background-color: transparent; min-width: 250px; height: 480px;">
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
                               class="form-control" 
                               placeholder="Password" 
                               autocomplete="off" 
                               required>
                    </div>
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

        <div class="col-md-9 well text-center" style="background-color: transparent; height:auto; min-height:480px;">
            <img src="{{ asset('assets/img/semut-pemda.png') }}" style="height: 500px;" alt="Semut Pemda">
        </div>
    </div>
</div>
@endsection