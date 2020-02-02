<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMRSS | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
      
     <link href="{{URL::asset('admin/bootstrap/css/bootstrap.css')}}"  rel="stylesheet"  type="text/css"> 
     <link href="{{URL::asset('admin/bootstrap/css/datepicker.css')}}"  rel="stylesheet"  type="text/css"> 
     <link href="{{URL::asset('css/docs.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{URL::asset('admin/bootstrap/css/font-awesome.min.css')}}"  rel="stylesheet"  type="text/css" >
    <!-- Ionicons -->
    <!-- <link href="{{URL::asset('admin/plugins/ionicons/css/ionicons.min.css')}}"  rel="stylesheet"  type="text/css" > -->
    
    <!-- jvectormap -->
    
    <link href="{{URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"  type="text/css" >
    <!-- Theme style -->
   
    <link href="{{URL::asset('admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet"  type="text/css" >
    <link href="{{URL::asset('admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    
    <link href="{{URL::asset('admin/dist/css/skins/_all-skins.min.css')}}"  rel="stylesheet" >
    <link href="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('img/sjt.ico') }}" rel="SHORTCUT ICON" />
    <link rel="stylesheet" type="text/css" href="{{url('css/progress.css')}}">

    <!-- selectize -->
    <script type="text/javascript" src="{{ URL::asset('selectize/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/selectize.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/validjs.js')}}"></script>
    <link href="{{URL::asset('selectize/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">
    <!-- notifikasi -->
    <link href="{{URL::asset('admin/plugins/toastr/build/toastr.min.css')}}"  rel="stylesheet"  type="text/css" >

    {{-- Tree view --}}
    <link href="{{url('treeView/dist/css/jquery.treegrid.css')}}" rel="stylesheet">

    {{-- <link href="{{url('css/progress.css')}}" rel="stylesheet" type="text/css"> --}}

    {{-- loading --}}
    <style type="text/css">
      .preloader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        /* background: #FFF; */
        /* opacity: .6; */
      }

      .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 20px arial bold;
        text-align: center;
      }
      </style>

    <!-- bikin script base_url untuk dipanggil dari javascript -->
    <meta name="base_url" content="{{ URL::to('/') }}">
  </head>
  <body class="hold-transition skin-green-light sidebar-mini">

      <div class="preloader">
          <div class="loading">
            <img src="{{url('img/loading.gif')}}" width="100%">
          </div>
        </div>

    <div class="wrapper">

      @include('admin.include.header')
      
      <?php $level = Auth::user()->level; ?>

      @if($level==1) <!-- administrator -->
        @include('admin.include.sidebar')
      @elseif($level== '2') <!-- Pengusul -->
        @include('admin.include.sidebarusulan')
      @elseif($level==3) <!-- penelaah -->
        @include('admin.include.sidebartelaah')
      @elseif($level==4) <!-- spp -->
        @include('admin.include.sidebarspp')
      @elseif($level == '5' ) <!-- manajemen -->
        @include('admin.include.sidebarmanajemen')
      @endif
      



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @yield('breadcrump')
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



      @include('admin.include.footer')
    
   <script src="{{ URL::asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>    
    <script src="{{ URL::asset('admin/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('admin/bootstrap/js/popover.js') }}"></script>
    
    
    <script src='{{ URL::asset('admin/plugins/select2/select2.full.min.js') }}'></script>
    @yield('script')
<!-- 
     <script src="{{ URL::asset('admin/bootstrap/js/modal.js') }}"></script>
    <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->
    
    
<script src="{{ URL::asset('admin/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/morris/morris.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>   
<script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/knob/jquery.knob.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('admin/bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script src="{{ URL::asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
<script src="{{ URL::asset('admin/dist/js/app.min.js') }}"></script>
<script src="{{ URL::asset('admin/dist/js/pages/dashboard.js') }}"></script> 
<script src="{{ URL::asset('admin/plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/highcharts/grafik/jquery.highchartTable-min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/select2/select2.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/toastr/build/toastr.min.js') }}"></script>

<script src="{{url('treeView/dist/js/jquery.treegrid.min.js')}}"></script>
<script src="{{url('js/bootstrap-affix.js')}}"></script>
<script src="{{url('js/bootstrap-scrollspy.js')}}"></script>

<script src="{{url('js/application.js')}}"></script>

  <script>
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "0",
        "hideDuration": "0",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

  @if(Session::has('message'))
  var typenya = "{{ Session::get('type', 'info') }}";

  switch(typenya){
        case 'info':
        toastr.info("{{Session::get('message')}}");
        break;

        case 'success':
        toastr.success("{{Session::get('message')}}");
        break;

        case 'warning':
        toastr.warning("{{Session::get('message')}}");
        break;

        case 'error':
        toastr.error("{{Session::get('message')}}");
        break;
      }
      
    @endif      
  </script>

  <script type="text/javascript">
    $(window).load(function() {
      $(".preloader").fadeOut("slow");
    });
  </script>

  </body>
</html>
