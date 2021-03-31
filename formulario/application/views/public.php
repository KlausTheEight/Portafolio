<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicon -->
  <link rel="icon" href="<?=base_url()?>assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/argon.min9f1e.css?v=1.1.0" type="text/css">

  <!-- End Google Tag Manager -->
</head>

<body class="g-sidenav-show g-sidenav-pinned bg-primary">


  <!-- Main content -->
  <div class="main-content">
    <div class="container mt-3 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-12">
            <a class="mt-3 mb-3 btn btn-success btn-sm" href="<?=base_url()?>">Volver</a>
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5 text-center">
              <img src="<?=base_url()?>assets/img/logo.png" width="200" class="mb-3">
              <div class="text-center text-muted mb-4">
                <h4>Material de ayuda</h4>
              </div>
                <div class="row">
                    <div class="col-md-12 mt-2 text-left">
                   
                        <div id="accordion">

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Ingresar y derivar solicitudes
                                    </button>
                                </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <h2>Descarga la presentación</h2>
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-download"></i> Descargar presentación</a>
                                    <br><br><br>
                                    <h2>Accede al video tutorial</h2>
                                    <div class="col-md-12">
                                        <iframe style="width:100%;height:400px" src="https://www.youtube.com/embed/yhPcWJASHAQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
             <!-- <a href="#" class="text-light"><small>Olvidaste tu password?</small></a> -->
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Core -->
  <script src="<?=base_url()?>assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=base_url()?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=base_url()?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="<?=base_url()?>assets/js/argon.min.js?v=1.1.0"></script><div class="" data-action="sidenav-unpin" data-target="undefined"></div>
  <!-- Demo JS - remove this in your project -->
  <script src="<?=base_url()?>assets/js/demo.min.js"></script>

  <?php
  $this->load->view('mensajes');
  ?>

</body>
</html>