<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMAIL</title>
</head>
<body style="text-align: center !important;">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <div style="text-align: center !important;width: 100% !important;background-color: #34ace0 !important;margin:0 auto;padding-top: 50px;padding-bottom: 50px;">
        <div style="width: 70% !important;background-color: #f7f1e3;margin:0 auto;padding-top: 40px;padding-bottom: 40px;padding-left: 50px;padding-right: 50px;text-align: center;">
            <div style="text-align:center !important;">
                <img src="<?=base_url()?>assets/img/pin.png">    
                <h1>Recuperación de contraseña</h1>
            </div>
            <br>
            <p style="text-align: left;">Estimad@ Usuari@, hemos generado un código para restablecer su contraseña. Si usted no ha generado esta solicitud, ignore este correo.</p>
            <p style="text-align: left;"><strong>Su código de recuperación es el siguiente:</strong></p>
            <div style="border: 1px #ccc solid;padding: 10px 10px 10px 10px;width: 200px;margin:0 auto;">
                <h1><?=$mensaje?></h1>
            </div>
        </div>
    </div>
</body>
</html>