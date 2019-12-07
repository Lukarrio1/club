@extends('layouts.guest')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6 offset-sm-3 mt-5">
      <div class="card">
        <div
          class="card-header text-center font-weight-bold h3 text-white bg-info"
        >
          ADMIN LOGIN
        </div>
        <div class="card-body">
          <form
            class="md-form"
            action="{{ route('admin.login.submit') }}"
            method="POST"
          >
            {{ csrf_field() }}
            <div class="row">
              <div class="mb-2 col-sm-10 offset-sm-1">
                <div class="md-form ">
                  <input type="email" id="email" class="form-control" name="email" required/>
                  <label for="email">E-mail</label>
                  @if ($errors->has('email'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="mb-4 col-sm-10 offset-sm-1">
                <div class="md-form ">
                  <input type="password" id="password" class="form-control" name="password" required/>
                  <label for="password">Password</label>
                  @if ($errors->has('password'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-info " type="submit">
                Sign in
              </button>
            </div>
          </form>
          <div class="d-flex justify-content-around">
                <div>
                  <a href="{{ route('admin.password.request') }}"
                    >Forgot password?</a
                  >
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
