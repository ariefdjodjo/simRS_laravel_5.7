      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{url::to('img/sardjito.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>PENGUSUL</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION UNIT KERJA</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Usulan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{{URL::to('tambahUsulan/')}}}"><i class="fa fa-plus"></i> Tambah Usulan </a></li>
                <li><a href="{{{URL::to('usulan/draftUsulan/0')}}}"><i class="fa fa-file-o"></i> Draft Usulan </a></li>
                <li><a href="{{{URL::to('usulan/dataUsulan/0')}}}"><i class="fa fa-list"></i> Daftar Usulan </a></li>
              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{{URL::to('rekapUsulan/0')}}}"><i class="fa fa-copy"></i> Rekap Usulan </a></li>
                {{-- <li><a href="{{URL::to('pencarian/usulan/0')}}"><i class="fa fa-search"></i>Telusur Dokumen</a></li> --}}
              <!--  <li><a href="{{{URL::to('eksportUsulan/')}}}"><i class="fa fa-file-excel-o"></i> Eksport Data Usulan </a></li> -->
              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Referensi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{{URL::to('ttdUsulan/')}}}"><i class="fa fa-pencil"></i> Penandatangan Usulan </a></li>
              </ul>
            </li>
            
          
          </ul>
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
