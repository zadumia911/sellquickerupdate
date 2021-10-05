<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sellquicker || @yield('title','Dashbaord')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @foreach($faveicon as $key=>$value)
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset($value->image)}}">
    @endforeach
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/summernote/summernote-bs4.css">
  <!-- select2 -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/select2/css/select2.min.css">
  <!-- toastr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- flatpickr -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/dist/css/toastr.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/dist/css/custom.css">
  <!-- custome css -->
  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/datatables/dataTables.bootstrap4.css">
    <!-- data tab;e -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" target="_blank" class="nav-link"><i class="fas fa-desktop"></i> Visit Website</a>
      </li>
    </ul>

      <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-edit"></i>
          <span class="badge badge-danger navbar-badge">{{$membershiprequest->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Membership Request ({{$membershiprequest->count()}})
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('/superadmin/customer/membership-request')}}" class="dropdown-item dropdown-footer">See All </a>
        </div>
      </li>
      <!-- membership request -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-times"></i>
          <span class="badge badge-danger navbar-badge">{{$cancelshiprequest->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Cacel Membership Request ({{$cancelshiprequest->count()}})
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('/superadmin/customer/membership-cancel')}}" class="dropdown-item dropdown-footer">See All </a>
        </div>
      </li>
      <!-- membership request -->
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-edit"></i>
          <span class="badge badge-warning navbar-badge">{{$updateadsrequest->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> Update Ads request</span>
          <div class="dropdown-divider"></div>
          <a  class="dropdown-item">
            <i class="fas fa-users mr-2"></i> {{$updateadsrequest->count()}} Ads Request
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/show/ads-update/request')}}" class="dropdown-item dropdown-footer">See All Request</a>
        </div>
      </li>
      <!--update ads request-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-ad"></i>
          <span class="badge badge-warning navbar-badge">{{$newadsrequest->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> New Ads request</span>
          <div class="dropdown-divider"></div>
          <a  class="dropdown-item">
            <i class="fas fa-users mr-2"></i> {{$newadsrequest->count()}} Ads Request
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/show/ads-new/request')}}" class="dropdown-item dropdown-footer">See All Request</a>
        </div>
      </li>
      <!--new ads request-->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('superadmin/dashboard')}}"target="_blank"  class="brand-link">
      <span class="brand-text font-weight-light">Sellquicker</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="user-image">
          <img src="{{asset(auth::user()->image)}}" class="img-circle" alt="User Image">
        </div>
        <div class="user-info">
          <a href="#" class="d-block">{{auth::user()->name}}</a>
          <i class="fas fa-circle"></i>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::user()->role_id==1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-users"></i>
              <p>
                Users
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/superadmin/user/create')}}" class="nav-link">
                 <i class="far fa-dot-circle  nav-icon"></i> 
                    <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/superadmin/user/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          @endif
          @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-ad"></i>
              <p>
                Ads Manage
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/show/ads-new/request')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>New Ads ({{$newadsrequest->count()}})</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/show/ads-update/request')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Update Ads ({{$updateadsrequest->count()}})</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/show/ads-premium/request')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Premium Request ({{$premiumadsquantity->count()}})</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/customer/show/all-ads')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>All Ads ({{$allads->count()}})</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
           @if(Auth::user()->role_id==1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-ticket-alt"></i>
              <p>
                Membership
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/membership/ads-limit/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Ads Limit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/superadmin/customer/membership-request')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Request ({{$membershiprequest->count()}})</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/superadmin/customer/membership-cancel')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Cancel ({{$cancelshiprequest->count()}})</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/superadmin/customer/all-membership')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>All Member ({{$allmembership->count()}})</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fab fa-airbnb"></i>
              <p>
                Logo
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/logo/create')}}" class="nav-link">
                 <i class="far fa-dot-circle  nav-icon"></i> 
                    <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/logo/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-align-left"></i>
              <p>
                Banner
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('editor/banner/create')}}" class="nav-link">
                 <i class="far fa-dot-circle  nav-icon"></i> 
                    <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('editor/banner/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-list-ol"></i>
              <p>
                Category
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/category/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/category/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-sliders-h"></i>
              <p>
                Sub Category
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/subcategory/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/subcategory/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-layer-group"></i>
              <p>
                Division
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/division/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/division/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-map-marker-alt"></i>
              <p>
               District
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/district/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/district/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-map-marker-alt"></i>
              <p>
               Thana
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/thana/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/thana/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-map-marker-alt"></i>
              <p>
               Union/City Corporation
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/union/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/union/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fas fa-tv"></i>
              <p>
                Create Page
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/pagecategory/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Page Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/createpage/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Page Content</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fas fa-pen"></i>
              <p>
                Notice
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/news/create')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/news/manage')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-user-friends"></i>
              <p>
                Customer
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/customer/list')}}" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Customer List </p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fas fa-comments"></i>
              <p>
                Ad Report
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/ad/reports/')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ad Report List </p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy;<a href="{{url('/')}}">Hatbodol</a></strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
             <i class="fas fa-sign-out-alt"></i>
              <p>Logout</p>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
            </a>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="{{url('password/change')}}" class="nav-link">
             <i class="fas fa-key"></i>
              <p>Change Password</p>
            </a>
          </li>
          <!-- nav item end -->
      </ul>
    </nav>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('public/backEnd/')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backEnd/')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{asset('public/backEnd/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('public/backEnd/')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public/backEnd/')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('public/backEnd/')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('public/backEnd/')}}/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backEnd/')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backEnd/')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('public/backEnd/')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backEnd/')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('public/backEnd/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backEnd/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="{{asset('public/backEnd/')}}/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backEnd/')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backEnd/')}}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backEnd/')}}/plugins/datatables/jquery.dataTables.js"></script>
  <!-- DataTables -->
<script src="{{asset('public/backEnd/')}}/plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- flatpicker -->
<script>
      $(function () {
       flatpickr("#flatpicker", {
        minDate:"today",
       });
      })
  </script>
<script src="{{asset('public/backEnd/')}}/plugins/select2/js/select2.full.min.js"></script>
<!-- Select2 -->
<script src="{{asset('public/backEnd/')}}/dist/js/toastr.min.js"></script>
<!-- Toastr -->
{!! Toastr::message() !!}
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });

  })
</script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote()
  })
</script>
</body>

</html>
