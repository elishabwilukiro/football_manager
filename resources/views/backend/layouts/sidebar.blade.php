
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin-dashboard') }}" class="brand-link">
      <img src="{{ url('assets/Soccer_ball.svg') }}" alt="FOOTBALL MANAGER" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="" style="font-size: 15px;font-weight:700">FOOTBALL MANAGER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('assets/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('profile') }}" class="d-block">{{ (Auth::user()->first_name.' '.Auth::user()->middle_name.' '.Auth::user()->last_name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">-- MAIN</li>
          <!-- Admin Menu -->
          @if (Auth::user()->role == 'admin')                
          <li class="nav-item menu-open">
              <a href="{{ route('admin-dashboard') }}" class="nav-link  @if (Request::segment(2) == 'dashboard') active open @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-team-list') }}" class="nav-link @if (Request::segment(2) == 'team') active open @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>Manage Team</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-player-list') }}" class="nav-link @if (Request::segment(2) == 'player') active open @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>Manage Player</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-position-list') }}" class="nav-link @if (Request::segment(2) == 'position') active open @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>Manage Position</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-user-list') }}" class="nav-link  @if (Request::segment(2) == 'user') active open @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>Manage User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-setting-list') }}" class="nav-link  @if (Request::segment(2) == 'setting') active open @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>Manage Settings</p>
            </a>
          </li>
          <li class="nav-header">-- REPORTS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Top score <span class="badge badge-info right">2</span></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p> Matches Timetable </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Referee</p>
            </a>
          </li>
          @endif

          <!-- Manager Menu -->
          @if (Auth::user()->role == 'manager')                 
            <li class="nav-item menu-open">
                <a href="{{ route('manager-dashboard') }}" class="nav-link  @if (Request::segment(2) == 'dashboard') active open @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('manager-player-list') }}" class="nav-link @if (Request::segment(2) == 'player') active open @endif">
                <i class="nav-icon fas fa-tree"></i>
                <p>Player</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link @if (Request::segment(2) == 'staff') active open @endif">
                <i class="nav-icon fas fa-tree"></i>
                <p>Staff</p>
              </a>
            </li>

          @endif

          <li class="nav-item" style="border-top: 1px solid #4f5962;">
            <a href="{{ route('profile') }}" class="nav-link @if (Request::segment(2) == 'profile') active open @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
</aside>