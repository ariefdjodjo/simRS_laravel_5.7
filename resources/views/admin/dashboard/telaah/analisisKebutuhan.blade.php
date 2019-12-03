@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/telaah/tambahTelaah/')}}"><i class="fa fa-file"></i> Tambah Telaah</a></li>
            <li class="active">Analisis Harga</li>
          </ol>
@stop
@section('content')
    <div class="box box-success box-border">
        <div class="box-header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="btn-group span-6">
                            <a href="{{url::to('telaah/tambahTelaah/'.$id.'/detailTelaah')}}" class="btn btn-success" ><i class="fa fa-file-o"></i> Data Telaah</a>

                            @if($harga == 0)
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisHarga/proses')}}" class="btn btn-success"><i class="fa fa-refresh"></i> Analisis Harga</a>
                            @else 
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisHarga')}}" class="btn btn-success"><i class="fa fa-refresh"></i> Analisis Harga</a>
                            @endif

                            @if ($qty == 0)
                                <button target="{{url::to('telaah/tambahTelaah/'.$id.'/analisisKebutuhan')}}" class="btn btn-warning" disabled><i class="fa fa-check-square-o"></i> Analisis Kebutuhan</button>
                            @else 
                                <button target="{{url::to('telaah/tambahTelaah/'.$id.'/analisisKebutuhan')}}" class="btn btn-success" disabled><i class="fa fa-check-square-o"></i> Analisis Kebutuhan</button>
                            @endif

                            @if($harga == 0 || $qty == 0)
                                
                            @else 
                                <a href="{{url::to('telaah/kirim/'.$id)}}" class="btn btn-primary"><i class="fa fa-check"></i> Kirim</a>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="box-body">
            
                    <table class="table table-bordered" id="tbl_barang" style="">
                        <thead>
                            <tr style="text-align:center">
                                <td><b>No</b></td>
                                <td><b>Nama Barang</b></td>
                                <td><b>Satuan</b></td>
                                <td><b>Harga Perkiraan</b></td>
                                <td><b>Usulan Qty</b></td>
                                <td><b>Disetujui</b></td>
                                <td><b>Jumlah Kebutuhan RAB</b></td>
                                <td><b>#</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $urut = 1;
                                $jumlah = 0;
                                $total = 0;    
                            ?>
                            @foreach ($barang as $item)
                            <?php 
                                $total+=$item->jumlah_harga_telaah;
                            ?>
                            <tr>
                                <td>{{$urut++}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->satuan}}</td>
                                <td style="text-align:right">{{getNumber($item->harga_telaah)}}</td>
                                <td style="text-align:right">{{getNumber($item->qty_usulan)}}</td>
                                <td style="text-align:right">{{getNumber($item->qty_telaah)}}</td>
                                <td style="text-align:right">{{getNumber($item->jumlah_harga_telaah)}}</td>
                                <td>
                                    <a href="#edit{{$item->id_barang_usulan}}" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

<!-- modal -->
<div class="modal modal-default fade" id="edit{{$item->id_barang_usulan}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4>Ubah Perkiraan Harga</h4>
                
            </div>
            <div class="modal-body">
                    <div class="box-body">
                    <form  role="form" method="POST" action="{{ url('telaah/analisisKebutuhanProses/') }}">
                        @csrf
                        <table class="table" width="100%">
                            <tr>
                                <td width="30%"><b>Rencana Keb. 1 Tahun</b></td>
                                <td width="70%">
                                    <input type="text" value="{{$item->kebutuhan}}" class="form-control" disabled>
                                    <input type="hidden" name="id_barang" id="id_barang" value="{{$item->id_barang_usulan}}">
                                    <input type="hidden" name="harga" id="harga" value="{{$item->harga_telaah}}">
                                    <small class="help-block"></small>
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Usulan</td>
                                <td><input type="text" value="{{$item->qty_usulan}}" class="form-control" disabled></td>
                            </tr>
                            <tr>
                                <td>Qty Disetujui</td>
                                <td>
                                    <input id="qty_telaah" type="text" class="form-control" name="qty_telaah" value="{{$item->qty_telaah}}" required autofocus placeholder="Barang Disetujui">
                                </td>
                            </tr>

                            <tr>
                                <td>Catatan Kebutuhan</td>
                                <td>
                                    
                                    <input id="catatan_kebutuhan" type="text" class="form-control" name="catatan_kebutuhan" value="{{$item->catatan_kebutuhan}}" required autofocus placeholder="Catatan">
                                    
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </td>
                            </tr>
                        </table>
                
                        <div class="form-group row mb-0">
                            <label for="username" class="col-md-4 col-form-label"></label>
                            <div class="col-md-6 offset-md-4">
                        
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
                                  
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>

                        <tfoot>
                            <th colspan="6">TOTAL</th>
                            <th style="text-align:right">{{getNumber($total)}}</th>
                            <th></th>
                        </tfoot>
                    </table>
        </div>
    </div>

    
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



@endsection

@section('script')

    <script>
      $(function () {

        $('#tbl_barang').DataTable({"pageLength": 10});

      });

    </script>

<script>
          $('[data-toggle="popover"]').popover();
      </script>

@endsection