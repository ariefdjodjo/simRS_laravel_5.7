@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Pencarian Dokumen</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pencarian Dokumen</li>
  </ol>

@stop

@section('content')
  @if ($cari == "")
      <div class="box box-primary" style="padding:10px">
        <h2>Data surat Nomor : {{$nomor}} tahun {{$tahun}} tidak ditemukan</h2>
        <p>Perhatikan penulisan huruf besar dan kecil sesuai penomoran</p>
        <hr>
        <a href="{{URL::to('pencarian/usulan/0')}}" class="btn btn-primary"><i class="fa fa-search"></i> Cari Lagi</a>
      </div>
  @else
 
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
            <li class="time-label">
                  <span class="bg-red">
                    Surat Usulan User
                  </span>
            </li>

            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($cari->tgl_usulan)}}</span>

                <h3 class="timeline-header">Surat Usulan dikirimkan</h3>

                <div class="timeline-body">
                  <dl class="dl-horizontal">
                    <dt>Unit Kerja</dt>
                    <dd>{{$cari->unitKerja->nama_unit_kerja}}</dd>

                    <dt>Jenis Usulan</dt>
                    <dd>{{getJenis($cari->jenis_usulan)}}</dd>

                    <dt>Nomor Usulan</dt>
                    <dd>{{$cari->no_usulan}}</dd>

                    <dt>Tanggal Usulan</dt>
                    <dd>{{getTfi($cari->tgl_usulan)}}</dd>

                    <dt>Perihal Usulan</dt>
                    <dd>{{$cari->perihal_usulan}}</dd>

                    <dt>RAB Usulan</dt>
                    <dd>{{getNumber($barang->jumUsulan)}}</dd>
                  </dl>
                  
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-send bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($cari->tgl_kirim)}}</span>

                <h3 class="timeline-header no-border"><b>{{$cari->pengirim->nama_kepala}}</b> menyetujui dan mengirimkan usulan</h3>
              </div>
            </li>
            <!-- END timeline item -->

            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($cari->dibaca)}}</span>
                <h3 class="timeline-header">Telah Dibaca</h3>
              </div>
            </li>
            <!-- END timeline item -->
          @if($telaah != "")
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-orange">
                    Telaah Kegiatan
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-file-o bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($telaah->tgl_telaah)}}</span>

                <h3 class="timeline-header">Draft Telaah</h3>

                <div class="timeline-body">
                  <dl class="dl-horizontal">
                    <dt>Nomor Telaah</dt>
                    <dd>{{$telaah->no_telaah}}</dd>

                    <dt>Tanggal Telaah</dt>
                    <dd>{{getTfi($telaah->tgl_telaah)}}</dd>

                    <dt>Perihal Telaah</dt>
                    <dd>Telaah {{$cari->perihal_usulan}}</dd>

                    <dt>Urgensi</dt>
                    <dd>{{getUrgensi($telaah->urgency)}}</dd>
                  </dl>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            @if($barang->harga > 0)
            <!-- timeline item -->
            <li>
              <i class="fa fa-dollar bg-maroon"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($telaah->tgl_telaah)}}</span>

                <h3 class="timeline-header"><b>Proses Analisis Harga</b> sedang dilakukan</h3>

                <div class="timeline-body">
                  Proses analisis harga sedang berlangsung.
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            @if($barang->qty >0)
            <!-- timeline item -->
            <li>
              <i class="fa fa-cart-plus bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($telaah->tgl_telaah)}}</span>

                <h3 class="timeline-header"><b>Proses Analisis Kebutuhan</b> sedang dilakukan</h3>

                <div class="timeline-body">
                  Proses analisis kebutuhan sedang berlangsung.
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            @if($telaah->tgl_kirim == NULL)

            <!-- timeline item -->
            <li>
              <i class="fa fa-cart-plus bg-red"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($telaah->tgl_telaah)}}</span>

                <h3 class="timeline-header"><b>Penandatanganan Dokumen</b></h3>

                <div class="timeline-body">
                  Dokumen sedang di koreksi dan ditandatangani oleh pejabat yang berwenang.
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            @else 

            <!-- timeline item -->
            <li>
              <i class="fa fa-send bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($telaah->tgl_kirim)}}</span>

                <h3 class="timeline-header"><b>Dokumen dikirimkan</b></h3>
              </div>
            </li>
            <!-- END timeline item -->
          
          @if ($sp != "")
              
            <!-- timeline time label -->
            <li class="time-label">
              <span class="bg-green">
                Surat Persetujuan Pengadaan (SPP)
              </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-money bg-purple"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($sp->created_at)}}</span>

            <h3 class="timeline-header"><b>Draft Dokumen SPP</b></h3>

            <div class="timeline-body">
              <dl class="dl-horizontal">
                <dt>Nomor</dt>
                <dd>{{$sp->no_sp}}</dd>

                <dt>Tanggal</dt>
                <dd>{{getTfi($sp->tgl_sp)}}</dd>

                <dt>Perihal</dt>
                <dd>{{$sp->hal_sp}}</dd>

                <dt>SD / Sub Alokasi</dt>
                <dd>{{$sp->sA->akun->sumber_dana}} - {{$sp->sA->uraian_sub_alokasi}}</dd>

                <dt>Kode MA</dt>
                <dd>{{getMA($sp->sA->id_sub_alokasi)}}</dd>
              </dl>
            </div>
          </div>
        </li>
        <!-- END timeline item -->
        @if ($sp->barangSp != "")

        <!-- timeline item -->
        <li>
          <i class="fa fa-file-o bg-maroon"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($sp->created_at)}}</span>
            <h3 class="timeline-header"><b>Proses Persetujuan di Direktur Keuangan</b></h3>
          </div>
        </li>
        
        @if ($sp->status_sp == "Aktif" || $sp->status_sp == "Batal")

        <!-- timeline item -->
        <li>
          <i class="fa fa-send-o bg-green"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($sp->tgl_kirim_sp)}}</span>
            <h3 class="timeline-header"><b>Dokumen dikirimkan</b> ke {{$sp->sA->ppk->jabatan_ppk}}</h3>
          </div>
        </li>
        
        @if ($sp->status_sp == "Batal")

        <!-- timeline item -->
        <li>
          <i class="fa fa-times bg-red"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{getTfi($sp->updated_at)}}</span>
            <h3 class="timeline-header"><b>SPP Batal</b></h3>
            <div class="timeline-body">
              <?php echo $sp->catatan_sp; ?>
            </div>
          </div>
          
        </li>
               
        @endif

        @endif
        @endif
        @endif
        @endif
            @endif
          @endif
        @endif
        

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @endif
      @stop

      @section('script')    
          
      @endsection

