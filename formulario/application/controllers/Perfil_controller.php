<?php
class Perfil_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perfil_model');
        is_admin();
    }


    public function view_add(){
        $data["pagina"]="Nuevo registro perfil";
        $content=$this->load->view("perfil_view/add",$data,TRUE);

            $data["custom_js"]="";
            $data["content"]=$content;
            $this->load->view('layout',$data);

    }

    public function view_update($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro perfil";
        $data["object"]=$this->Perfil_model->get($id);
        $content=$this->load->view("perfil_view/update",$data,TRUE);

            $data["custom_js"]="";
            $data["content"]=$content;
            $this->load->view('layout',$data);

    }

    public function index(){
        $data["datos"]=$this->Perfil_model->get();
        $data["pagina"]="Listar registros de perfil";
       $content= $this->load->view("perfil_view/list",$data,TRUE);

            $data["custom_js"]="";
            $data["content"]=$content;
            $this->load->view('layout',$data);


    }
    public function update(){
        $ID=$this->input->post("id");
        $object=[];
            $nombre=trim($this->input->post("nombre"));
            $object["nombre"]=$nombre;
            

        $this->Perfil_model->update($id,$object);

        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("perfil_controller/view_update/".$id,"refresh");
    }

    public function add(){

        $object=[];
            $nombre=trim($this->input->post("nombre"));
            $object["nombre"]=$nombre;
            
        $this->Perfil_model->add($object);
        $this->session->set_flashdata("exito","Registro creado exitosamente");
        redirect("perfil_controller","refresh");
    }
    public function delete($id){
        $this->Perfil_model->delete($id);
        $this->session->set_flashdata("exito","Registro eliminado exitosamente");
        redirect("perfil_controller","refresh");
    }
}
