<script>
    var current_id=null;
    function set_current_id(id){
      current_id=id;
      $('#id_solicitud').val(id);
    }

    $('.derivar').click(function (e) { 
      $('#modalDerivar').modal('show');
      set_current_id($(this).data('solicitudid'));
    });

    function click_derivar(id){
      $('#modalDerivar').modal('show');
      set_current_id(id);
    }

    function click_derivar_ids(){
      $('#modalDerivarSolicitudes').modal('show');
      $('#ids_solicitudes').val($('#hidden_id').val());
    }

    $('.eliminar').click(function (e) { 
      $('#modalEliminar').modal('show');
      $('#id_solicitud_eliminar').val($(this).data('solicitudid'));
    });


    $('#bandeja_id').change(function (e) { 
    
        $.ajax({
          type: "get",
          url: "<?=base_url()?>bandejas/ajax_usuarios_bandeja/"+$('#bandeja_id').val(),
          success: function (response) {
              $('#usuario_id').empty();
              $('#usuario_id').append('<option value="random">-Usuario aleatorio-</option>');
              var obj = JSON.parse(response);
            
              $(obj).each(function (index, element) {
                // element == this
                $('#usuario_id').append('<option value="'+element["id"]+'">'+element["nombre"]+'</option>')
              });
          }
        });
      
    });

    $('#bandeja_id_2').change(function (e) { 
    
    $.ajax({
      type: "get",
      url: "<?=base_url()?>bandejas/ajax_usuarios_bandeja/"+$('#bandeja_id_2').val(),
      success: function (response) {
          $('#usuario_id_2').empty();
          $('#usuario_id_2').append('<option value="random">-Usuario aleatorio-</option>');
          var obj = JSON.parse(response);
        
          $(obj).each(function (index, element) {
            // element == this
            $('#usuario_id_2').append('<option value="'+element["id"]+'">'+element["nombre"]+'</option>')
          });
      }
    });
  
});
  </script> 