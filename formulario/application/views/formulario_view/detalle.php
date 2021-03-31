<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.steps.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <?php if ($ingreso["ingresador"] != ""): ?>
        <h2>INGRESADO POR: <?= $ingreso["ingresador"] ?></h2>
    <?php endif ?>
    <div class="container">
        <form id="formulario_<?php echo $form["id"] ?>">
            <div id="pasos">
                <?php echo $formulario ?>
                <hr>
                <h2 class="text-center my-4 text-danger"><u>Revisión</u></h2>
                <div class="col-md-12 contenedor-input my-3">
                    <label class="label_106">Estado postulación</label>
                    <select required class="form-control" id="estado" name="estado">
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?= $estado["id"] ?>"><?= $estado["nombre"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-12 contenedor-input my-3">
                    <label class="label_106">Observaciones de la postulación</label>
                    <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                </div>
                <div class="col-md-12 contenedor-input my-3">
                    <label class="label_106">Origen</label>
                    <!--<select required class="form-control" id="origen" name="origen">
                        <option <?= $ingreso["origen"] == "WEB" ? "selected" : "" ?> value="WEB">WEB</option>
                        <option <?= $ingreso["origen"] == "PRESENCIAL" ? "selected" : "" ?> value="PRESENCIAL">PRESENCIAL</option>
                    </select>-->
                    <input type="text" value="<?= $ingreso["origen"] ?>" readonly="readonly">
                </div>
            </div>
        </form>
        <div class="row">
            <div class=" col-md-6 text-center">
                <button class=" btn btn-success btn-enviar" type="button" id="btn-enviar">Guarda y editar</button>
            </div>
            <div class=" col-md-6 text-center">
                <button class=" btn btn-danger btn-enviar" type="button" id="volver">Volver</button>
            </div>
        </div>
    </div>
    <?php echo $form["js"] ?>
    <script>
        <?php echo $form["js_custom"] ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.steps.js"></script>
    <script>
        $("#estado").val(<?= $ingreso["estado_id"] ?>);
        $("#origen").val("<?= $ingreso["origen"] ?>");
        <?php echo $pasos ?>
        $("#volver").click(function(){
            window.close();
        })
        $(".btn-enviar").click(function (e) {
            if(validar_campos()){
                enviar();
            }
        });

        function validar_campos() {
            var valido = true;
           /* $(".error-p").remove();
            $(".validar").each(function(){
                var este = this;
                if($(this).val() == ""){
                    $(this).parent().append("<p class='error-p' style='color:#FF0000;'>Debe completar este campo</p>");
                    if (valido) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $(this).offset().top-100
                        }, 500);
                    }
                    valido = false;
                }
            })*/

            return valido;
        }

        function actualizar_ingreso(){

        }

        function enviar() {
            var data = new FormData($('#formulario_<?php echo $form["id"] ?>')[0]);
            var url = "<?php echo base_url() ?>formulario_controller/actualizar_ingreso/<?php echo $ingreso["id"] ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                contentType: false,
                processData: false,
            }).done(function(x) {
                var obj = JSON.parse(x);
                console.log(obj["mensaje"]);
                if (obj["codigo"] == 1) {
                    Swal.fire({
                        icon: 'success',
                        text: obj["mensaje"]
                    });
                    setTimeout(function () { location.reload(true); },1000);
                }else{
                    Swal.fire({
                        icon: 'error',
                        html: obj["mensaje"],
                    });
                    $("#enviar").html("Volver a enviar.");
                    $("#enviar").removeAttr("disabled");
                }
            }).fail(function() {
            }).always(function() {
            });

        }
    </script>
</body>
</html>