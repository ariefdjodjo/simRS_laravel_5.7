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
  <div class="box box-primary box-solid">
    <div class="box-header">
        <i class="fa fa-search fa-6x"></i> <b>PENCARIAN</b>
    </div>
    <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ url('pencarian/proses/') }}">
            @csrf
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                <div class="col-sm-3">
                    <select name="tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahun as $th)
                            <option value="{{$th->tahun}}">{{$th->tahun}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <script>
                $('#tahun').selectize({
                create: false,
                sortField: 'text'
                });
            
                // $(document).ready(function(){
                //     var id = $('#tahun').val();
                //     $("#tahun").change(function() {
                //         $.get("{{URL::to('/loadNomor/')}}"+id, function(data) {
                //             //console.log(data);            
                //             var temp = [];
            
                //     //CONVERT INTO ARRAY
                //             $.each(data, function(key, value) {
                //                 temp.push({v:value, k: key});
                //             });
            
                //     //SORT THE ARRAY
                //             temp.sort(function(a,b){
                //                 if(a.v > b.v){ return 1}
                //                 if(a.v < b.v){ return -1}
                //                 return 0;
                //             });
            
                //     //APPEND INTO SELECT BOX
                //             $('#no_usulan').empty();
                //             $('#no_usulan').append('<option>Select State/Province</option>');
                //             $.each(temp, function(key, obj) {
                //                 $('#no_usulan').append('<option value="' + obj.k +'">' + obj.v + '</option>');
                //             });
            
                //         });                
                //     }); 
                // });
            
            
            </script>
            <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">No. Usulan</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="nomor" id="nomor" required>
            </div>
            </div>
            <hr>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
            </div>
            </div>
          </form>

    </div>
  </div>
@stop

@section('script')    
    <script>
      $(function () {
        $('#draftUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection