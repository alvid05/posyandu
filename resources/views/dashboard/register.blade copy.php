@extends('dashboard.template.panel')
@section('form', 'Register Akun')
@section('content')
<div class="text-center mb-3">
<a href="{{route('home')}}">
    <img src="{{ asset('template-front/assets/images/logo.png') }}" width="128px" alt="">
</a>
</div>
<form method="POST" action="{{route('registering')}}">
  @csrf
  <div class="form-group">
    <div class="input-group input-group-merge input-group-alternative mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
      </div>
      <input name="username" class="form-control" placeholder="Username">
    </div>
    @error('username')
        <p class="text-warning small">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group">
    <div class="input-group input-group-merge input-group-alternative mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
      </div>
      <input name="name" class="form-control" placeholder="Name" type="text">
    </div>
    @error('name')
        <p class="text-warning small">{{ $message }}</p>
    @enderror
  </div>
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
    <div class="input-group input-group-merge input-group-alternative mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
      </div>
      <input name="phone_number" class="form-control" placeholder="Nomor Ponsel">
    </div>
    @error('phone_number')
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
  <div class="form-group">
    <div class="input-group input-group-merge input-group-alternative">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
      </div>
      <input name="confirm_password" class="form-control" placeholder="Confirm Password" type="password">
    </div>
    @error('confirm_password')
        <p class="text-warning small">{{ $message }}</p>
    @enderror
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-dark mt-4">Register</button>
    <p class="small mt-2">Sudah memiliki akun? <a href="{{route('login')}}">Login</a> Sekarang</p>
  </div>
</form>
@endsection
