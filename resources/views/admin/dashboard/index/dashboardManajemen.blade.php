  <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$usulan}}</h3>

            <p>Surat Usulan</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
          <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>55</h3>

            <p>Surat Telaah</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-text-o"></i>
          </div>
          <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>44 <sup style="font-size:20px">Dokumen</sup></h3>

            <p>SPP</p>
          </div>
          <div class="icon">
            <i class="fa fa-tags"></i>
          </div>
          <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="align:center">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img src="{{URL::asset('img/gedung_sardjito.jpg')}}" alt="First slide">

              <div class="carousel-caption">
               <h3>Gedung Rawat Jalan RSUP Dr. Sardjito</h3> 
              </div>
            </div>
            <div class="item">
              <img src="{{URL::asset('img/mbah_jito.jpg')}}" alt="Second slide">

              <div class="carousel-caption">
                <h3>Instalasi Rawat Jalan RSUP Dr. Sardjito</h3> 
              </div>
            </div>
            <div class="item">
              <img src="{{URL::asset('img/perawat_amarta.jpg')}}" alt="Third slide">

              <div class="carousel-caption">
                <h3>Layanan VIP Paviliun Amarta</h3>
              </div>
            </div>
            <div class="item">
                <img src="{{URL::asset('img/call_center.jpg')}}" alt="Third slide">
  
                <div class="carousel-caption">
                  <h3>Call Center RSUP Dr. Sardjito</h3>
                </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
      <!-- /.box-body -->

      <br>
