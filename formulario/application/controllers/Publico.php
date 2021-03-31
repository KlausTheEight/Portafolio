<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Formulario_model');
        $this->load->helper('api_helper');

    }


    public function index()
    {
        $this->load->view('public');
    }

    public function formulario(){
        header('Access-Control-Allow-Origin: *');
        $id=$this->input->get('id');
        $secciones=$this->Formulario_model->get_seccion(null,null,$id);
        $form=$this->Formulario_model->get(null,$id);
        $formulario='';

        $redireccion=base_url().'publico/formulario?id='.$id;
        if ($form["redireccion"]!=null) {
            $redireccion=$form["redireccion"];
        }

        foreach ($secciones as $key => $seccion) {
            $secciones[$key]["campos"]=$this->Formulario_model->get_campos(null,$seccion["id"]);
            $campos='';
            foreach ($secciones[$key]["campos"] as $key2 => $campo) {
                $campos.='<div class="'.$campo["class_contenedor"].'">
                '.dibujar_campo($campo).'
                </div>';
            }
            $formulario.='<h2>'.$seccion["nombre"].'</h2><section class="'.$seccion["clase_contenedor"].'"><div class="row">'.$campos.'</div></section>';
        }

        $pasos='';
        $boton='';

        $data["form"] = $form;
        $data["formulario"] = $formulario;
        $data["redireccion"] = $redireccion;


        if ($form["pasos"]==1) {
            $pasos= $this->load->view('publico/script_pasos', null, TRUE);
        }else{
            $boton= $this->load->view('publico/script_no_pasos', $data, TRUE);
        }
        $data["boton"] = $boton;
        $data["pasos"] = $pasos;
        echo $this->load->view('publico/formulario', $data, TRUE);

    }

    function captcha($captcha_servidor=null){
        $recaptcha = $_POST["g-recaptcha-response"];

        $postdata = http_build_query(["secret"=>$captcha_servidor,"response"=>$recaptcha]);
        $opts = ['http' =>
        [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        ]
    ];
    $context  = stream_context_create($opts);
    $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    $check = json_decode($result);

    if ($check->success) {
       return true;
   } else {
       return false;
   }

}

public function correo($ingreso_id=null,$formulario=null){

    $para=$this->input->post('campo_'.$formulario["correo_campo_id"]);

    if (AMBIENTE=='produccion') {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp-relay.gmail.com';
        $config['smtp_user'] = 'no-reply@penalolen.cl';
            #$config['smtp_pass'] = '';
        $config['smtp_port'] = 465;
    }


    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    $config['newline'] = "\r\n";
    $this->email->initialize($config);
    $plantilla_correo=$formulario["plantilla_correo"];

    foreach ($this->input->post() as $key => $post) {

        $id=str_replace("campo_","",$key);
        /*if (is_string($post)) {
            $plantilla_correo=str_replace("{{".$id."}}",$post,$plantilla_correo);
        }
        if (is_array($post)) {
            $plantilla_correo=str_replace("{{".$id."}}",implode(",",$post),$plantilla_correo);
        }*/
    }

    $template=$plantilla_correo;
    $this->email->from(CORREO_EMPRESA, EMPRESA);
    $this->email->subject($formulario["asunto_correo"]);
    $this->email->to($para);
    $this->email->message($template);
    if ($formulario["correo_cc"]!=null) {
        $this->email->cc(str_replace(";",",",$formulario["correo_cc"]));
    }

    $this->email->send();
}

function guardar($id=null){
    if ((int)$_SERVER["CONTENT_LENGTH"] > 28000000) {
        $respuesta=[
            "codigo"=>0,
            "mensaje"=>"Ocurrió un error al enviar el formulario <br><strong>El tamaño de los archivos adjuntos supera el máximo permitido de 30MB</strong><br>",
        ];
        echo json_encode($respuesta);
        die();
    }
    if ($id!=null) {

        $form=$this->Formulario_model->get(null,$id);
        $respuesta=[];

    /**
     * Si los campos captcha están completos se cargará el captcha
     */
    if ($form!=null && $form["captcha_web"]!=null && $form["captcha_servidor"]!=null) {
        $respuesta_captcha=$this->captcha($form["captcha_servidor"]);
        if (!$respuesta_captcha) {
            $respuesta=[
                "codigo"=>0,
                "mensaje"=>"No has indicado que no eres un robot"
            ];
            echo json_encode($respuesta);
            die();
        }
    }
    $secciones=$this->Formulario_model->get_seccion(null,null,$id);

    if ($form!=null) {

        /**
         * REGISTRA UN INGRESO AL FORMULARIO
         */
        $ingreso=[
            "ip"=>$_SERVER['REMOTE_ADDR'],
            "fecha_creacion"=>date('Y-m-d H:i:s'),
            "formulario_id"=>$form["id"],
            "estado_id"=>$form["estado_id"],
            "origen" => "WEB",
        ];
        if ($this->session->userdata('usuario') != null) {
            $ingreso["usuario_ingresa_id"] = $this->session->userdata('usuario')["id"];
            $ingreso["origen"] = "PRESENCIAL";
        }
        $id_ingreso=$this->Formulario_model->add_ingreso($ingreso);

        /**RECORRE CADA SECCIÓN DEL FORMULARIO Y TODOS SUS CAMPOS PARA GUARDARLOS */
        foreach ($secciones as $key => $seccion) {
            $secciones[$key]["campos"]=$this->Formulario_model->get_campos(null,$seccion["id"]);
            foreach ($secciones[$key]["campos"] as $key2 => $campo) {
                $valor=[
                    "campo_id"=>$campo["id"],
                    "ingreso_id"=>$id_ingreso
                ];

                /*if (false && $campo["unico"]==1) {
                    $valor_unico=$this->Formulario_model->validar_unico($campo["id"],$this->input->post('campo_'.$campo["id"]));

                    if ($valor_unico!=null) {
                        $respuesta=[
                            "codigo"=>0,
                            "mensaje"=>"El campo <br><strong>".$campo["nombre"]."</strong> ya existe en nuestra base de datos, intente con otro valor"
                        ];
                        $this->Formulario_model->delete_ingreso($id_ingreso);
                        $this->Formulario_model->delete_campos_ingreso($id_ingreso);
                        echo json_encode($respuesta);
                        die();
                    }
                }*/

                switch ($campo["type"]) {


                    case 'file':
                    $retorno_documento=subir_documento('campo_'.$campo["id"],$campo["extensiones"]);
                    if ($retorno_documento["codigo"]==1) {
                        $valor["valor"]="VACIO";
                        if (trim($retorno_documento["mensaje"]) == "<p>No has subido el archivo.</p>") {

                        }else{
                            /*if ($campo["obligatorio"] == "1") {*/
                                $respuesta=[
                                    "codigo"=>0,
                                    "mensaje"=>"Ocurrió un error al subir el archivo <br><strong>".$campo["nombre"]."</strong><br>".$retorno_documento["mensaje"].$_SERVER['CONTENT_LENGTH']
                                ];
                                $this->Formulario_model->delete_ingreso($id_ingreso);
                                $this->Formulario_model->delete_campos_ingreso($id_ingreso);
                                echo json_encode($respuesta);
                                die();
                        /*}else{
                            //No subió el archivo, pero no era obligatorio
                        }*/

                    }
                }else{
                    $valor["valor"]=$retorno_documento["mensaje"];
                }
                break;

                case 'checkbox':
                $variable=$this->input->post('campo_'.$campo["id"]);
                if ($variable!=null){
                    if(is_array($variable)) {
                        $variable=implode(';',$variable);
                        $valor["valor"]=$variable;
                    }else{
                        $valor["valor"] = $variable;
                    }
                }else{
                    $valor["valor"] = "";
                }
                break;

                case 'html':
                break;
                case 'input-tabla':
                $variable=$this->input->post('campo_'.$campo["id"]);
                $valor["valor"] = json_encode($variable);
                break;
                default:
                $valor["valor"]=$this->input->post('campo_'.$campo["id"]);
                break;
            }
            $this->Formulario_model->add_valor($valor);
        }
    }
    $this->Formulario_model->historial_ingreso($id_ingreso);

    $respuesta["codigo"]=1;
    $respuesta["mensaje"]="Formulario enviado con éxito";
    if ($form["envia_correo"]==1) {
       $this->correo($id_ingreso,$form);
   }
}else{
    $respuesta["codigo"]=0;
    $respuesta["mensaje"]="Ocurrió un error al enviar su formulario - cod: 2";
}


}else{
   $respuesta["codigo"]=0;
   $respuesta["mensaje"]="Ocurrió un error al enviar su formulario - cod: 0";
}
echo json_encode($respuesta);
die();
}

}


?>