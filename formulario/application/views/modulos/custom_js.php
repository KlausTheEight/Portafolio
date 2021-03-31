<script>
  function asociativa(id){
    var select='<select class="select-asociativa form-control-sm" name="selectiva['+id+']" onchange="" id="select_'+id+'">';
    <?php
    foreach ($tablas as $tabla) {
        ?>
        select=select+'<option value="<?=$tabla["tabla"]?>"><?=$tabla["tabla"]?></option>';
        <?php
    }
    ?>
    select=select+"</select>";
    $('#td_'+id).append('<div class="div-select-asociativa"><br><label class="text-white">Tabla asociativa</label> '+select+'</div>');
}
function get_campos(){
    var form = new FormData();
    form.append("tabla", $('#tablas').val());
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "<?=base_url()?>modulos/ajax_getCampos",
        "method": "POST",
        "processData": false,
        "contentType": false,
        "mimeType": "multipart/form-data",
        "data": form
    }
    var id=0;
    
    $.ajax(settings).done(function (response) {
        obj=JSON.parse(response);
        $('#tbody').empty();
        obj.forEach(function(object) {

            var select_texto='<select class="form-control-sm" id="select_texto['+id+']" name="select_tipo['+id+']">'+
                    '<option value="text">texto</option>'+
                    '<option value="number">numeros</option>'+
                    '<option value="email">email</option>'+
                    '<option value="password">password</option>'+
                    '<option value="date">fecha</option>'+
                    '<option value="time">hora</option>'+
                    '<option value="color">color</option>'+
                    '<option value="datetime">fecha y hora</option>'+
                    '</select>';
                    
            var radios='<td><input type="radio" class="radio-input" name="radio_tipo['+id+']" value="'+object.campo+',texto"><br>'+select_texto+'</td>';
            var radios=radios+'<td><input type="radio" class ="radio-input" name="radio_tipo['+id+']" value="'+object.campo+',textarea"></td>';
            var radios=radios+'<td><input type="radio" class ="radio-input" name="radio_tipo['+id+']" value="'+object.campo+',imagen"></td>';
            var radios=radios+'<td class="td-asociativa" id="td_'+id+'"><input id_td="'+id+'" campo="'+object.campo+'" type="radio" class="radio-input radio-selectiva" name="radio_tipo['+id+']" value="'+object.campo+',select"></td>';
            var radios=radios+'<td><input type="radio" class ="radio-input" name="radio_tipo['+id+']" value="'+object.campo+',checkbox"></td>';
            var primary="";
            if (object.primary==1) {
                primary='<span class="text-warning">Llave primaria</span>';
            }
            $('#tbody').append('<tr id="tr_'+id+'"><td>'+object.campo+' ('+object.tipo+'['+object.max+']) '+primary+'</td>'+radios+'<td><input required type="text" class="form-control-sm" name="label['+id+']"></td><td><button class="btn btn-danger btn-sm" onclick="quitar('+id+');">Descartar</button></td></tr>');
            console.log(object.campo);
            console.log(object.max);
            console.log(object.primary);
            console.log(object.tipo);
            console.log("---");
            id++;
        });
    });
}
function quitar(id){
  $('#tr_'+id).remove();
}
$(document).ready(function () {
  get_campos();

  $("body").on("change",".radio-input",function(){
    var este = $(this);
    if ($(este).hasClass("radio-selectiva")){
        asociativa($(este).attr("id_td"));
    }else{
        $(este).parent().parent().find(".td-asociativa").find(".div-select-asociativa").remove();
    }
});
});
</script>