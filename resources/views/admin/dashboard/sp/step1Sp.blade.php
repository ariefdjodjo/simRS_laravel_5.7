
    

@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Tambah Surat Persetujuan Anggaran (SP)</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Tambah SP</li>
  </ol>
@stop

@section('content')
    {{-- @if ($sp->status_sp == "Aktif")
        <h2>Forbidden Access</h2>
    @else --}}

    <div class="box box-primary">
        <div class="box-header">
            <ul id="progressbar" class="progressbar">
                <li class="active" style="width: 20%;">Pilih Tahun Anggaran</li>
                <li class="" style="width: 20%;">Data SP Anggaran</li>
                <li class="" style="width: 20%;">Data Item Barang</li>
                <li class="" style="width: 20%;">Cetak dan Kirim</li>
                <li style="width: 20%;">Selesai</li>          
            </ul>
        </div>
        <hr>
        <div class="box-body">
            <form action="{{url('spp/pilihTahun')}}" method="POST" class="form-horizontal" name="formTelaah" id="formTelaah">
                @csrf
                <div class="form-group">
                    <label class="col-md-4 control-label" style="text-align:right" for="tahun">Pilih Tahun Anggaran</label>
                    <div class="col-md-8">
                        <select id="tahun" name="tahun" class="form-control" required>
                            <option value="">-- Pilih Tahun Anggaran --</option>
                        @foreach ($tahun as $data)
                            <option value="{{$data->tahun}}">{{$data->tahun}}</option>
                        @endforeach
                        </select>
        
                        <script>
                            $('#tahun').selectize({
                            create: false,
                            sortField: 'text'
                            });
                        </script>
        
                    </div>
                </div>
        </div>
        <hr>
        <div class="bg-orange color-palette">
            <div class="col-md-6"></div>
            <div class="col-md-6"><button type="submit" class="btn btn-sm btn-success">Lantjut</button></div>
        </div>
        </form>
    </div>
    {{-- @endif --}}
@endsection

