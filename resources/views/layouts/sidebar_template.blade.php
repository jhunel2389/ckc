<!-- Sidebar Menu -->
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if(empty($utils::getUserAvatar()))
              <img src="{{asset('resources/dist/img/empty_avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{asset('images/'.$utils::getUserAvatar())}}" class="img-circle elevation-2" alt="User Image">
            @endif
          </div>
          <div class="info">
            <a href="{{ url('/profile') }}" class="d-block">{{Auth::User()->firstname}} {{Auth::User()->lastname}}</a>
          </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if($utils::checkPermissions('view_dashboard'))
          <li class="nav-item has-treeview">
            <a href="{{ url('/home') }}" class="nav-link {{ (isset($side_bar) && ($side_bar == 'side_dashboard')) ? 'active' : ''  }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item has-treeview">
            <a href="{{ url('/profile') }}" class="nav-link {{ (isset($side_bar) && ($side_bar == 'side_profile')) ? 'active' : ''  }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          @if($utils::checkPermissions('view_system'))
          <li class="nav-item has-treeview {{ (isset($side_bar) && isset($sub_bar) && $side_bar == 'side_system' ) ? 'menu-open' : ''  }}">
            <a href="#" class="nav-link {{ (isset($side_bar) && ($side_bar == 'side_system')) ? 'active' : ''  }}">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                System
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($utils::checkPermissions('view_user_profile'))
              <li class="nav-item">
                <a href="{{ url('/systemUsers') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_users')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_system_roles'))
              <li class="nav-item">
                <a href="{{ url('/systemRoles') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_sys_roles')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>System Roles</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_tools'))
              <li class="nav-item">
                <a href="{{ url('/systemTools') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_tools')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tools</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_roles'))
              <li class="nav-item">
                <a href="{{ url('/systemEmployeeRoles') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_roles')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Roles</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_teams'))
              <li class="nav-item">
                <a href="{{ url('/systemTeams') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_teams')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teams</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_training_tools'))
              <li class="nav-item">
                <a href="{{ url('/systemTrainingTools') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_training')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Training</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_boolmarks'))
              <li class="nav-item">
                <a href="{{ url('/systemBookmarks') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_bookmark')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bookmarks</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if($utils::checkPermissions('view_report'))
          <li class="nav-item has-treeview {{ (isset($side_bar) && isset($sub_bar) && $side_bar == 'side_reports' ) ? 'menu-open' : ''  }}">
            <a href="#" class="nav-link {{ (isset($side_bar) && ($side_bar == 'side_reports')) ? 'active' : ''  }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($utils::checkPermissions('view_tools_proficiency'))
              <li class="nav-item">
                <a href="{{ url('/toolsProficiency') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_tool_prof')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tools Proficiency</p>
                </a>
              </li>
              @endif
              @if($utils::checkPermissions('view_training_status'))
              <li class="nav-item">
                <a href="{{ url('/trainingStatus') }}" class="nav-link {{ (isset($sub_bar) && ($sub_bar == 'sub_training_status')) ? 'active' : ''  }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Training Status</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
      </nav>
      <!-- /.sidebar-menu -->