<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="<?=base_url()?>manifestacion.json">
    <title>Formulario</title>
    <?php echo $form["css"] ?>
    <style>
        <?php echo $form["css_custom"] ?>
        body{
            padding-top:10px;
        }
        table, thead, tbody, tr, th, td{
            white-space: normal !important;
        }
        .body{
            position: relative !important;
        }
    </style>
    <?php
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    $esCelular = is_numeric(strpos($ua, "mobile"));
    $orientacion='';
    if ($esCelular) {
        ?>

        <style>
            @media (max-width: 800px)
            {
                .steps{
                    display:none !important;
                }
                .wizard > .content > .body {
                    width: 100% !important;
                }
                .container {
                    max-width: 100% !important;
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                }
            }

        </style>
        <?php
    }
    ?>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.steps.css">
    <?php
    if ($form["captcha_web"]!=null && $form["captcha_servidor"]!=null) {
        ?>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <?php
    }
    ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.loadingModal.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4"><?= $form["nombre"] ?></h1>
        <form id="formulario_<?php echo $form["id"] ?>">
            <div id="pasos">
                <?php echo $formulario ?>
            </div>
            <?php
            if ($form["captcha_web"]!=null && $form["captcha_servidor"]!=null) {
                ?>
                <center style="padding-top:20px;padding-bottom:20px;">
                 <div class="g-recaptcha" data-sitekey="<?=$form["captcha_web"]?>"></div>
             </center>
             <?php
         }
         ?>
     </form>
     <?php echo $boton ?>
 </div>
 <?php echo $form["js"] ?>
 <script>
    <?php echo $form["js_custom"] ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.steps.js"></script>
<script src="<?=base_url()?>assets/js/jquery.loadingModal.min.js"></script>
<script>
    <?php echo $pasos ?>
    $(".btn-enviar").click(function (e) {
        if(validar_campos()){
            enviar();
        }
    });
    function tabla_completa(este) {
        var tr_valido = true;
        $("tbody tr", este).each(function(){
            var tr = $(this);
            $("input", tr).each(function(){
                if ($(this).val() == "") {
                    tr_valido = false;
                }
            })
        })
        return tr_valido;
    }
    function validar_presupuesto(){
        var lineas_completas = 0;
        $(".tabla-presupuesto tbody tr").each(function(){
            var este = this;
            var input_llenos = true;
            console.log("TR");
            $("td input", este).each(function(){
                console.log("input "+$(this).val().trim());
                if($(this).val().trim() == ""){
                    input_llenos = false;
                }
            })
            if(input_llenos){
                lineas_completas++;
            }
            console.log("LC"+lineas_completas);
            console.log("TR");
        })

        if (lineas_completas >= 1) {
            return true;
        }else{
            return false;
        }
    }
    function validar_actividades(){
        var lineas_completas = 0;
        $(".tabla-actividades tbody tr").each(function(){
            var este = this;
            var input_llenos = true;
            if ($('td:nth-child(2) input', este).val().trim() == ""){
                input_llenos = false;
            }else if ($('td:nth-child(3) input', este).val().trim() == ""){
                input_llenos = false;
            }else if (
                $('td:nth-child(4) input', este).val().trim() == "" &&
                $('td:nth-child(5) input', este).val().trim() == "" &&
                $('td:nth-child(6) input', este).val().trim() == "" &&
                $('td:nth-child(7) input', este).val().trim() == "" &&
                $('td:nth-child(8) input', este).val().trim() == "" &&
                $('td:nth-child(9) input', este).val().trim() == ""
                ){
                input_llenos = false;
            }
            if (input_llenos) {
                lineas_completas++;
            }
        })
        if (lineas_completas >= 2) {
            return true;
        }else{
            return false;
        }
    }
    function validar_campos() {
        var valido = true;
        //return true;
        function error_input(este, mensaje) {
            if ($(este).parent().find(".descripcion-campo").length) {
                $(este).parent().find(".descripcion-campo").prepend("<p class='error-p' style='color:#FF0000;'>*"+mensaje+"</p>");
            }else{
                $(este).parent().append("<p class='error-p' style='color:#FF0000;'>"+mensaje+"</p>");
            }
            if (valido) {
                console.log(este);
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(este).offset().top-100
                }, 500);
                valido = false;
            }
        }

        $(".error-p").remove();
        $(".validar:visible").each(function(){
            var este = this;
            if (typeof $(este).attr("validaciones") == typeof undefined || $(este).attr("validaciones") == false) {
                if($(este).val() == ""){
                    error_input(este, "Debe completar este campo");
                }
            }else{
                var validaciones = $(este).attr("validaciones").split(';');
                for (var i = validaciones.length - 1; i >= 0; i--) {
                    switch(validaciones[i]){
                        case 'check':
                        if(!$(este).prop('checked')){
                            error_input(este, "Debe marcar la casilla indicada.");
                        }
                        break;
                        case 'rut':
                        $(este).val(formato_rut($(este).val()));
                        if (!validar_rut($(este).val())) {
                            error_input(este, "El rut no es válido.");
                        }
                        break;
                        case 'telefono':
                        if (!validar_telefono(este)){
                            error_input(este, "El teléfono debe tener 9 dígitos.");
                        }
                        break;
                        case 'email':
                        if (!validar_email(este)){
                            error_input(este, "El email no es válido.");
                        }
                        break;
                        case 'vacio':
                        if($(este).val() == ""){
                            error_input(este, "Debe completar este campo");
                        }
                        break;
                        case 'tabla-resumen':
                        if(validar_presupuesto()){
                        }else{
                            error_input($("#input100"), "Debe completar datos en al menos uno de los puntos 6.1, 6.2 o 6.3");
                        }
                        break;
                        case 'tabla-actividades':
                        if(validar_actividades()){
                        }else{
                            error_input($(".tabla-actividades"), "Debe completar al menos 2 líneas");
                        }
                        break;
                        case 'tabla-completa':
                        if(tabla_completa(este)){
                        }else{
                            error_input(este, "Debe completar todos los casilleros de la tabla.");
                        }
                        break;
                        case 'tabla':
                        /*var minimo = parseInt($(este).attr("minimo"));
                        var fila = 0;
                        $("tbody tr", este).each(function(){
                            var tr = $(this);
                            var tr_valido = true;
                            $("input", tr).each(function(){
                                if ($(this).val() == "") {
                                    tr_valido = false;
                                    return false;
                                }
                            })
                            if (tr_valido == false && fila < minimo) {
                                if($("tr", este).length == minimo){
                                    error_input(este, "Debe completar todas las filas");
                                }else{
                                    error_input(este, "Debe completar al menos "+minimo+" filas");
                                }

                                return false;
                            }
                        })*/
                        break;
                        default:
                        break;
                    }
                }
            }
        })
        return valido;
    }

    function cargando(){
        $('body').loadingModal({
            position: 'auto',
            text: 'Enviando datos, espere porfavor',
            color: '#fff',
            opacity: '0.7',
            backgroundColor: 'rgb(0,0,0)',
            animation: 'doubleBounce'
        });
    }

    function stopCargando(){
        $('body').loadingModal('destroy');
    }

    function enviar() {
        var data = new FormData($('#formulario_<?php echo $form["id"] ?>')[0]);
        var url = "<?php echo base_url() ?>publico/guardar/<?php echo sha1($form["id"]) ?>";
        cargando();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            contentType: false,
            processData: false,
        }).done(function(x) {
            stopCargando();
            var obj = JSON.parse(x);
            console.log(obj["mensaje"]);
            if (obj["codigo"] == 1) {
                Swal.fire({
                    icon: 'success',
                    text: obj["mensaje"],
                    didClose: () => {
                        window.location.replace("<?php echo $redireccion ?>");
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    html: obj["mensaje"],
                });
                $("#enviar").html("Volver a enviar.");
                $("#enviar").removeAttr("disabled");
            }
        }).fail(function() {
            stopCargando();
        }).always(function() {
            stopCargando();
        });
    }

    function formato_rut(rut)
    {
        var rut = rut.split('.').join("").split('-').join("").split(" ").join("") ;
        var contador = 0;
        var rut_f = "";
        for (var i = rut.length - 1; i >= 0; i--)
        {
            switch(contador)
            {
                case 0:
                rut_f = "-"+rut[i];
                break;
                case 3:
                case 6:
                rut_f =  ""+rut[i] + rut_f;
                break;
                default:
                rut_f = rut[i] + rut_f;
                break;
            }
            contador++;
        }
        return rut_f.toUpperCase();
    }

    function calcular_dv(rut) {
      const cuerpo = `${rut}`;
      let suma = 0;
      let multiplo = 2;
      for (let i = 1; i <= cuerpo.length; i++) {
        const index = multiplo * cuerpo.charAt(cuerpo.length - i);
        suma += index;
        if (multiplo < 7) {
          multiplo += 1;
      } else {
          multiplo = 2;
      }
  }
  // Calcular DÃ­gito Verificador en base al MÃ³dulo 11
  const dvEsperado = 11 - (suma % 11);
  if (dvEsperado === 10) return "k";
  if (dvEsperado === 11) return "0";
  return `${dvEsperado}`;
}

function validar_rut(rut){
    if (!rut || rut.trim().length < 3) return false;
    const rutLimpio = rut.replace(/[^0-9kK-]/g, "");

    if (rutLimpio.length < 3) return false;

    const split = rutLimpio.split("-");
    if (split.length !== 2) return false;

    const num = parseInt(split[0], 10);
    const dgv = split[1];

    const dvCalc = calcular_dv(num);
    return dvCalc.toLowerCase() === dgv.toLowerCase();
}
function validar_email(este) {
    $(este).val(reemplazarAcentos($(este).val()));
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String($(este).val()).toLowerCase());
}
function validar_telefono(este) {
    console.log($(este).val());
    if ($(este).val().length != 9) {
        return false;
    }else{
        return true;
    }
}
function reemplazarAcentos(s)
{
    return s.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

}
</script>
</body>
</html>