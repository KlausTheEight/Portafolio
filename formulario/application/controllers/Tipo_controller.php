<?php
class Tipo_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 $this->session->set_flashdata("active", "tipo");
        $this->load->model('Tipo_model');
    }


    public function view_add(){
        $data["pagina"]="Nuevo registro tipo";
  
            $this->load->view("tipo_view/add",$data);

    }

    public function view_update($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro tipo";
        $data["object"]=$this->Tipo_model->get($id);
        $this->load->view("tipo_view/update",$data);
    }
    public function ajax_get($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro tipo";
        $data["object"]=$this->Tipo_model->get($id);
       echo json_encode($data["object"]);
    }

    public function index(){
        $data["datos"]=$this->Tipo_model->get();
        $data["pagina"]="Listar registros de tipo";
       $this->load->view("tipo_view/datatables",$data);

    }
    public function update(){
        $id=$this->input->post("id");
        $object=[];
            $tipo=trim($this->input->post("tipo"));
            $object["tipo"]=$tipo;
            
            $type=trim($this->input->post("type"));
            $object["type"]=$type;
            
            $html_envoltorio=trim($this->input->post("html_envoltorio"));
            $object["html_envoltorio"]=$html_envoltorio;
            
            $html_opcion=trim($this->input->post("html_opcion"));
            $object["html_opcion"]=$html_opcion;
            

        $this->Tipo_model->update($id,$object);

        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("tipo_controller/view_update/".$id,"refresh");
    }

    public function add(){

        $object=[];
            $tipo=trim($this->input->post("tipo"));
            $object["tipo"]=$tipo;
            
            $type=trim($this->input->post("type"));
            $object["type"]=$type;
            
            $html_envoltorio=trim($this->input->post("html_envoltorio"));
            $object["html_envoltorio"]=$html_envoltorio;
            
            $html_opcion=trim($this->input->post("html_opcion"));
            $object["html_opcion"]=$html_opcion;
            
        $this->Tipo_model->add($object);
        $this->session->set_flashdata("exito","Registro creado exitosamente");
        redirect("tipo_controller","refresh");
    }
    public function delete($id){
        $this->Tipo_model->delete($id);
        $this->session->set_flashdata("exito","Registro eliminado exitosamente");
        redirect("tipo_controller","refresh");
    }
public function ajax_listar(){

                $query_resultado = $this->Tipo_model->make_datatables();
                $data = array();
                foreach($query_resultado as $row)
                {
                    $sub_array = array();
                    $sub_array[] = $row->tipo;$sub_array[] = $row->type;$sub_array[] = $row->html_envoltorio;$sub_array[] = $row->html_opcion;
                    $sub_array[] = '<a href="'.base_url().'tipo_controller/view_update/'.$row->id.'"><i class="fas fa-pencil-alt text-info"></i></a>
                    <a class="ml-3" href="'.base_url().'tipo_controller/delete/'.$row->id.'"><i class="fas fa-times text-danger"></i></a>
                    ';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                =>     intval($_POST["draw"]),
                    "recordsTotal"        =>     $this->Tipo_model->get_all_data(),
                    "recordsFiltered"     =>     $this->Tipo_model->get_filtered_data(),
                    "data"                =>     $data
                );
                echo json_encode($output);
            }
}
