@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
        <div class="col-sm-4 mt-4">
            <div class="card">
              <div class="card-header bg-white">
                <div class="md-form">
                  <input
                    type="text"
                    id="searchMessage"
                    class="form-control"
                    placeholder="Search Club"
                  />
                </div>
              </div>
              <div class="card-body">
                <div
                  style="height: 375px; overflow: auto; overflow-x: hidden;"
                  class="align"
                >
                  <ul
                    id="allClubs"
                    class="list-group list-group-flush"
                    class="mr-4"
                  ></ul>
                </div>
              </div>
            </div>
          </div>
         <div class="col-sm-8 mt-4">
             <div class="card">
                 <div class="text-center text-dark font-weight-bold h3 bg-white card-header" id="clubNameFm">
                     Messsage
                 </div>
                 <div class="card-body">
                    <div class="card-body">
                        <div
                          style="height: 280px; overflow: auto; overflow-x: hidden;"
                          class="align"
                          id="messageBottom"
                        >
                          <div id="allMessages"></div>
                        </div>
                        <form id="sendMessage">
                          <hr>
                          <div class="md-form">
                            <input
                            type="text"
                            placeholder="type here .."
                            id="message"
                            class="form-control"
                            />
                          </div>
                        </form>
                      </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection