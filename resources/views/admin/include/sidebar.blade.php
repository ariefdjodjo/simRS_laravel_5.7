      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar skin-green">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{url::to('img/sardjito.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Administrator</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION ADMINISTRATOR</li>
            
            
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Unit Kerja</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('unitKerja/create')}}}"><i class="fa fa-plus"></i> Tambah Unit Kerja</a></li>                
                <li><a href="{{{URL::to('unitKerja/data')}}}"><i class="fa fa-building-o"></i> Data Unit Kerja</a></li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>User</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('user/register')}}}"><i class="fa fa-user-plus"></i> Tambah User</a></li>                
                <li><a href="{{{URL::to('user/data')}}}"><i class="fa fa-user"></i> Data User</a></li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-bars"></i>
                <span>Referensi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">           
                <li><a href="{{{URL::to('mstPpk/')}}}"><i class="fa fa-user"></i> Master PPK</a></li>
              </ul>
            </li>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Modal -->
      <div class="modal fade" id="myModalq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabelq">Modal title</h4>
            </div>
            <div class="modal-bodyq">
              ...
            </div>
            <div class="modal-footerq">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end of modal -->
