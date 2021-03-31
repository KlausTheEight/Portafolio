<?php
class Usuario_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Modelo_usuarios');
        is_admin();
        $this->session->set_flashdata('active', 'usuarios');
    }



    public function view_add(){

        $this->load->model('Perfil_model');
        $data["lista_perfil"]=$this->Perfil_model->get();
        $this->load->view("usuario_view/add",$data);
    }

    public function cargamasiva(){
        #$this->session->set_flashdata("info","ok");
        #$this->output->enable_profiler(TRUE);
        
        if ($this->input->post()!=null) {

            $idd=uniqid();
            $config['upload_path']          = './uploads/csv';
            $config['allowed_types']        = 'csv';
            $config['file_name']             = $idd;
            $mensaje='';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('csv'))
            {
            
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata("error","No se pudo subir el archivo. ".$error);
                    redirect('usuario_controller','refresh');
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $nombre=$data["upload_data"]["file_name"];
                
                    $csv = array_map('utf8_encode', file('./uploads/csv/'.$nombre));
                    array_shift($csv); 

                    foreach ($csv as $key => $item) {

                        $row=explode(';',$item);
                        $nombre=trim($row[0]);
                        $email=trim($row[1]);

                        $u=$this->Usuario_model->get(null,$email);
                     
                        if ($u!=null) {
                           $mensaje.='-Usuario <strong>'.$email.'</strong> ya se encuentra registrado y no fue ingresado <br>';
                        }else{
                            $usuario=null;
                          
                            $usuario["nombre"]=$nombre;
                    
                            $usuario["email"]=$email;
                    
                            $password=$this->input->post("password");
                            $usuario["password"]=sha1($password);
                    
                            $perfil_id=trim($this->input->post("perfil_id"));
                            $usuario["perfil_id"]=$perfil_id;

                            $etiqueta=trim($this->input->post("etiqueta"));
                            $usuario["etiqueta"]=$etiqueta;
                    
                           
                            
                            $usuario["csv"]=$idd;

                            $status=trim($this->input->post("estado"));
                            if ($status==1) {
                                $usuario["status"]=1;
                            }else{
                                $usuario["status"]=0;
                            }
                    
                    
                            $usuario_id=$this->Usuario_model->add($usuario);
                          
                            

                            $mailing=trim($this->input->post("mailing"));
                            if ($mailing==1) {
                               #ENVIAR CORREO AL USUARIO
                               $u=$this->Usuario_model->get($usuario_id,null);
                               $u["password_text"]=$this->input->post('password');
                               $this->correo($u);
                            }
                    
                        }

                    } 
                    if ($mensaje!='') {
                        $this->session->set_flashdata("info","Aviso <br>".$mensaje);
                    }
                    $this->session->set_flashdata("exito","Usuarios creados correctamente");
                    redirect('usuario_controller','refresh');
                    

            }
            
        }else{
            $this->load->model('Perfil_model');
            $data["lista_perfil"]=$this->Perfil_model->get();
            $this->load->view("usuario_view/cargamasiva",$data);
        }
       
    }

    public function view_update($id=null){
        if($id==null){
            redirect("usuario_controller","refresh");
        }


        $this->load->model('Perfil_model');
        $data["lista_perfil"]=$this->Perfil_model->get();
        $data["usuario"]=$this->Usuario_model->get($id);
        $this->load->view('usuario_view/update',$data);
    }

    public function correo($usuario=null){
        $data["usuario"]=$usuario;
       
        $para=$usuario["email"];


        $config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp-relay.gmail.com';
		$config['smtp_user'] = 'no-reply@penalolen.cl';
		#$config['smtp_pass'] = '';
		$config['smtp_port'] = 465;

		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = "\r\n";
		$this->email->initialize($config);

        $template=$this->load->view('email/correo_usuario',$data,TRUE);
        $this->email->from('no-reply@penalolen.cl', 'Permisos de circulación masivos');
        $this->email->subject('SE HA CREADO TU CUENTA');
        $this->email->to($para);
        $this->email->message($template);
		$this->email->send();
    }

    public function index(){
        $data["datos"]=$this->Usuario_model->get();

        $this->load->view('usuario_view/list',$data);
    }
    public function update($id=null){
        

        $object=[];
        $nombre=trim($this->input->post("nombre"));
        $object["nombre"]=$nombre;

        $email=trim($this->input->post("email"));
        $object["email"]=$email;

        $etiqueta=trim($this->input->post("etiqueta"));
        $object["etiqueta"]=$etiqueta;

        $permiso_ingresar_solicitud=trim($this->input->post("permiso_ingresar_solicitud"));
        $object["permiso_ingresar_solicitud"]=$permiso_ingresar_solicitud;

        $permiso_buscar_solicitud=trim($this->input->post("permiso_buscar_solicitud"));
        $object["permiso_buscar_solicitud"]=$permiso_buscar_solicitud;

        $permiso_reportes=trim($this->input->post("permiso_reportes"));
        $object["permiso_reportes"]=$permiso_reportes;

        $permiso_derivar_solicitud=trim($this->input->post("permiso_derivar_solicitud"));
        $object["permiso_derivar_solicitud"]=$permiso_derivar_solicitud;

        $password=$this->input->post("password");
        if ($password!=null) {
            $object["password"]=sha1($password);
        }

        $perfil_id=trim($this->input->post("perfil_id"));
        $object["perfil_id"]=$perfil_id;

        $status=trim($this->input->post("estado"));
        if ($status==1) {
            $object["status"]=1;
        }else{
            $object["status"]=0;
        }

        $this->Usuario_model->update($id,$object);
      
        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("usuario_controller","refresh");
    }

    public function add(){
        $object=[];
        $nombre=trim($this->input->post("nombre"));
        $object["nombre"]=$nombre;

        $email=trim($this->input->post("email"));
        $object["email"]=$email;

        $password=$this->input->post("password");
        $object["password"]=sha1($password);

        $perfil_id=trim($this->input->post("perfil_id"));
        $object["perfil_id"]=$perfil_id;

        $etiqueta=trim($this->input->post("etiqueta"));
        $object["etiqueta"]=$etiqueta;


        $status=trim($this->input->post("estado"));
        if ($status==1) {
            $object["status"]=1;
        }else{
            $object["status"]=0;
        }


        $u=$this->Usuario_model->get(null,$email);
        if ($u!=null) {
            $this->session->set_flashdata("error","El correo ingresado ya existe");
            redirect("usuario_controller/view_add","refresh");
            die();
        }
        $usuario_id=$this->Usuario_model->add($object);
      

        $this->session->set_flashdata("exito","Registro creado exitosamente");
        redirect("usuario_controller","refresh");
    }
    public function delete($id){
        $this->Usuario_model->delete($id);
        $this->session->set_flashdata("exito","Registro eliminado exitosamente");
        redirect("usuario_controller","refresh");
    }

    public function ajax_usuarios(){
        $query_resultado = $this->Modelo_usuarios->make_datatables();
        $data = array();
        foreach($query_resultado as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->nombre;
            $sub_array[] = $row->email;
            $sub_array[] = '<span class="badge badge-pill badge-info">'.$row->etiqueta.'</span>';
            $sub_array[] = $row->perfil;
            if ($row->status==1) {
                $sub_array[]='<span class="badge badge-dot mr-4">
                <i class="bg-success"></i>
                <span class="status">Activo</span>
                </span>';
            }else{
                $sub_array[]='<span class="badge badge-dot mr-4">
                <i class="bg-danger"></i>
                <span class="status">Inactivo</span>
                </span>';
            }
            $sub_array[] = '-';
            $sub_array[] = '<a href="'.base_url().'usuario_controller/view_update/'.$row->id.'"><i class="fas fa-pencil-alt"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->Modelo_usuarios->get_all_data(),
            "recordsFiltered"     =>     $this->Modelo_usuarios->get_filtered_data(),
            "data"                =>     $data
        );
        echo json_encode($output);
    }

    public function detalle($id=null){
        if ($id==null) {
            die();
        }
        $data["usuario"]=$this->Modelo_usuarios->user($id);
        if ($data["usuario"]==null) {
            $this->session->set_flashdata('error', '☻?');
            redirect('usuario_controller/usuariosapp','refresh');
        }
        $data["pagina"]="Detalle de usuario";
        $content=$this->load->view("usuario_view/detalles",$data,TRUE);
        $data["custom_js"]="";
        $data["content"]=$content;
        $this->load->view('layout',$data);
    }

    function cambio_contrasena()
    {
       $a_contrasena = $this->input->post('a_contrasena');
       $n_contrasena = $this->input->post('n_contrasena');
       $z_contrasena = $this->input->post('z_contrasena');
       if ($n_contrasena != $z_contrasena) {
           $this->session->set_flashdata("error","Las contraseñas nuevas no coinciden");
       }
       elseif (sha1($a_contrasena) != $this->session->userdata('usuario')["password"]) {
           $this->session->set_flashdata("error","La contraseñaa actual no es correcta");
       }else{
        $this->Usuario_model->update($this->session->userdata('usuario')["id"],["password" => sha1($n_contrasena)]);
            $usuario = $this->session->userdata('usuario');
            $usuario["password"] = sha1($n_contrasena);
            $this->session->set_userdata('usuario', $usuario);
           $this->session->set_flashdata("exito","Contraseña actualizada");
       }
       redirect('Home','refresh');
   }

  
}
