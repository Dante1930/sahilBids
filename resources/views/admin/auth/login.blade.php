@extends('layouts.app')
@section('content')
<div class="login-box">
   <div class="login-logo">
      <a href="../../index2.html"><b>Bigger</b>Bids</a>
   </div>
   <!-- /.login-logo -->
   <div class="card">
      <div class="card-body login-card-body">
         <p class="login-box-msg">Sign in to start your session</p>
         <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="input-group mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror               
            </div>
            <div class="input-group mb-3">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="row">
               <!-- /.col -->
               <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
               </div>
               <!-- /.col -->
            </div>
          </form>
      </div>
      <!-- /.login-card-body -->
   </div>
</div>
@endsection