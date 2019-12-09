@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mt-3">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-sm-9 ">
                            <div class="md-form">
                                <input type="text" placeholder="Search Club" id="searchClub" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-1 mt-4 text-right">
                            <span id="clubCounts" class="badge badge-info">0</span>
                        </div>
                        <div class="col-sm-2 mt-4 text-center">
                        <button type="button" class="btn btn-sm btn-outline-info btn-rounded waves-effect "data-toggle="modal" data-target="#createClubModal"><i class="fas fa-plus"></i> Club</button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <!--Table-->
                            <table class="table table-striped table-bordered ">

                                <!--Table head-->
                                <thead>
                                    <tr class="text-center" >
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Member amount</th>
                                        <th>Created At</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>
                                    <tr class="table-info">
                                        <th scope="row">1</th>
                                        <td>Kate</td>
                                        <td>Moss</td>
                                        <td>USA</td>
                                        <td>New York City</td>
                                        <td>
                                            <div class="row">
                                            <div class="col-sm-6 text-right">
                                            <a href="#!" title ="Edit"class="text-warning"><i class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="col-sm-6 text-left">
                                            <a href="#!" title ="Delete"class="text-danger"><i class="fas fa-trash"></i></a>
                                            </div>

                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Anna</td>
                                        <td>Wintour</td>
                                        <td>United Kingdom</td>
                                        <td>London</td>

                                        <td>
                                        <div class="row">
                                            <div class="col-sm-6 text-right">
                                            <a href="#!" title= "Edit"class="text-warning"><i class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="col-sm-6 text-left">
                                            <a href="#!" title ="Delete"class="text-danger"><i class="fas fa-trash"></i></a>
                                            </div>

                                            </div>

                                        </td>
                                    </tr>

                                </tbody>
                                <!--Table body-->


                            </table>
                            <!--Table-->

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="createClubModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Add New Club</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
          <form id="createClub">
        <div class="md-form mb-5">
        <i class="fas fa-file-signature prefix grey-text"></i>
          <input type="text" placeholder="Club Name" name="name" class="form-control createClub">
        </div>
        <div class="md-form">
        <i class="fas fa-map-marker-alt prefix grey-text"></i>
          <input  type="text" placeholder="Club Location" name="location" class="form-control createClub">

        </div>
      </div>

      <div class="col-sm-12 text-center mb-3">
            <button type="submit" class="btn btn-info">create</button>

      </div>
      </form>

      <!--Footer-->

    <!--/.Content-->
  </div>
</div>
</div>
@endsection
