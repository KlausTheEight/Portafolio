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

<body class="g-sidenav-show g-sidenav-pinned bg-dark">


  <!-- Main content -->
  <div class="main-content">
    <div class="container mt-3 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5 text-center">
              <img src="<?=base_url()?>assets/img/logo.png" width="200" class="mb-3">
              <div class="text-center text-muted mb-4">
                <small>Iniciar sesión</small>
              </div>
              <form role="form" method="post" action="<?=base_url()?>auth/login">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" required>
                  </div>
                </div>
                <div class="form-group text-left">
                  <div class="alert alert-info bg-gradient-info" role="alert">
                    <strong>Atención!</strong> Este sistema ha sido diseñado para trabajar solo con los navegadores
                     <strong>Google Chrome, Opera y Mozilla Firefox.</strong> Si estás utilizando <strong>Internet Explorer</strong> algunas funcionalidades
                     podrían presentar anomalías.
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">Iniciar Sesión</button>
                  <br>
                  <small>Desarrollado con <i class="fas fa-heart text-danger"></i> por el Equipo de Proyectos de Peñalolén</small>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">

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
  <script>
      window.onload = function() {
        var getBrowserInfo = function() {
            var ua= navigator.userAgent, tem,
            M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if(/trident/i.test(M[1])){
                tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];

                return 'IE';
            }
            if(M[1]=== 'Chrome'){
                tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
                if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
            }
            M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
            if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
            return M.join(' ');
        };

        if (getBrowserInfo()=='IE') {
          alert('Estás utilizando INTERNET EXPLORER, este navegador no es compatible con el sistema de solicitudes, debes utilizar Google Chrome, Opera o Mozilla Firefox. Si no sabes como instalar uno de estos navegadores debes enviar un ticket SOS o comunicarte con el área de soporte para ser asistida/o');
        }

        };


  </script>
</body>
</html>