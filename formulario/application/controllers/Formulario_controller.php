<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Formulario_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata("active", "formulario");
        $this->load->model('Formulario_model');
        $this->load->model('Modelo_tablas');
        $this->load->helper('api_helper');
        is_admin();
    }

    public function view_add(){
        $data["pagina"]="Nuevo registro formulario";
        $this->load->model('Proyecto_model');
        $data["lista_proyecto"]=$this->Proyecto_model->get();

        $this->load->view("formulario_view/add",$data);
    }

    public function view_update($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro formulario";
        $data["object"]=$this->Formulario_model->get($id);
        $secciones=$this->Formulario_model->get_seccion(null,$id);
        foreach ($secciones as $key => $seccion) {
            $secciones[$key]["campos"]=$this->Formulario_model->get_campos(null,$seccion["id"]);
        }
        $data["secciones"]=$secciones;
        $data["tipos"]=$this->Formulario_model->get_tipos();
        $data["estados"]=$this->Formulario_model->get_estado(null,$id);
        $this->load->model('Proyecto_model');
        $data["lista_proyecto"]=$this->Proyecto_model->get();
        $this->load->view("formulario_view/update",$data);
    }

    public function ajax_get($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro formulario";
        $data["object"]=$this->Formulario_model->get($id);
        $this->load->model('Proyecto_model');
        $data["lista_proyecto"]=$this->Proyecto_model->get();
        echo json_encode($data["object"]);
    }

    public function index(){
        $data["datos"]=$this->Formulario_model->get();
        $data["pagina"]="Listar registros de formulario";
        $this->load->view("formulario_view/datatables",$data);

    }

    public function update(){
        $id=$this->input->post("id");
        $object=[];
        $nombre=trim($this->input->post("nombre"));
        $object["nombre"]=$nombre;


        $css=trim($this->input->post("css"));
        $object["css"]=$css;

        $clase_contenedor_boton=trim($this->input->post("clase_contenedor_boton"));
        $object["clase_contenedor_boton"]=$clase_contenedor_boton;

        $clase_botones=trim($this->input->post("clase_botones"));
        $object["clase_botones"]=$clase_botones;

        $css_custom=trim($this->input->post("css_custom"));
        $object["css_custom"]=$css_custom;

        $redireccion=trim($this->input->post("redireccion"));
        $object["redireccion"]=$redireccion;

        $js=trim($this->input->post("js"));
        $object["js"]=$js;

        $js_custom=trim($this->input->post("js_custom"));
        $object["js_custom"]=$js_custom;


        $proyecto_id=trim($this->input->post("proyecto_id"));
        $object["proyecto_id"]=$proyecto_id;

        $estado=trim($this->input->post("estado"));
        $object["estado"]=$estado;

        $pasos=trim($this->input->post("pasos"));
        $object["pasos"]=$pasos;

        $estado_id=trim($this->input->post("estado_id"));
        $object["estado_id"]=$estado_id;

        $envia_correo=trim($this->input->post("envia_correo"));
        $object["envia_correo"]=$envia_correo;

        $captcha_web=trim($this->input->post("captcha_web"));
        $object["captcha_web"]=$captcha_web;

        $captcha_servidor=trim($this->input->post("captcha_servidor"));
        $object["captcha_servidor"]=$captcha_servidor;

        $this->Formulario_model->update($id,$object);

        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("formulario_controller/view_update/".$id,"refresh");
    }

    public function add_estado(){
        $formulario_id=$this->input->post('formulario_id');
        $estado=[
            "nombre"=>$this->input->post('nombre'),
            "formulario_id"=>$this->input->post('formulario_id'),
            "color"=>$this->input->post('color')
        ];
        $this->Formulario_model->add_estado($estado);
        $this->session->set_flashdata("exito","Estado creado exitosamente");
        redirect("formulario_controller/view_update/".$formulario_id,"refresh");
    }

    public function update_thead(){
        $id=$this->input->post("formulario_id");
        $object=[];

        $thead=implode(',',$this->input->post("thead"));
        $object["thead"]=$thead;

        $this->Formulario_model->update($id,$object);

        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("formulario_controller/view_update/".$id,"refresh");
    }

    public function update_correo(){
        $id=$this->input->post("formulario_id");
        $object=[];

        $correo_campo_id=$this->input->post("correo_campo_id");
        $object["correo_campo_id"]=$correo_campo_id;

        $plantilla_correo=$this->input->post("plantilla_correo");
        $object["plantilla_correo"]=$plantilla_correo;

        $asunto_correo=$this->input->post("asunto_correo");
        $object["asunto_correo"]=$asunto_correo;

        $correo_cc=$this->input->post("correo_cc");
        $object["correo_cc"]=$correo_cc;

        $this->Formulario_model->update($id,$object);

        $this->session->set_flashdata("exito","Plantilla actualizada exitosamente");
        redirect("formulario_controller/view_update/".$id,"refresh");
    }

    public function update_pdf(){
        $id=$this->input->post("formulario_id");
        $object=[];

        $plantilla_pdf=$this->input->post("plantilla_pdf");
        $object["plantilla_pdf"]=$plantilla_pdf;

        $this->Formulario_model->update($id,$object);

        $this->session->set_flashdata("exito","Plantilla actualizada exitosamente");
        redirect("formulario_controller/view_update/".$id,"refresh");
    }

    public function ficha_pdf($ingreso_id=null){
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->showImageErrors = true;
        $ingreso=$this->Formulario_model->get_ingreso($ingreso_id);
        if ($ingreso==null) {
            echo "No existe ingreso asociado";
            die();
        }
        $formulario=$this->Formulario_model->get($ingreso["formulario_id"]);
        $stylesheet = file_get_contents(base_url().'assets/css/pdf.css');
        // external css

        $pdf->WriteHTML($stylesheet,1);
        $valores=$this->Formulario_model->get_valor($ingreso_id,null,true);
        $html=$formulario["plantilla_pdf"];
        foreach ($valores as $key => $valor) {
            if ($valor["tipo_id"] == "9") {
            //Tabla
                $campo = $this->Formulario_model->get_campos($valor["campo_id"]);
                $tabla = dibujar_tabla_pdf($campo, $valor, TRUE);
                $html=str_replace('{{'.$valor["campo_id"].'}}', $tabla, $html);
            }elseif ($valor["tipo_id"] == "3") {
            //ARCHIVO
                $html=str_replace('{{'.$valor["campo_id"].'}}', (is_file(FCPATH."uploads/archivo/".$valor["valor"]) ? "<h2 style='color: green;'>√</h2>" : "<h2 style='color: red;'>X</h2>"), $html);
            }else{
                $html=str_replace('{{'.$valor["campo_id"].'}}', $valor["valor"], $html);
            }
        }

        $pdf->WriteHTML($html,2);
        $pdf->Output('ficha-'.date('d-m-Y').'.pdf','I');
        exit;
    }

    public function add(){

        $object=[];
        $nombre=trim($this->input->post("nombre"));
        $object["nombre"]=$nombre;

        $proyecto_id=trim($this->input->post("proyecto_id"));
        $object["proyecto_id"]=$proyecto_id;

        $estado=trim($this->input->post("estado"));
        $object["estado"]=$estado;

        $this->Formulario_model->add($object);
        $this->session->set_flashdata("exito","Registro creado exitosamente");
        redirect("formulario_controller","refresh");
    }

    public function delete($id){
        $this->Formulario_model->delete($id);
        $this->session->set_flashdata("exito","Registro eliminado exitosamente");
        redirect("formulario_controller","refresh");
    }

    public function add_seccion(){
        $formulario_id=$this->input->post('formulario_id');
        $nombre=$this->input->post('nombre');
        $seccion=[
            "nombre"=>$nombre,
            "formulario_id"=>$formulario_id
        ];
        $this->Formulario_model->add_seccion($seccion);
        $this->session->set_flashdata("exito","Sección creada con éxito");
        redirect("formulario_controller/view_update/".$formulario_id,"refresh");
        die();
    }

    public function add_campo(){
        $seccion_id=$this->input->post('seccion_id');
        $formulario_id=$this->input->post('formulario_id');
        $nombre=$this->input->post('nombre');
        $tipo_texto='';
        $campo=[
            "nombre"=>$nombre,
            "descripcion"=>$this->input->post('descripcion'),
            "extensiones"=>$this->input->post('extensiones'),
            "seccion_id"=>$seccion_id,
            "class"=>$this->input->post('class'),
            "identificador"=>$this->input->post('identificador'),
            "obligatorio"=>$this->input->post('obligatorio')==1 ? 1 : 0,
            "unico"=>$this->input->post('unico')==1 ? 1 : 0,
            "tipo_id"=>$this->input->post('tipo_id'),
            "valores"=>$this->input->post('valores'),
            "tipo_texto"=>$tipo_texto,
            "class_contenedor"=>$this->input->post('class_contenedor'),
            "orden"=>$this->input->post('orden'),
            "html"=>$this->input->post('html'),
            "configuracion"=>null,
        ];
        if ($this->input->post('tipo_id') == 9) {

            $configuracion["titulos"] = [];
            foreach ($this->input->post('tabla_titulos') as $value) {
                array_push($configuracion["titulos"], explode(";", $value));
            }
            $configuracion["etiquetas"] = [];
            foreach ($this->input->post('tabla_etiquetas') as $value) {
                array_push($configuracion["etiquetas"], explode(";", $value));
            }
            $configuracion["total_lineas"] = $this->input->post('tabla_total_lineas');
            $campo["configuracion"]=json_encode($configuracion);
        }
        $this->Formulario_model->add_campo($campo);
        $this->session->set_flashdata("exito","Campo creado con éxito");
        redirect("formulario_controller/view_update/".$formulario_id,"refresh");
        die();
    }

    public function ajax_listar(){

        $query_resultado = $this->Formulario_model->make_datatables();
        $data = array();
        foreach($query_resultado as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->nombre;$sub_array[] = $row->proyecto_id;$sub_array[] = $row->estado;
            $sub_array[] = '<a href="'.base_url().'formulario_controller/view_update/'.$row->id.'"><i class="fas fa-pencil-alt text-info"></i></a>
            <a class="ml-3" href="'.base_url().'formulario_controller/listar/'.$row->id.'"><i class="fas fa-table text-primary"></i></a>
            ';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->Formulario_model->get_all_data(),
            "recordsFiltered"     =>     $this->Formulario_model->get_filtered_data(),
            "data"                =>     $data
        );
        echo json_encode($output);
    }

    public function editar_estado($id=null){
        if ($id!=null) {
            $data["estado"]=$this->Formulario_model->get_estado($id,null);
            $this->load->view('formulario_view/editar_estado', $data);
        }
        if ($this->input->post()!=null) {
            $formulario_id=$this->input->post('formulario_id');
            $nombre=$this->input->post('nombre');
            $tipo_texto='';
            $estado=[
                "nombre"=>$nombre,
                "color"=>$this->input->post('color')
            ];
            $this->Formulario_model->update_estado($this->input->post("id"),$estado);
            $this->session->set_flashdata("exito","Estado actualizado con éxito");
            redirect("formulario_controller/view_update/".$formulario_id,"refresh");
            die();
        }
    }

    public function delete_estado($formulario_id,$estado_id){
        $this->Formulario_model->delete_estado($estado_id);
        $this->session->set_flashdata("exito","Estado eliminado con éxito");
        redirect("formulario_controller/view_update/".$formulario_id,"refresh");
    }

    public function delete_campo($formulario_id,$campo_id){
        $this->Formulario_model->delete_campo($campo_id);
        $this->session->set_flashdata("exito","Campo eliminado con éxito");
        redirect("formulario_controller/view_update/".$formulario_id,"refresh");
    }

    public function editar_campo($id=null){
        if ($id!=null) {
            $data["campo"]=$this->Formulario_model->get_campos($id);
            $data["tipos"]=$this->Formulario_model->get_tipos();
            $this->load->view('formulario_view/editar_campos', $data);

        }
        if ($this->input->post()!=null) {

            $formulario_id=$this->input->post('formulario_id');
            $nombre=$this->input->post('nombre');
            $tipo_texto='';
            $campo=[
                "nombre"=>$nombre,
                "descripcion"=>$this->input->post('descripcion'),
                "extensiones"=>$this->input->post('extensiones'),
                "class"=>$this->input->post('class'),
                "identificador"=>$this->input->post('identificador'),
                "obligatorio"=>$this->input->post('obligatorio')==1 ? 1 : 0,
                "unico"=>$this->input->post('unico')==1 ? 1 : 0,
                "tipo_id"=>$this->input->post('tipo_id'),
                "valores"=>$this->input->post('valores'),
                "tipo_texto"=>$tipo_texto,
                "class_contenedor"=>$this->input->post('class_contenedor'),
                "orden"=>$this->input->post('orden'),
                "html"=>$this->input->post('html')
            ];
            $this->Formulario_model->update_campo($this->input->post("id"),$campo);
            $this->session->set_flashdata("exito","Campo actualizado con éxito");
            redirect("formulario_controller/view_update/".$formulario_id,"refresh");
            die();
        }
    }

    public function test($busqueda=null){
        var_dump($this->Modelo_tablas->get_datos(1,$busqueda));
    }

    public function ajax_listar_formulario(){

        $query_resultado = $this->Modelo_tablas->make_datatables();
        $data = array();
        $formulario=$this->Formulario_model->get($this->input->post('formulario_id'));
        $campos=$this->Formulario_model->get_campos(null,null,explode(",",$formulario["thead"]));
        foreach($query_resultado as $row)
        {

            $sub_array = array();
            foreach ($campos as $key => $campo) {
                switch ($campo["type"]) {
                    case 'checkbox':
                    $valor = $this->Formulario_model->get_valor($row->id,$campo["id"]);
                    $valores=explode(";",$valor);
                    $etiquetas='';
                    foreach ($valores as $v) {
                        $etiquetas.='<span class="badge badge-default mr-1">'.$v.'</span>';
                    }
                    $sub_array[] = $etiquetas;
                    break;

                    default:
                    $sub_array[] = $this->Formulario_model->get_valor($row->id,$campo["id"]);
                    break;
                }

            }
            $sub_array[] = '<small>'.$row->observacion.'</small>';
            if ($row->estado_color=="#ffffff") {
                $sub_array[] = '<button class="btn btn-sm text-dark">'.$row->estado.'</button>';
            }else{
                $sub_array[] = '<button class="btn btn-sm text-white" style="background-color:'.$row->estado_color.'">'.$row->estado.'</button>';
            }

            if ($this->session->userdata('usuario')["perfil_id"]==1) {
                $sub_array[]=$row->usuario_nombre;
            }
            $sub_array[] = $row->fecha_creacion;
            $boton_asignar='';
            if ($this->session->userdata('usuario')["perfil_id"]==1) {
                $boton_asignar='<a href="#"  data-id="'.$row->id.'" onclick="asignar(this);"><i class="fas fa-user text-green" title="Asignar"></i></a>';
            }
            $sub_array[] = '<a target="_blank" class="mr-2" href="'.base_url().'formulario_controller/detalle/'.$row->id.'"><i class="fas fa-eye text-primary"></i></a>
            <a target="_blank" class="mr-2" href="'.base_url().'formulario_controller/ficha_pdf/'.$row->id.'"><i class="fas fa-file-pdf text-danger"></i></a>'.$boton_asignar;
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->Modelo_tablas->get_all_data(),
            "recordsFiltered"     =>     $this->Modelo_tablas->get_filtered_data(),
            "data"                =>     $data
        );
        echo json_encode($output);
    }

    public function listar($formulario_id=null){
        $data["formulario"]=$this->Formulario_model->get($formulario_id);
        $this->load->model('Modelo_usuarios');

        $data["usuarios"]=$this->Modelo_usuarios->get_2();
        $data["estados"]=$this->Formulario_model->get_estado(null,$formulario_id);
        if ($data["formulario"]==null) {
            echo "acceso no autorizado";
            die();
        }
        $data["campos"]=$this->Formulario_model->get_campos(null,null,explode(",",$data["formulario"]["thead"]));
        $this->load->view('formulario_view/listar', $data);
    }

    function ajax_tabla_previsualizacion()
    {
        $data = json_decode($this->input->post('datos'), true);
        echo $this->load->view('plantilla_campo/input-tabla', $data, true);
        die();
    }

    function detalle($id_ingreso = null)
    {
        if ($id_ingreso == null) {
            redirect('Formulario_controller/index','refresh');
            die();
        }
        $this->load->model('Ingreso_model');
        $ingreso = $this->Ingreso_model->get($id_ingreso);

        $id=sha1($ingreso["formulario_id"]);
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
                $valor = $this->Ingreso_model->get_campo($ingreso["id"], $campo["id"]);
                $campos.='<div class="'.$campo["class_contenedor"].'">
                '.dibujar_campo($campo, $valor, TRUE).'
                </div>';
            }
            $formulario.='<h2>'.$seccion["nombre"].'</h2><section class="'.$seccion["clase_contenedor"].'"><div class="row">'.$campos.'</div></section>';
        }


        $data["pasos"] = '';
        $data["ingreso"]=$ingreso;
        $data["form"] = $form;
        $data["formulario"] = $formulario;
        $data["redireccion"] = $redireccion;
        $data["boton"] = $this->load->view('publico/script_no_pasos', $data, TRUE);
        $data["estados"]=$this->Formulario_model->get_estado(null,$form["id"]);


        $this->load->view('formulario_view/detalle', $data);
    }

    function asignar_usuario($id_ingreso,$usuario_id){
        $ingreso_update=[
            "usuario_id"=>$usuario_id
        ];

        $this->Formulario_model->update_ingreso($id_ingreso,$ingreso_update);
        $this->correo($usuario_id,$id_ingreso);
        echo "true";
    }

    public function correo($usuario_id,$ingreso_id){
        $this->load->model('Usuario_model');
        $this->load->model('Ingreso_model');
        $ingreso = $this->Ingreso_model->get($ingreso_id);
        $usuario=$this->Usuario_model->get($usuario_id);
        $data["ingreso"]=$ingreso;
        $data["usuario"]=$usuario;

        $para=$usuario["email"];

    /*
    if (AMBIENTE=='produccion') {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp-relay.gmail.com';
        $config['smtp_user'] = 'no-reply@penalolen.cl';
        #$config['smtp_pass'] = '';
        $config['smtp_port'] = 465;
    }
   */

    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    $config['newline'] = "\r\n";
    $this->email->initialize($config);

    $template=$this->load->view('email/correo_derivacion',$data,TRUE);
    $this->email->from('no-reply@penalolen.cl', APLICACION);
    $this->email->subject('TIENES UNA NUEVA POSTULACIÓN  ASIGNADA');
    $this->email->to($para);
    $this->email->message($template);
    $this->email->send();
}

function actualizar_ingreso($id_ingreso=null){


    if ($id_ingreso!=null) {
        $this->load->model('Ingreso_model');
        $ingreso = $this->Ingreso_model->get($id_ingreso);

        $form=$this->Formulario_model->get(null,sha1($ingreso["formulario_id"]));

        $respuesta=[];
        $secciones=$this->Formulario_model->get_seccion(null,$form["id"]);

        if ($form!=null) {

            $ingreso_update=[
                "fecha_modificacion"=>date('Y-m-d H:i:s'),
                "estado_id"=>$this->input->post('estado'),
                "observacion"=>$this->input->post('observaciones'),
                //"origen"=>$this->input->post('origen'),
                "usuario_revisador_id" => $this->session->userdata('usuario')["id"],
            ];

            $this->Formulario_model->update_ingreso($id_ingreso,$ingreso_update);

            foreach ($secciones as $key => $seccion) {
                $secciones[$key]["campos"]=$this->Formulario_model->get_campos(null,$seccion["id"]);
                foreach ($secciones[$key]["campos"] as $key2 => $campo) {
                    if (!isset($_POST['campo_'.$campo["id"]]) && !(isset($_FILES['campo_'.$campo["id"]]) && $_FILES['campo_'.$campo["id"]]["name"] != "")) {
                        continue;
                    }
                    $valor=[
                        "campo_id"=>$campo["id"],
                        "ingreso_id"=>$id_ingreso
                    ];
                    switch ($campo["type"]) {
                        case 'file':
                        $retorno_documento=subir_documento('campo_'.$campo["id"],$campo["extensiones"]);
                        if ($retorno_documento["codigo"]==1) {
                            $valor["valor"]="VACIO";
                            if (trim($retorno_documento["mensaje"]) == "<p>No has subido el archivo.</p>") {
                                $valor = null;
                            }else{

                                $respuesta=[
                                    "codigo"=>0,
                                    "mensaje"=>"Ocurrió un error al subir el archivo <br><strong>".$campo["nombre"]."</strong><br>".$retorno_documento["mensaje"].$_SERVER['CONTENT_LENGTH']
                                ];
                                $this->Formulario_model->delete_ingreso($id_ingreso);
                                $this->Formulario_model->delete_campos_ingreso($id_ingreso);
                                echo json_encode($respuesta);
                                die();

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
                    if ($valor == null) {

                    }else{
                        $this->Formulario_model->update_valor($id_ingreso,$campo["id"],null,$valor);
                    }
                }
            }
            $this->Formulario_model->historial_ingreso($id_ingreso);
            $respuesta["codigo"]=1;
            $respuesta["mensaje"]="Formulario actualizado con éxito";
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
function exportar_()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $formulario=$this->Formulario_model->get($this->input->post('formulario'));
    $secciones=$this->Formulario_model->get_seccion(null,$this->input->post('formulario'));

    $letra = 1;
    $fila = 1;
    $inicio_seccion = 1;
    $fin_seccion = "";
    $lista_campos = [];
    foreach ($secciones as $keys => $s) {
        if ($keys!=0) {
            $fin_seccion = $letra;
        }
        if ($fin_seccion != "" && $inicio_seccion != "" && $fin_seccion>$inicio_seccion) {
            $spreadsheet->getActiveSheet()->mergeCells($this->letra($inicio_seccion)."1:".$this->letra($fin_seccion-1)."1");
            $inicio_seccion = $letra;
            $fin_seccion = "";
        }
        $campos=$this->Formulario_model->get_campos(null,$s["id"], null, true);
        $sheet->setCellValue($this->letra($letra)."1", $s["nombre"]);
        foreach ($campos as $c) {
            array_push($lista_campos, $c);
            $sheet->setCellValue($this->letra($letra)."2", $c["nombre"]);
            $letra++;
        }
    }


    $this->load->model('Ingreso_model');
    $ingresos = $this->Ingreso_model->get(null, $this->input->post('formulario'));
    $fila = 3;
    foreach ($ingresos as $ingreso) {
        $letra = 1;
        foreach ($lista_campos as $lc) {
            $valor = $this->Ingreso_model->get_campo($ingreso["id"], $lc["id"]);
            if ($lc["tipo_id"] == 3) {
                if ($valor["valor"] != "") {
                    $sheet->setCellValue($this->letra($letra).$fila, base_url().'uploads/archivo/'.$valor["valor"]);
                }
            }else{
                $sheet->setCellValue($this->letra($letra).$fila, $valor["valor"]);
            }
            $letra++;
        }
        $fila++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="file.xlsx"');
    $writer->save("php://output");
}
function letra($index)
{
    return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
}
}
