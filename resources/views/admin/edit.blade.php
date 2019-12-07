@extends('layouts.admin') @section('content')
<div class="container">
  <div class="row mt-5">
    <div class="col-sm-8">
      <div class="card">
        <div
          class="card-header text-center text-white bg-info font-weight-bold h3"
        >
          ADMIN DETAILS
        </div>
        <div class="card-body">
          <form action="" class="md-form">
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="text"
                    id="name"
                    class="form-control"
                    name="name"
                    required
                  />
                  <label for="name">Name</label>
                </div>
              </div>
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    name="email"
                    required
                  />
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="text-center col-sm-12">
                <button class="btn btn-warning " type="submit">
                  <i class="fas fa-edit"></i> EDIT
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
