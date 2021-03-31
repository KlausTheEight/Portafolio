<?php defined('BASEPATH') OR exit('No direct script access allowed');

function token_($token){
    if ($token=="12341234") {
        return true;
    }else{
        $response=["status"=>1];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    die();
}

function token($token){
    $CI =& get_instance();
    $CI->load->model('Model');
    $o=$CI->Model->verify_token($token);

    if ($o!=null) {
        return true;
    }else{
        $response=["status"=>1];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    die();
}

function sendmail($mensaje,$para,$asunto=null){
    $CI =& get_instance();
    $CI->load->library('email');
    $CI->email->set_newline("\r\n");
    $CI->email->set_mailtype("html");

    $data["mensaje"]=$mensaje;

    $template=$CI->load->view('mailrecover',$data,TRUE);
    $CI->email->from('soporte@penalolen.cl', 'Soporte PQM');
    if ($asunto!=null) {
        $CI->email->subject($asunto);
    }else{
        $CI->email->subject('PENALOLEN');
    }


    $CI->email->to($para);
        //$CI->email->message($html);
    $CI->email->message($template);
    $CI->email->send();
}

function sendmail_r($mensaje,$para,$boton=null,$url=null,$asunto="Recuperar contraseña"){
    $CI =& get_instance();
    $CI->load->library('email');
    $CI->email->set_newline("\r\n");
    $CI->email->set_mailtype("html");

    $data["mensaje"]=$mensaje;
    $data["boton"]=$boton;
    $data["url"]=$url;

    $template=$CI->load->view('api/mailing_recovery',$data,TRUE);
    $CI->email->from('contacto@contratapp.cl', 'Contrata');
    if ($asunto!=null) {
        $CI->email->subject($asunto);
    }else{
        $CI->email->subject('CONTRATA');
    }


    $CI->email->to($para);
        //$CI->email->message($html);
    $CI->email->message($template);
    $CI->email->send();
}

function sendmail_admin($mensaje,$boton=null,$url=null){
    $CI =& get_instance();
    $CI->load->library('email');
    $CI->email->set_newline("\r\n");
    $CI->email->set_mailtype("html");

    $data["mensaje"]=$mensaje;
    $data["boton"]=$boton;
    $data["url"]=$url;
    $para=$CI->config->item('correo_admin');
    $template=$CI->load->view('api/email',$data,TRUE);
    $CI->email->from('contacto@contratapp.cl', 'Contrata');
    $CI->email->subject('NUEVO ACUERDO');
    $CI->email->to($para);
        //$CI->email->message($html);
    $CI->email->message($template);
    $CI->email->send();
}

function is_login($origin=null){
    $CI =& get_instance();
    if ($CI->session->userdata('usuario')!=null) {
        return true;
    }else{
        if ($origin!=null) {
                #$CI->session->set_flashdata('info', 'Se ha cerrado su sesión por inactividad');
            return false;

        }else{
                #$CI->session->set_flashdata('info', 'Se ha cerrado su sesión por inactividad');
            $CI->session->set_userdata('volver', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            redirect('auth/login','refresh');
        }
    }
}

function is_admin($origin=null){
    $CI =& get_instance();
    if ($CI->session->userdata('usuario')!=null) {
        if ($CI->session->userdata('usuario')["perfil_id"]==1) {
            return true;
        }else{
            return false;
        }
    }else{
        if ($origin!=null) {
                #$CI->session->set_flashdata('info', 'Se ha cerrado su sesión por inactividad');
            return false;

        }else{
                #$CI->session->set_flashdata('info', 'Se ha cerrado su sesión por inactividad');
            redirect('auth/login','refresh');
        }
    }
}


function moneda($numero){
    $numero = (string)$numero;
    $puntos = floor((strlen($numero)-1)/3);
    $tmp = "";
    $pos = 1;
    for($i=strlen($numero)-1; $i>=0; $i--){
        $tmp = $tmp.substr($numero, $i, 1);
        if($pos%3==0 && $pos!=strlen($numero))
            $tmp = $tmp.".";
        $pos = $pos + 1;
    }
    $formateado = "$ ".strrev($tmp);
    return $formateado;
}

function configuracion($config){
    $CI =& get_instance();
    $CI->load->model('Modelo_general');
    return $CI->Modelo_general->get_config($config);
}

function draw_campo($id,$class=null,$historial_id=null,$bandeja_id){
    $CI =& get_instance();
    $CI->load->model('Modelo_campo');
    $campo=$CI->Modelo_campo->get($id,null);
        #VALOR
    $valor=$CI->Modelo_campo->get_valor($historial_id,$bandeja_id,$id);
    if ($valor!=null) {
        $value=$valor["valor"];
    }else{
        $v=[
            "campo_id"=>$id,
            "bandeja_id"=>$bandeja_id,
            "historial_solicitud_id"=>$historial_id,
            "valor"=>''
        ];
        $CI->Modelo_campo->add_valor($v);
        $valor=$CI->Modelo_campo->get_valor($historial_id,$bandeja_id,$id);
        $value=$valor["valor"];
    }
        #VALOR
    if ($class==null) {
        $class='col-md-3 col-sm-12 col-xs-12 mb-4';
    }

    if ($campo["requerido"]==1) {
        $required='required';
        $option_required='<option value="">-Seleccione opción-</option>';
        $asterisco='*';
    }else{
        $required='';
        $option_required='<option value="">-Seleccione opción-</option>';
        $asterisco='';
    }

    switch ($campo["tipo"]) {
        case 'select':
        $opciones=explode(';',$campo["opciones"]);
        $option='';
        $option.=$option_required;
        foreach ($opciones as $opccion) {
            if ($value==$opccion) {
                $selected='selected';
            }else{
                $selected='';
            }
            $option.='<option '.$selected.' value="'.$opccion.'">'.$opccion.'</option>';
        }
        $input='<select '.$required.' name="campo_'.$valor["id"].'" class="form-control">'.$option.'</select>';
        break;

        case 'checkbox':
        $opciones=explode(';',$campo["opciones"]);
        $option='<br>';
        foreach ($opciones as $opcion) {
            $values=explode(';',$value);
                    #echo $value;
            $checked='';
            foreach ($values as $v) {
                if ($v==$opcion) {

                    $checked='checked';
                }
            }
            $option.='<input value="'.$opcion.'" type="checkbox" name="campocheck_'.$valor["id"].'[]" '.$checked.'> '.$opcion.'<br>';
        }
        $input=$option;
        break;

        case 'textarea':
        $input='<textarea '.$required.' name="campo_'.$valor["id"].'" class="form-control">'.$value.'</textarea>';
        break;

        default:
        $input='<input '.$required.' type="'.$campo["tipo"].'" value="'.$value.'" name="campo_'.$valor["id"].'" class="form-control">';
        break;
    }

    $return='
    <div class="'.$class.'">
    <div class="form-group">
    <label class="form-control-label">'.$campo["nombre"].' '.$asterisco.'</label>
    '.$input.'
    <small>'.$campo["descripcion"].'</small>
    </div>
    </div>
    ';

    echo $return;
}

function escala_nota($porcentaje)
{
    $escala = ["0" =>  "1.0",
    "1" =>  "1.0",
    "2" =>  "1.1",
    "3" =>  "1.1",
    "4" =>  "1.2",
    "5" =>  "1.2",
    "6" =>  "1.3",
    "7" =>  "1.3",
    "8" =>  "1.3",
    "9" =>  "1.4",
    "10" =>  "1.4",
    "11" =>  "1.5",
    "12" =>  "1.5",
    "13" =>  "1.6",
    "14" =>  "1.6",
    "15" =>  "1.6",
    "16" =>  "1.7",
    "17" =>  "1.7",
    "18" =>  "1.8",
    "19" =>  "1.8",
    "20" =>  "1.9",
    "21" =>  "1.9",
    "22" =>  "1.9",
    "23" =>  "2.0",
    "24" =>  "2.0",
    "25" =>  "2.1",
    "26" =>  "2.1",
    "27" =>  "2.2",
    "28" =>  "2.2",
    "29" =>  "2.2",
    "30" =>  "2.3",
    "31" =>  "2.3",
    "32" =>  "2.4",
    "33" =>  "2.4",
    "34" =>  "2.5",
    "35" =>  "2.5",
    "36" =>  "2.5",
    "37" =>  "2.6",
    "38" =>  "2.6",
    "39" =>  "2.7",
    "40" =>  "2.7",
    "41" =>  "2.8",
    "42" =>  "2.8",
    "43" =>  "2.8",
    "44" =>  "2.9",
    "45" =>  "2.9",
    "46" =>  "3.0",
    "47" =>  "3.0",
    "48" =>  "3.1",
    "49" =>  "3.1",
    "50" =>  "3.1",
    "51" =>  "3.2",
    "52" =>  "3.2",
    "53" =>  "3.3",
    "54" =>  "3.3",
    "55" =>  "3.4",
    "56" =>  "3.4",
    "57" =>  "3.4",
    "58" =>  "3.5",
    "59" =>  "3.5",
    "60" =>  "3.6",
    "61" =>  "3.6",
    "62" =>  "3.7",
    "63" =>  "3.7",
    "64" =>  "3.7",
    "65" =>  "3.8",
    "66" =>  "3.8",
    "67" =>  "3.9",
    "68" =>  "3.9",
    "69" =>  "4.0",
    "70" =>  "4.0",
    "71" =>  "4.1",
    "72" =>  "4.2",
    "73" =>  "4.3",
    "74" =>  "4.4",
    "75" =>  "4.5",
    "76" =>  "4.6",
    "77" =>  "4.7",
    "78" =>  "4.8",
    "79" =>  "4.9",
    "80" =>  "5.0",
    "81" =>  "5.1",
    "82" =>  "5.2",
    "83" =>  "5.3",
    "84" =>  "5.4",
    "85" =>  "5.5",
    "86" =>  "5.6",
    "87" =>  "5.7",
    "88" =>  "5.8",
    "89" =>  "5.9",
    "90" =>  "6.0",
    "91" =>  "6.1",
    "92" =>  "6.2",
    "93" =>  "6.3",
    "94" =>  "6.4",
    "95" =>  "6.5",
    "96" =>  "6.6",
    "97" =>  "6.7",
    "98" =>  "6.8",
    "99" =>  "6.9",
    "100" =>  "7.0"];
    return $escala[$porcentaje];
}
function condicion($porcentaje, $nota, $quiz, &$arreglo)
{
    if ($quiz === false) {
        $arreglo["En Proceso"]++;
        return "En Proceso";
    }elseif ($porcentaje >= 75 && $nota >= 70) {
        $arreglo["Aprobado"]++;
        return "Aprobado";
    }else{
        $arreglo["Reprobado"]++;
        return "Reprobado";
    }
}

function color_condicion($condicion)
{
    switch ($condicion) {
        case "Aprobado":
        return "bg-success";
        break;
        case "Reprobado":
        return "bg-danger";
        case "En Proceso":
        return "bg-warning";
        default:
        return "bg-info";
        break;
    }
}

function subir_documento($nombre,$extensiones){

    $CI =& get_instance();

    $config['upload_path']          = './uploads/archivo/';
    $config['allowed_types']        = $extensiones;
    $config['max_size']             = 60000;
    $config['file_name'] = uniqid();
    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ( ! $CI->upload->do_upload($nombre))
    {

        $respuesta=[
            "codigo"=>1,
            "mensaje"=>$CI->upload->display_errors()
        ];
        return $respuesta;
    }
    else
    {
        $respuesta=[
            "codigo"=>0,
            "mensaje"=>$CI->upload->data('file_name')
        ];
        return $respuesta;
    }
}

function dibujar_campo($campo, $valor = null, $detalle = false){
    $CI =& get_instance();
    $field='';
    $requerido='';
    $asterisco='';
    $validar='';
    if ($campo["obligatorio"]==1) {
     $requerido='required';
     $asterisco=' * ';
     $validar='validar';
 }
 $field='<label class="label_'.$campo["id"].'">'.$campo["nombre"].$asterisco.'</label>';
 switch ($campo["type"]) {
    case 'text':
    $field.='<input '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' type="text" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  value="'.($valor != null ? $valor["valor"] : "").'" '.($campo["validaciones"] != null ? "validaciones='".$campo["validaciones"]."'" : "").'>';
    break;

    case 'number':
    $field.='<input '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' type="number" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  value="'.($valor != null ? $valor["valor"] : "").'">';
    break;

    case 'date':
    $field.='<input  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' type="date" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  value="'.($valor != null ? $valor["valor"] : "").'">';
    break;

    case 'time':
    $field.='<input  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' type="time" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  value="'.($valor != null ? $valor["valor"] : "").'">';
    break;

    case 'file':
    if ($detalle) {
        $field.='<strong class="archivo_actual d-block">Archivo cargado: '.(isset($valor) && !in_array($valor["valor"], ["", null, "VACIO"]) ? "<a target='_blank' href='".base_url()."uploads/archivo/".$valor["valor"]."'>Ver archivo</a><p>Para reemplazar el archivo actual, cargue uno nuevo y guarde los cambios.</p>" : 'No se cargó el archivo').'</strong>';
    }
    if (false && $detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2") {

    }else{
        $field.='<input '.$requerido.' type="file" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'"  name="campo_'.$campo["id"].'" >';
    }
    $field.='<small class="archivos_permitidos">Archivos permitidos : '.($campo["extensiones"] == "*" ? "Cualquier tipo" : $campo["extensiones"]).'</small>';
    break;

    case 'select':
    $valores=explode(";",$campo["valores"]);
    $options='<option value="">Seleccione una opción</option>';
    foreach ($valores as $key => $opcion) {
        $options.='<option '.($valor != null && $valor["valor"] == $opcion ? "selected" : "").' value="'.$opcion.'">'.$opcion.'</option>';
    }
    $field.='<select  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').' >'.$options.'</select>';
    break;

    case 'checkbox':
    $valores=explode(";",$campo["valores"]);
    $options='';
    foreach ($valores as $key => $opcion) {
        $i=uniqid();
        $options.='<br><label for="'.$i.'"><input  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.($campo["validaciones"] != null ? "validaciones='".$campo["validaciones"]."'" : "").' type="checkbox" class="'.$validar.' '.$campo["class"].'"  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "" : 'name="campo_'.$campo["id"].'"').'" id="'.$i.'" value="'.$opcion.'" '.($valor != null && $valor["valor"] == $opcion ? "checked" : "").'> <strong>'.$opcion.'</strong></label>';
    }
    $field.=$options;
    break;

    case 'radio':
    $valores=explode(";",$campo["valores"]);
    $options='';
    foreach ($valores as $key => $opcion) {
        $i=uniqid();
        $options.='<div style="float:left;width:100%;margin-top:6px;">
        <input  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' style="float: left;width:20px;height:20px;" type="radio" class="'.$validar.' '.$campo["class"].'"  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  id="'.$i.'" value="'.$opcion.'" '.($valor != null && $valor["valor"] == $opcion ? "checked" : "").'>
        <label style="float: left;font-size:17px;padding-left:10px;" class="radio-label" for="'.$i.'"><strong>'.$opcion.'</strong></label>
        </div>';
    }
    $field.=$options;
    break;

    case 'html':
    $field=$campo["html"];
    break;

    case 'input-tabla':
    $CI =& get_instance();
    $data = $campo;
    $data["valores"] = $valor;
    $data["configuracion"] = json_decode($data["configuracion"], true);
    if (count($data["configuracion"]["etiquetas"]) == 1 && count($data["configuracion"]["etiquetas"][0]) == 1 && $data["configuracion"]["etiquetas"][0][0] == "") {
        $data["configuracion"]["etiquetas"] = null;
    }
    $data["readonly"] = $detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "";
    $field.= $CI->load->view('plantilla_campo/input-tabla', $data, true);
    break;

    case 'textarea':
    $field.='<textarea  '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "").' '.$requerido.' type="text" class="'.$validar.' '.$campo["class"].'" id="'.$campo["identificador"].'" '.($detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == '2' ? '' : 'name="campo_'.$campo["id"].'"').'  rows="4">'.($valor != null ? $valor["valor"] : "").'</textarea>';
    break;

    default:
    break;
}
if ($campo["descripcion"]!=null) {
    $field.='<p><small class="descripcion-campo descripcion_'.$campo["id"].'">'.$campo["descripcion"].'</small></p>';
}

return $field;
}

function dibujar_tabla_pdf($campo, $valor = null, $detalle = false)
{
    $CI =& get_instance();
    $field='';
    $requerido='';
    $asterisco='';
    $validar='';
    if ($campo["obligatorio"]==1) {
     $requerido='required';
     $asterisco=' * ';
     $validar='validar';
 }
 $field='';
    $CI =& get_instance();
    $data = $campo;
    $data["valores"] = $valor;
    $data["configuracion"] = json_decode($data["configuracion"], true);
    if (count($data["configuracion"]["etiquetas"]) == 1 && count($data["configuracion"]["etiquetas"][0]) == 1 && $data["configuracion"]["etiquetas"][0][0] == "") {
        $data["configuracion"]["etiquetas"] = null;
    }
    $data["readonly"] = $detalle && $CI->session->userdata('usuario') != null && $CI->session->userdata('usuario')["perfil_id"] == "2" ? "readonly" : "";
    $field.= $CI->load->view('plantilla_campo/input-tabla_pdf', $data, true);

    return $field;

}

?>