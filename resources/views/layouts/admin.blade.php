<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="{{ asset('admin_assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin_assets/js/loader.js')}}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js')}}"></script>


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/datatable/datatables.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/datatable/dt-global_style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/dropzone/dropzone.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/toastr/toastr.min.css')}}">
        <link href="{{ asset('admin_assets/css/switches.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('admin_assets/fontawesome/js/all.js')}}"></script>

    <script src="{{ asset('admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin_assets/js/ajax.js') }}"></script>
    <script language="javascript" src="{{ asset('admin_assets/plugins/Print/print.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery-3.1.1.min.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('admin_assets/validation/css/screen.css') }}">
        <script src="{{ asset('admin_assets/validation/dist/jquery.validate.js') }}"></script>
        <script src="{{ asset('admin_assets/validation/dist/additional-methods.min.js') }}"></script>
    <!-- END PAGE LEVEL STYLES -->



  <script type="text/javascript">
		function printthis(class_name = '')
		{
			 var w = window.open('', '', 'width=1200,height=600,resizeable,scrollbars');
       if(class_name == ''){
        w.document.write($("#printthis").html());
       }else{
        w.document.write($("#"+class_name).html());
       }

			 w.document.close(); // needed for chrome and safari
			 javascript:w.print();
			 w.close();
			 return false;
		}
	</script>

<script>
var my_url = '{{url('/')}}/admin_assets/';
</script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px)!important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
<!-- BEGIN LOADER -->
  <div id="load_screen"> <div class="loader"> <div class="loader-content">
      <div class="spinner-grow align-self-center"></div>
  </div></div></div>
<!--  END LOADER -->


    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="index.html">
                        <img src="{{ asset('admin_assets/img/90x90.jpg')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="index.html" class="nav-link"> {{ config('app.name', 'Laravel') }} </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link text-white">   <?php echo Auth::user()->name;?> - <span class="text-info"><?php echo RoleName(Auth::user()->role);?></span></a>
                </li>
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="{{ asset('admin_assets/img/90x90.jpg')}}" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="{{ route('admin.profile', Auth::user()->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile</a>
                            </div>
                            <div class="dropdown-item">
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                               </form>
                                <a href="javascript:void(0);" class=""
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                  Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
      <div class="sub-header-container">
          <header class="header navbar navbar-expand-sm">
              <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
                @yield('page_header')
          </header>
      </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>


        <!--  BEGIN SIDEBAR  -->
          @include('partials.menu')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
          @endif


          @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
          @endif

            @yield('content')

            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="#">{{ config('app.name', 'Laravel') }}</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">

                </div>
            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('admin_assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('admin_assets/js/custom.js')}}"></script>
    <script src="{{ asset('admin_assets/datatable/datatables.js')}}"></script>
    <script src="{{ asset('admin_assets/dropzone/dropzone.min.js')}}"></script>
    <script src="{{ asset('admin_assets/toastr/toastr.min.js')}}"></script>
    <script>
        $('#example').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });


toastr.options = {
		closeButton: true,
		progressBar: true,
		timeOut: 2000
	};
    </script>

<script type="text/javascript">
$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
</script>
 @yield('script')

</body>
</html>
