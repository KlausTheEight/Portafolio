
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Parque Quebrada de Macul</title>
    <style>
        .verde{
            background-color:#218c74;
        }
        .azul{
            background-color:#34ace0;
        }
        .gris{
            background-color:#f7f1e3;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row azul">
            <div class="col-md-8 offset-md-2 gris pt-5 pb-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="<?=base_url()?>assets/img/pin.png">
                            <h1 class="display-4">Recuperación de contraseña</h1>
                        </div>
                        <div class="lead">
                            <p>Estimad@ Usuari@, se ha generado un código para restablecer su contraseña. Si usted no ha generado esta solicitud, ignore este correo.</p>
                            <p><strong>Su código de recuperación es el siguiente:</strong></p>
                        </div>
                      
                    </div>
                    <div class="col-md-12">
                        <div class="border pl-5 pr-5 pb-3 pt-3 text-center">
                            <h1><?=$mensaje?></h1>
                        </div>
                        <div class="lead mt-4">
                            <p>Ingrese este código en la aplicación Parque Quebrada de Macul.</p>
                        </div>
                        <blockquote class="blockquote text-right">
                       
                        <footer class="blockquote-footer">Atentamente, <cite title="Source Title">El equipo de Soporte.</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>