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
    <!-- Font Awesome -->
    <link href="{{URL::asset('admin/bootstrap/css/font-awesome.min.css')}}"  rel="stylesheet"  type="text/css" >
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- <link href="{{URL::asset('admin/plugins/ionicons/css/ionicons.min.css')}}"  rel="stylesheet"  type="text/css" > -->
    
    <!-- jvectormap -->
    
    <link href="{{URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"  type="text/css" >
    <!-- Theme style -->
   
    <link href="{{URL::asset('admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet"  type="text/css" >
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    
    <link href="{{URL::asset('admin/dist/css/skins/_all-skins.min.css')}}"  rel="stylesheet" >
    <link href="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('img/sjt.ico') }}" rel="SHORTCUT ICON" />
    <link href="{{URL::asset('admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">


    <!-- selectize -->
    <script type="text/javascript" src="{{ URL::asset('selectize/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/selectize.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('selectize/validjs.js')}}"></script>
    <link href="{{URL::asset('selectize/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css">
    <!-- bikin script base_url untuk dipanggil dari javascript -->
    <meta name="base_url" content="{{ URL::to('/') }}">
  </head>
  <body class="hold-transition skin-green-light sidebar-mini">
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
<script src="{{ URL::asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script src="{{ URL::asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
<script src="{{ URL::asset('admin/dist/js/app.min.js') }}"></script>
<script src="{{ URL::asset('admin/dist/js/pages/dashboard.js') }}"></script> 
<script src="{{ URL::asset('admin/plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/select2/select2.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

  </body>
</html>
