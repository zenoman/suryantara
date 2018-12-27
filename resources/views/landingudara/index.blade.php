<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SURYANTARA</title>

    <!-- Bootstrap core CSS -->
    <link href="asset_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="asset_user/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <!--<link href="asset_user/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"> -->

    <!-- Custom styles for this template -->
    <link href="asset_user/css/freelancer.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">

        <a class="navbar-brand js-scroll-trigger" href="#page-top">SURYANTARA CARGO</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a onclick="window.history.go(-1);" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" >
              <i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{url('login')}}">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br>
<br> 
<section class="masthead bg-primary text-white text-center mb-0">
  <div class="container">
    <h1 class="text-uppercase mb-0">Tarif Udara</h1>
    <br>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kota Tujuan</th>
        <th scope="col">Biaya</th>    
      </tr>
    </thead>
    <tbody>
     <?php $i = 1;?>
      @foreach($udara as $row)
        <?php $no = $i++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->tujuan}}</td>
        <td>{{"Rp ". number_format($row->perkg,0,',','.')." /Kg"}}</td>
      </tr>
      @endforeach
    </tbody>
    <thead class="thead-light">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kota Tujuan</th>
        <th scope="col">Biaya</th>    
      </tr>
    </thead>
  </table>
  <br> 
  <a onclick="window.history.go(-1);" class="btn btn-secondary">Kembali</a>   
  </div>
</section>
<footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">2215 John Daniel Drive
              <br>Clark, MO 65243</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Around the Web</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-google-plus-g"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-linkedin-in"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-dribbble"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">About Freelancer</h4>
            <p class="lead mb-0">Freelance is a free to use, open source Bootstrap theme created by
              <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
          </div>
        </div>
      </div>
    </footer>
 
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>&copy; Suryantara Cargo 2018 by Joyoboyo Intermedia</small>
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

  </body>

</html>

