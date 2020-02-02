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
              <p>Unit SPP</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION SPP</li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-bell"></i>
                <span>Surat Masuk</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('spp/usulan/0')}}}"><i class="fa fa-envelope"></i> Surat Usulan</a></li>   
                <li><a href="{{{URL::to('spp/telaah/0')}}}"><i class="fa fa-envelope-o"></i> Surat Telaah</a></li>    
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-bell"></i>
                <span>SPP Anggaran</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('spp/tambah/step1/0')}}}"><i class="fa fa-plus"></i> Tambah SPP</a></li>   
                <li><a href="{{{URL::to('spp/data/0')}}}"><i class="fa fa-tags"></i> Data SPP</a></li>
                <li><a href="{{{URL::to('spp/laporan/0')}}}"><i class="fa fa-file"></i> Laporan SPP</a></li>    
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-list-alt"></i>
                <span>RKAKL</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('klasifikasi/')}}}"><i class="fa fa-list"></i> Klasifikasi Anggaran</a></li>   
                <li><a href="{{{URL::to('akun/0')}}}"><i class="fa fa-tasks"></i> Master Akun</a></li>   
                <li><a href="{{{URL::to('pagu/0')}}}"><i class="fa fa-tasks"></i> Data Pagu Alokasi</a></li>               
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-bars"></i>
                <span>Referensi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu collapse">
                <li><a href="{{{URL::to('ttdSp/')}}}"><i class="fa fa-pencil"></i> Penandatangan SPP</a></li> 
                <li><a href="{{{URL::to('email/')}}}"><i class="fa fa-envelope"></i> Alamat E-mail</a></li>                
              </ul>
            </li>
        </section>
        <!-- /.sidebar -->
      </aside>

