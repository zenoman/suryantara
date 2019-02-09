<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    @foreach($des as $row)
    <title>{{$row->namaweb}}</title>
    <link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
    @endforeach

    <!-- Bootstrap core CSS -->
    <link href="asset_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="asset_user/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <!--<link href="asset_user/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"> -->

    <!-- Custom styles for this template -->
    <!-- Custom styles for this template -->
    <link href="{{asset('asset_user/css/freelancer.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
    <link href="{{asset('asset_user/css/select2user.css')}}" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">

    @foreach($des as $row)
    <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">{{$row->header}}</a>
    @endforeach
       <!--  <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a onclick="window.history.go(-1);" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" >
              <i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
            </li>
            
          </ul>
        </div> -->
      </div>
    </nav>
<br>
<br>   

    <section class="text-center mb-0">  

    <div class="container">
    <h1 class="text-uppercase text-center mb-0">Cek Tarif Darat</h1>
    <br>
    <br>
        <form method="get" action="{{url('landlaut/cari')}}">
        <div class="row">
          <div class="col-sm-2 col-sm-offset-1">
            <div class="form-group">
              <label>Kota Asal<small> :</small></label>
              <input type="text" class="form-control" name="kota_asal" value="kediri" readonly>
            </div>
          </div>
          <div class="col-sm-6 col-sm-offset-1">
            <div class="form-group">
              <label>Kota Tujuan<small> :</small></label>
              <select id="kota_tujuan" class="select2" name="tujuan">
                @foreach($tujuan as $row)
                <option>{{$row->tujuan}}</option>
                @endforeach
              </select>
              
            </div>
          </div>
        </div>
          <div class="text-right">
                <button type="submit" class="btn btn-info">Cari</button>
                <a onclick="window.history.go(-1);"><button type="button" class="btn btn-danger">Kembali</button></a>
              </div>
        </form>
        
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
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/profile.php?id=100014984589964">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/suryantaracargokediri?utm_source=ig_profile_share&igshid=i01k17uof3di">
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
    <script src="asset_user/vendor/jquery/jquery.min.js"></script>
    <script src="asset_user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="asset_user/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="asset_user/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="asset_user/js/jqBootstrapValidation.js"></script>
    <script src="asset_user/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="asset_user/js/freelancer.min.js"></script>
    <script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>

  <script type="text/javascript">
    $('#kota_tujuan').select2();
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
  </script>

<script src="{{asset('assets/js/app.js')}}"></script>

  </body>

</html>





