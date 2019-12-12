@extends('layouts.admin') @section('content')
<div class="container-fuild">
  <div class="row">
    <div class="col-sm-12 mt-3">
      <div class="card">
        <div class="card-header bg-white">
          <div class="row">
            <div class="col-sm-9">
              <div class="md-form">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Search User"
                  id="searchUser"
                />
              </div>
            </div>
            <div class="col-sm-1 mt-4 text-center ">
              <span class="badge badge-info" id="allUserCount">0</span>
            </div>
            <div class="col-sm-2 mt-4 text-left">
              <a
                href=""
                class="btn btn-sm btn-rounded btn-outline-info"
                data-toggle="modal"
                data-target="#modalContactForm"
                id="editCreateModal"
                ><i class="fas fa-plus text-info"></i> Member</a
              >
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <select
                class="mdb-select md-form colorful-select dropdown-success"
                data-val="true"
                data-val-required="The RoleID field is required."
                id="limit"
                name="limit"
              >
              <option id="limitMax" selected></option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="40">40</option>
                <option value="80">80</option>
                <option value="100">100</option>
                <option value="200">200</option>
              </select>
              <label class="mdb-main-label" for="RoleID">Show Entries</label>
            </div>
            <div class="col-sm-4">
              <select
                class="mdb-select md-form colorful-select dropdown-success"
                data-val="true"
                data-val-required="The RoleID field is required."
                id="clubSort"
                name="clubSort"
              >
      
              </select>
              <label class="mdb-main-label" for="clubSort">Show Club</label>
            </div>
            <div class="col-sm-4">
              <select
                class="mdb-select md-form colorful-select dropdown-success"
                data-val="true"
                data-val-required="The RoleID field is required."
                id="parishSort"
                name="parishSort"
              >
              <option value="all" selected>Sort by Parish</option>
                <option value="Manchester">Manchester</option>
                <option value="kingston">Kingston</option>
                <option value="Saint Elizabeth">Saint Elizabeth</option>
                <option value="Hanover">Hanover</option>
                <option value="Saint James">Saint James</option>
                <option value="Westmoreland">Westmoreland</option>
                <option value="Clarendon">Clarendon</option>
                <option value="Saint Ann">Saint Ann</option>
                <option value="Saint Catherine">Saint Catherine</option>
                <option value="Saint Mary">Saint Mary</option>
                <option value="Portland">Portland</option>
                <option value="Saint Andrew">Saint Andrew</option>
                <option value="Saint Thomas">Saint Thomas</option>
              </select>
              <label class="mdb-main-label" for="RoleID">Show parish</label>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                  <th scope="col">Telephone</th>
                  <th scope="col">TRN</th>
                  <th scope="col">Address</th>
                  <th scope="col">Parish</th>
                  <th scope="col">Club</th>
                  <th scope="col">Joined</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="userDisplayTable">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div
    class="modal fade"
    id="modalContactForm"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center bg-info text-white" id="editModalHeaderColor">
          <h4 class="modal-title w-100 font-weight-bold" id="editModalHeader">Add Member</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            id="closeCreateUserModalBtn"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <form id="createUserForm">

            <div class="md-form mb-5">
              <i class="fas fa-user prefix grey-text"></i>
              <input
              type="text"
              id="name"
              class="form-control createUser"
              name="name"
              placeholder="Member Name"
              />
          </div>
          
          <div class="md-form mb-5">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input
            type="email"
            id="email"
              name="email"
              class="form-control createUser"
              placeholder="Member E-mail"
              />
            </div>
            <div class="md-form mb-5">
            <i class="fas fa-mobile-alt  prefix grey-text"></i>
            <input
            type="number"
              id="phone"
              name="phone"
              class="form-control createUser"
              placeholder="Member Telephone"
              />
            </div>
          <div class="md-form mb-5">
            <select
                class="mdb-select md-form colorful-select dropdown-success createUser"
                data-val="true"
                id="parish"
                name="parish"
              >
              <option selected disabled>Member Parish</option>
                <option value="Manchester">Manchester</option>
                <option value="kingston">Kingston</option>
                <option value="Saint Elizabeth">Saint Elizabeth</option>
                <option value="Hanover">Hanover</option>
                <option value="Saint James">Saint James</option>
                <option value="Westmoreland">Westmoreland</option>
                <option value="Clarendon">Clarendon</option>
                <option value="Saint Ann">Saint Ann</option>
                <option value="Saint Catherine">Saint Catherine</option>
                <option value="Saint Mary">Saint Mary</option>
                <option value="Portland">Portland</option>
                <option value="Saint Andrew">Saint Andrew</option>
                <option value="Saint Thomas">Saint Thomas</option>
              </select>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-list-ol prefix grey-text"></i>
            <input
            type="number"
            id="trn"
            name="trn"
            class="form-control createUser"
            placeholder="Member TRN"
            />
          </div>
          <div class="mb-5">
              <select
              class="mdb-select md-form colorful-select dropdown-success createUser"
              id="gender"
              name="gender"
              >
              <option selected disabled class="grey-text">Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-list-ol prefix grey-text"></i>
            <input
            type="number"
            id="age"
            name="age"
            class="form-control createUser"
            placeholder="Member Age"
            />
          </div>
          <div class="md-form mb-5">
            <i class="fas fa-map-marker-alt prefix grey-text"></i>
            <input
            type="text"
            id="address"
            name="address"
            class="form-control createUser"
            placeholder="Member Address"
            />
          </div>
          <div class="mb-5">
            <select
            class="mdb-select md-form colorful-select dropdown-success createUser"
            id="club"
            name="club"
            >
            <option selected disabled class="grey-text">Member Club</option>
          </select>
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-lock  prefix grey-text"></i>
            <input
            type="text"
              id="password"
              name="password"
              class="form-control createUser"
              placeholder="Member Password"
              />
            </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-success" id="editModalSubmitBtn">
            <i class="fas fa-plus"></i> CREATE
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
  </div>
</div>
  @endsection
