@extends('layouts.guest') @section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6 offset-sm-3 mt-5">
      <div class="card">
        <div
          class="card-header text-center font-weight-bold h3 text-white bg-info"
        >
          RESET PASSWORD
        </div>
        <div class="card-body">
          <form
            class="md-form"
            method="POST"
            action="{{ route('password.email') }}"
          >
            {{ csrf_field() }}
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="E-Mail Address"
                  />
                  @if ($errors->has('email'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-info">
                    Send Password Reset Link
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
