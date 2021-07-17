@extends('app')

@section('body')
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Register User</h5>
          <form class="form-signin" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group mb-3">
              <label for="name">Name</label>
              <input type="text" placeholder="Name" id="name" class="form-control" name="name"
              required autofocus>
              @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
          </div>

          <div class="form-group mb-3">
              <label for="email_address">Email address</label>
              <input type="text" placeholder="Email" id="email_address" class="form-control"
              name="email" required autofocus>
              @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
          </div>

          <div class="form-group mb-3">
              <label for="password">Password</label>
              <input type="password" placeholder="Password" id="" class="form-control"
              name="password" required>
              @if ($errors->has('password'))
              <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
          </div>

          <div class="d-grid mx-auto">
            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
        </div>

        <div class="btn btn-block form-group text-center "> <small class="font-weight-bold">Already have an account? <a class="text-danger" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a></small> </div>


    </form>
</div>
</div>
</div>
</div>
</div>
@endsection