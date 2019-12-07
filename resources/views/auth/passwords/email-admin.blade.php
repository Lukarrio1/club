@extends('layouts.guest') @section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6 offset-sm-3 mt-5">
      <div class="card">
        <div
          class="card-header text-center text-white h3 font-weight-bold bg-info"
        >
          ADMIN RESET PASSWORD
        </div>
        <div class="card-body">
          <form
            action="{{ route('admin.password.email') }}"
            class="md-form"
            method="POST"
          >
            {{ csrf_field() }}
            <div class="row">
              <div class="mb-2 col-sm-10 offset-sm-1">
                <div class="md-form ">
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    name="email"
                    value="{{ old('email') }}"
                    required
                  />
                  <label for="email">E-mail</label>
                  @if ($errors->has('email'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-info">
                  Send Password Reset Link
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
