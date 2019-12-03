<table width="100%">
    <tr>
        <td>
            
            <div class="col-md-6">
                <div class="box box-info collapsed-box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-book"> </i>
                        <h3 class="box-title"><b> USULAN</b></h3>
                        <div class="box-tools pull-right">
                            <button data-original-title="Collapse" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Nomor Usulan</dt>
                            <dd>{{$telaah->no_usulan}}</dd>
                            
                            <dt>Tanggal Usulan</dt>
                            <dd>{{$telaah->tgl_usulan}}</dd>
                            
                            <dt>Perihal Usulan</dt>
                            <dd>{{$telaah->perihal_usulan}}</dd>
                            
                            <dt>Unit Kerja</dt>
                            <dd><?php echo $telaah->nama_unit_kerja; ?></dd>
                
                            <dt>RAB Usulan</dt>
                            <dd>Rp {{getNumber($telaah->total_usulan)}}</dd>
                        </dl>
                    </div>
                </div>
                    
            </div>

            <div class="col-md-6">
                <div class="box box-info collapsed-box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-book"> </i>
                        <h3 class="box-title" style="color:white"><b> TELAAH</b></h3>
                        <div class="box-tools pull-right">
                            <button data-original-title="Collapse" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Nomor Telaah</dt>
                            <dd>{{$telaah->no_telaah}}</dd>
                            
                            <dt>Tanggal Telaah</dt>
                            <dd>{{$telaah->tgl_telaah}}</dd>
                            
                            <dt>Perihal Telaah</dt>
                            <dd>Telaah {{$telaah->perihal_usulan}}</dd>
                            
                            <dt>Analisis Telaah</dt>
                            <dd><?php echo $telaah->analisis_kebutuhan; ?></dd>
                
                            <dt>Alasan</dt>
                            <dd><?php echo $telaah->alasan_kebutuhan; ?></dd>
                
                            <dt>Urgensi</dt>
                            <dd>{{$telaah->urgency}}</dd>
                
                            <dt>RAB Telaah</dt>
                            <dd>Rp {{getNumber($telaah->total_telaah)}}</dd>
                        </dl>
                    </div>
                </div>
                
            </div>
        </td>
    </tr>
</table>
