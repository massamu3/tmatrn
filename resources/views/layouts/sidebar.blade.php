  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">

        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('employee-management') }}"><i class="fa fa-link"></i> <span>Employee Management</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Employee Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('system-management/designation') }}">Designation</a></li>
            <li><a href="{{ url('system-management/station') }}">Stations</a></li>
            <li><a href="{{ url('system-management/division') }}">Divisions</a></li>
            <li><a href="{{ url('system-management/section') }}">Section</a></li>
            <li><a href="{{ url('system-management/status') }}">Status</a></li>
          </ul>
        </li>

        <!-- Start menu for training  Module -->
      <li class="treeview">
      <a href=""><i class="fa fa-link"></i> <span>Training Management</span>
      <span class="pull-right-container">
       <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ url('transaction-management') }}">Manage Programs</a></li>
          <li><a href="{{ url('academiclevel-management') }}">Manage Academic levels</a></li>
          <li><a href="{{ url('academiclevel-management') }}">Manage qualification</a></li>
          <li><a href="{{ url('plan-management') }}">Training Planning</a></li>
          <li><a href="{{ url('progressive-management') }}">progressive Information</a></li>
          <li><a href="{{ url('certificate-management') }}">Certificates archival</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Training Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('trn1-management/program') }}">Program</a></li>
            <li><a href="{{ url('trn1-management/school') }}">Schools</a></li>
            <li><a href="{{ url('trn1-management/school') }}">Academic levels</a></li>
            

          </ul>
        </li>

        <li><a href="{{ url('system-management/report') }}"><i class="fa fa-link"></i> <span>Reports</span></a></li>

        <!-- End menu for training Module -->
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar --> 
  </aside>