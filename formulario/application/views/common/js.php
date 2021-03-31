<?php $this->load->view('common/footer'); ?>

<script src="<?=base_url()?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?=base_url()?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?=base_url()?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?=base_url()?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?=base_url()?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="<?=base_url()?>assets/js/argon.min9f1e.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="<?=base_url()?>assets/js/demo.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.loadingModal.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-tagsinput.js"></script>
<script src="<?=base_url()?>assets/js/jquery.rut.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap-select.js"></script>

<script>
  function cargando(){
    $('body').loadingModal({
      position: 'auto',
      text: 'Cargando',
      color: '#fff',
      opacity: '0.7',
      backgroundColor: 'rgb(0,0,0)',
      animation: 'doubleBounce'
    });
  }

  function stopCargando(){
    $('body').loadingModal('hide');
  }
  function notify(mensaje,tipo){

    switch (tipo) {
      case 1:
      $.notify({

        message: '<h3 class="text-white"><i class="fas fa-check mr-3"></i>'+mensaje+'</h3>'
      },{
        delay: 5000,
        timer: 1000,
        type: 'success',
        animate: {
          enter: 'animated fadeInDown',
          exit: 'animated fadeOutUp'
        },
      });

      break;
      case 2:
      $.notify({
        message: '<h3 class="text-white"><i class="fas fa-times mr-3"></i>'+mensaje+'</h3>'
      },{
        delay: 5000,
        timer: 1000,
        type: 'danger',
        animate: {
          enter: 'animated fadeInDown',
          exit: 'animated fadeOutUp'
        },
      });

      break;

      default:
      break;
    }

  }
  function coincide_clave() {
    if ($("input[name='n_contrasena']").val() != $("input[name='z_contrasena']").val()) {
      $("#submit_cambio_contrasena").attr("disabled", "ds");
      $(".error_contrasena").text("Las contraseñas no coinciden");
    }else{
      $("#submit_cambio_contrasena").removeAttr("disabled");
      $(".error_contrasena").text("");
    }
  }
  $(document).ready(function(){
    $("body").on("blur", ".nueva_c", function(){
      coincide_clave();
    })
  })
</script>



