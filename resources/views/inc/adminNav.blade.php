
        <header>
          <!-- Sidebar navigation -->
          <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
              <!-- Logo -->
              <li>
                <div class="logo-wrapper waves-light">
                  <a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"></a>
                </div>
              </li>
              <li>
                <ul class="collapsible collapsible-accordion">
                <li><a class="text-dark waves-effect" href="{{route('admin.users')}}"><i class="fas fa-user-friends"></i> Users</a>
                  </li>
                  <li><a href="{{route('admin.clubs')}}" class="collapsible-header waves-effect"><i class="fas fa-university"></i> Clubs

               </a>
                    
                  </li>
                  <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> About<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                      <ul class="list-unstyled">
                        <li><a href="#" class="waves-effect">Introduction</a>
                        </li>
                        <li><a href="#" class="waves-effect">Monthly meetings</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-envelope"></i> Contact me<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                      <ul class="list-unstyled">
                        <li><a href="#" class="waves-effect">FAQ</a>
                        </li>
                        <li><a href="#" class="waves-effect">Write a message</a>
                        </li>
                        <li><a href="#" class="waves-effect">FAQ</a>
                        </li>
                        <li><a href="#" class="waves-effect">Write a message</a>
                        </li>
                        <li><a href="#" class="waves-effect">FAQ</a>
                        </li>
                        <li><a href="#" class="waves-effect">Write a message</a>
                        </li>
                        <li><a href="#" class="waves-effect">FAQ</a>
                        </li>
                        <li><a href="#" class="waves-effect">Write a message</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </li>
              <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
          </div>
          <!--/. Sidebar navigation -->
          <!-- Navbar -->
          <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
              <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fas fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
              <p>Material Design for Bootstrap</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
              {{-- <li class="nav-item">
                <a class="nav-link"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link"><i class="fas fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link"><i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>
              </li> --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                <span id="navAdminName"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route('admin.edit')}}"><i class="fas fa-user"></i> My Account</a>
                 <a href="{{ route('logout') }}"
                 class="dropdown-item"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}

                        </form>
                </div>
              </li>
            </ul>
          </nav>
          <!-- /.Navbar -->

        </header>
