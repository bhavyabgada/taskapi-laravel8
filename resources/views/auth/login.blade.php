@extends('app')

@section('body')
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Log In</h5>
          <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" id="email" class="form-control" placeholder="Email address" name='email' required autofocus>
              @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" class="form-control" placeholder="Password" name='password' required>
              @if ($errors->has('password'))
              <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>

            <button class="btn btn-primary btn-block" type="submit">Log in</button>

            <div class="btn btn-block form-group text-center "> <small class="font-weight-bold">Don't have an account? <a class="text-danger"  href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a></small> </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection