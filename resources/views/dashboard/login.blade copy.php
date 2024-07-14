@extends('dashboard.template.panel')
@section('form', 'Login Posyandu')
@section('content')
    <div class="text-center mb-3">
        <a href="{{ route('home') }}">
            <img src="{{ asset('dashboard/assets/img/daihatsu.png') }}" width="158px" alt="">
        </a>
    </div>

    <form method="POST" action="{{ route('logining') }}">
        @csrf
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input name="email" class="form-control" placeholder="Email" type="email">
            </div>
            @error('email')
                <p class="text-warning small">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input name="password" class="form-control" placeholder="Password" type="password">
            </div>
            @error('password')
                <p class="text-warning small">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">Login</button>
            {{-- <p class="small mt-2">Sudah memiliki akun? <a href="{{route('register')}}">Register</a> Sekarang</p> --}}
        </div>
    </form>
@endsection
