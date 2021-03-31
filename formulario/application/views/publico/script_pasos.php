

<?php
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$isMob = is_numeric(strpos($ua, "mobile"));
$orientacion='';
if (!$isMob) {
    $orientacion='stepsOrientation: "vertical",';

}else{
    $orientacion='stepsOrientation: "horizontal",';
}
?>

$("#pasos").steps({
    headerTag: "h2",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    <?=$orientacion?>
    labels:{
        finish: "Enviar",
        next: "Siguiente",
        previous: "Anterior"
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        window.scrollTo(0,0);
        console.log(event);
        console.log(currentIndex);
        console.log(newIndex);
        if(currentIndex > newIndex){
            //ATRAS
            return true;
        }else{
            return validar_campos();
        }
    },
    onFinished: function (event, currentIndex) {
        if(validar_campos()){
            enviar();
        }else{
            /*Swal.fire({
                icon: 'error',
                text: 'Hay campos obligatorios que no ha completado.'});*/
            }
        },
    });

