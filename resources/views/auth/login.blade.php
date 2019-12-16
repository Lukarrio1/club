@extends('layouts.guest') @section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6 offset-sm-3 mt-5">
      <div class="card">
        <div
          class="card-header font-weight-bold h3 text-center text-white bg-info"
        >
          MEMBER LOGIN
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}" class="md-form">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    required
                    placeholder="E-Mail"
                  />
                  @if ($errors->has('email'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Password"
                    required
                  />
                  @if ($errors->has('password'))
                  <span class="help-block danger">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-info">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
