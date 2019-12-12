@extends('layouts.admin') @section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 mt-3">
      <div class="card">
        <div class="card-header bg-white">
          <div class="row">
            <div class="col-sm-9 ">
              <div class="md-form">
                <input
                  type="text"
                  placeholder="Search Club"
                  id="searchClub"
                  class="form-control"
                />
              </div>
            </div>
            <div class="col-sm-1 mt-4 text-right">
              <span id="clubCounts" class="badge badge-info">0</span>
            </div>
            <div class="col-sm-2 mt-4 text-center">
              <button
                type="button"
                class="btn btn-sm btn-outline-info btn-rounded waves-effect "
                data-toggle="modal"
                data-target="#createClubModal"
              >
                <i class="fas fa-plus"></i> Club
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-striped table-bordered ">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Member amount</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="clubOutPut"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div
    class="modal fade"
    id="createClubModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header text-center">
          <h4 class="modal-title white-text w-100 font-weight-bold py-2">
            Add New Club
          </h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            id="closeCreateClubModal"
          >
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <form id="createClub">
            <div class="md-form mb-5">
              <i class="fas fa-file-signature prefix grey-text"></i>
              <input
                type="text"
                placeholder="Club Name"
                name="name"
                class="form-control createClub"
              />
            </div>
            <div class="md-form">
              <i class="fas fa-map-marker-alt prefix grey-text"></i>
              <input
                type="text"
                placeholder="Club Location"
                name="location"
                class="form-control createClub"
              />
            </div>

            <div class="col-sm-12 text-center mb-3">
              <button type="submit" class="btn btn-info">create</button>
            </div>
          </form>
        </div>

        <!--Footer-->

        <!--/.Content-->
      </div>
    </div>
  </div>

  <!-- edit modal -->
  <div
    class="modal fade"
    id="clubEditModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-notify modal-warning" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header text-center">
          <h4 class="modal-title white-text w-100 font-weight-bold py-2">
            Edit Modal
          </h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            id="closeEditClubModal"
          >
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <form id="clubEditModal">
            <div class="md-form mb-5">
              <i class="fas fa-file-signature prefix grey-text"></i>
              <input
                type="text"
                placeholder="Club Name"
                name="name"
                class="form-control editClub"
              />
            </div>
            <div class="md-form">
              <i class="fas fa-map-marker-alt prefix grey-text"></i>
              <input
                type="text"
                placeholder="Club Location"
                name="location"
                class="form-control editClub"
              />
            </div>

            <div class="col-sm-12 text-center mb-3">
              <button type="submit" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
              </button>
            </div>
          </form>
        </div>

        <!--Footer-->

        <!--/.Content-->
      </div>
    </div>
  </div>
</div>
@endsection
