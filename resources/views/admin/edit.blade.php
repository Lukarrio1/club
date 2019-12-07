@extends('layouts.admin') @section('content')
<div class="container">
  <div class="row mt-5">
    <div class="col-sm-8">
      <div class="card">
        <div
          class="card-header text-center text-white bg-info font-weight-bold h3"
        >
          UPDATE ADMIN DETAILS
        </div>
        <div class="card-body">
          <form id="editAdmin" class="md-form">
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="text"
                    id="name"
                    class="form-control editAdmin"
                    name="name"
                    required
                  />
                </div>
              </div>
              <div class="col-sm-8 offset-sm-2">
                <div class="md-form">
                  <input
                    type="email"
                    id="email"
                    class="form-control editAdmin"
                    name="email"
                    required
                  />
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
    <div class="col-sm-4">
      <div class="card">
        <div
          class="card-header text-center text-white bg-info font-weight-bold h3"
        >
          ADMIN DETAILS
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-8 offset-sm-2 mb-3">
              <span class="font-weight-bold">Name:</span>&nbsp;
              <span id="adminName"></span>
              <hr />
            </div>
            <div class="col-sm-8 offset-sm-2 mb-3">
              <span class="font-weight-bold">E-Mail:</span>
              <span id="adminEmail"></span>
              <hr />
            </div>
            <div class="col-sm-12 text-center">
              <button class="btn btn-danger" id="adminDeleteAccount">
                <i class="fas fa-trash"></i>
                &nbsp; Account
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
