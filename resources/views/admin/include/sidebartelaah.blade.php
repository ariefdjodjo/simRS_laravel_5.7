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
              <p>TELAAH</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION TELAAH</li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Usulan Unit Kerja</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('telaah/usulanMasuk/0/0')}}}"><i class="fa fa-folder"></i> Usulan Unit Kerja</a></li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Telaah</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('telaah/draftTelaah/0')}}}"><i class="fa fa-bar-chart"></i> Draft Telaah</a></li>
                <li><a href="{{{URL::to('telaah/daftarTelaah/0')}}}"><i class="fa fa-list"></i> Daftar Telaah</a></li>
                <li><a href="{{{URL::to('telaah/rekapUsulan/0')}}}"><i class="fa fa-folder-open-o"></i> Laporan</a></li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-bars"></i>
                <span>Referensi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('masterBarang/')}}}"><i class="fa fa-tasks"></i> Master Barang</a></li>
                <li><a href="{{{URL::to('standarBiaya/0')}}}"><i class="fa fa-tasks"></i> Standart Biaya</a></li>                    
                <li><a href="{{{URL::to('ttdTelaah/')}}}"><i class="fa fa-pencil"></i> Tanda Tangan</a></li>
                <li><a href="{{{URL::to('email/')}}}"><i class="fa fa-envelope"></i> Alamat E-mail</a></li>
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
