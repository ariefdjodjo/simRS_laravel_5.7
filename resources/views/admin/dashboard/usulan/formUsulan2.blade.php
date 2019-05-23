@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('/tambahUsulan')}}"><i class="fa fa-plus"></i> Usulan</a></li>
    <li class="active">Item Barang Usulan</li>
  </ol>
@stop

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="col-sm-6">
    <div class="box box-solid box-primary">
        <div class="box-header">
            <div class="btn-group">
                DATA USULAN
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>Tahun</dt>
                <dd>{{$usulan->tahun}}</dd>

                <dt>No. Usulan</dt>
                <dd>{{$usulan->no_usulan}}</dd>

                <dt>Tanggal Usulan</dt>
                <dd>{{getTfi($usulan->tgl_usulan)}}</dd>

                <dt>Perihal Usulan</dt>
                <dd>{{$usulan->perihal_usulan}}</dd>

                <dt>Jenis Usulan</dt>
                <dd>{{getJenis($usulan->jenis_usulan)}}</dd>

                <dt>Isi Usulan</dt>
                <dd><?php echo $usulan->isi_usulan; ?></dd>
            </dl>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="box box-solid box-success">
        <div class="box-header">
            <div class="btn-group">
                Lampiran
            </div>
        </div>
        <div class="box-body">
            <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('usulan/tambahLampiran/'.$usulan->id_usulan.'') }}">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 control-label" for="buttondropdown">Lampiran</label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <input id="buttondropdown" name="buttondropdown" class="form-control" placeholder="placeholder" type="file" required="">
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="box box-solid box-info">
        <div class="box-header">
                <h4>ITEM BARANG</h4>
                <div class="box-tools pull-right">
                    <a href="" class="btn btn-success btn-mini"><i class="fa fa-plus"></i> Tambah Barang</a>
                </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="itemBarang">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>NAMA BARANG</td>
                        <td>SPESIFIKASI</td>
                        <td>KEBUTUHAN</td>
                        <td>SATUAN</td>
                        <td>HARGA SATUAN</td>
                        <td>JUMLAH</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection