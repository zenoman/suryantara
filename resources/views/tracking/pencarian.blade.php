<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

      <style type="text/css"> 
.timeline {
    list-style: none;
    padding: 20px 0 20px;
    position: relative;
}

    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }

        .timeline > li:before,
        .timeline > li:after {
            content: " ";
            display: table;
        }

        .timeline > li:after {
            clear: both;
        }

        .timeline > li:before,
        .timeline > li:after {
            content: " ";
            display: table;
        }

        .timeline > li:after {
            clear: both;
        }

        .timeline > li > .timeline-panel {
            width: 46%;
            float: left;
            border: 1px solid #d4d4d4;
            border-radius: 2px;
            padding: 20px;
            position: relative;
            -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        }

            .timeline > li > .timeline-panel:before {
                position: absolute;
                top: 26px;
                right: -15px;
                display: inline-block;
                border-top: 15px solid transparent;
                border-left: 15px solid #ccc;
                border-right: 0 solid #ccc;
                border-bottom: 15px solid transparent;
                content: " ";
            }

            .timeline > li > .timeline-panel:after {
                position: absolute;
                top: 27px;
                right: -14px;
                display: inline-block;
                border-top: 14px solid transparent;
                border-left: 14px solid #fff;
                border-right: 0 solid #fff;
                border-bottom: 14px solid transparent;
                content: " ";
            }

        .timeline > li > .timeline-badge {
            color: #fff;
            width: 50px;
            height: 50px;
            line-height: 50px;
            font-size: 1.4em;
            text-align: center;
            position: absolute;
            top: 16px;
            left: 50%;
            margin-left: -25px;
            background-color: #999999;
            z-index: 100;
            border-top-right-radius: 50%;
            border-top-left-radius: 50%;
            border-bottom-right-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
        }

            .timeline > li.timeline-inverted > .timeline-panel:before {
                border-left-width: 0;
                border-right-width: 15px;
                left: -15px;
                right: auto;
            }

            .timeline > li.timeline-inverted > .timeline-panel:after {
                border-left-width: 0;
                border-right-width: 14px;
                left: -14px;
                right: auto;
            }

.timeline-badge.primary {
    background-color: #2e6da4 !important;
}

.timeline-badge.success {
    background-color: #3f903f !important;
}

.timeline-badge.warning {
    background-color: #f0ad4e !important;
}

.timeline-badge.danger {
    background-color: #d9534f !important;
}

.timeline-badge.info {
    background-color: #5bc0de !important;
}

.timeline-title {
    margin-top: 0;
    color: inherit;
}

.timeline-body > p,
.timeline-body > ul {
    margin-bottom: 0;
}

    .timeline-body > p + p {
        margin-top: 5px;
    }

@media (max-width: 767px) {
    ul.timeline:before {
        left: 40px;
    }

    ul.timeline > li > .timeline-panel {
        width: calc(100% - 90px);
        width: -moz-calc(100% - 90px);
        width: -webkit-calc(100% - 90px);
    }

    ul.timeline > li > .timeline-badge {
        left: 15px;
        margin-left: 0;
        top: 16px;
    }

    ul.timeline > li > .timeline-panel {
        float: right;
    }

        ul.timeline > li > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }

        ul.timeline > li > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }
}
</style>

    @foreach($des as $row)
    <title>{{$row->namaweb}}</title>
    <link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
    @endforeach

    <!-- Bootstrap core CSS -->
    <link href="{{asset('asset_user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('asset_user/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <!--<link href="asset_user/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"> -->

    <!-- Custom styles for this template -->
    <link href="{{asset('asset_user/css/freelancer.css')}}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        @foreach($des as $row)
        <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">{{$row->header}}
        </a>
        @endforeach
      </div>
    </nav>
<br>
<br> 
  <section class="text-center mb-0">
     @if($status =="ada")    
    <h1 class="text-uppercase text-center mb-0">Hasil Pencarian</h1>
    <h4>Resi : {{$kk}}</h4>
    @else
    <h1 class="text-uppercase text-center mb-0">Oops, Resi tidak ditemukan</h1>
    <h4>Resi : {{$kk}}</h4>
    @endif
    <br>
    <div class="container mt-2 mb-5">
  <div class="row">
    <div class="col-md-12 offset-md-12">
      @if($status =="ada")
      <ul class="timeline">
        <?php $i=1;?>
        @foreach($trak as $row)
        <li class="timeline-inverted">
        @if($i%2==0)
        @else
         <li>
        @endif
       
        <div class="timeline-badge bg-primary">{{$i++}}</div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title"><?php echo strtoupper($row->lokasi)?></h4>
              <p><small class="text-muted">
                <i class="fa fa-clock-o"></i> {{$row->jam}} &nbsp;&nbsp;
                <i class="fa fa-calendar"></i> {{$row->tgl}}</small>
              </p>
            </div>
            <div class="timeline-body">
              <p>{{ucwords($row->status)}}</p>
              @if($row->keterangan!='')
                <hr>
                <p>Keterangan : {{ucwords($row->keterangan)}} </p>
                @endif
            </div>
          </div>
        </li>

        @endforeach
        </ul>
        @else
        <img src="{{asset('img/kosong.png')}}" alt="" style="width: 100%">
         
        @endif
    
    </div>
  </div>
  <div>
  <a onclick="window.history.go(-1);"><button type="button" class="btn btn-danger mt-4">Kembali</button></a>
  </div>
</div>
      </section>    
<footer class="footer text-center">
      <div class="container">
        <div class="row">
          @foreach($des as $row)
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Lokasi</h4>
            <p class="lead mb-0">{{$row->alamat}}</p>
            
          </div>
          @endforeach
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">sosial media</h4>
            <ul class="list-inline mb-0">
              
             <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="_blank()" href="https://www.facebook.com/100014984589964">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="_blank()" href="https://www.instagram.com/kadirilogistikcargo">
                  <i class="fab fa-fw fa-instagram"></i>
                </a>
              </li>
              
            </ul>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">E-mail</h4>
            <ul class="list-inline mb-0">
              
              @foreach($des as $row)
              <p class="lead mb-0">{{$row->email}}</p>
              @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </footer>
 
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small><p>&copy; 2018 @foreach($des as $row)
    {{$row->header}}
    @endforeach. All Rights Reserved. <a href="#">Joyoboyo Intermedia</a></p></small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
       

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('asset_user/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('asset_user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('asset_user/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('asset_user/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>


    <!-- Custom scripts for this template -->
    <script src="{{asset('asset_user/js/freelancer.js')}}"></script>
    
  <script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/popper/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/tether/tether.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins.js')}}"></script>


<script src="{{asset('assets/js/app.js')}}"></script>

  </body>

</html>
