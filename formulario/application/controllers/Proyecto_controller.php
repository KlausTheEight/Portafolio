<?php
class Proyecto_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 $this->session->set_flashdata("active", "proyecto");
        $this->load->model('Proyecto_model');
    }


    public function view_add(){
        $data["pagina"]="Nuevo registro proyecto";
  
            $this->load->view("proyecto_view/add",$data);

    }

    public function view_update($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro proyecto";
        $data["object"]=$this->Proyecto_model->get($id);
        $this->load->view("proyecto_view/update",$data);
    }
    public function ajax_get($id=null){

        if($id==null){
            redirect("'.$tabla.'_controller","refresh");
        }

        $data["pagina"]="Modificar registro proyecto";
        $data["object"]=$this->Proyecto_model->get($id);
       echo json_encode($data["object"]);
    }

    public function index(){
        $data["datos"]=$this->Proyecto_model->get();
        $data["pagina"]="Listar registros de proyecto";
       $this->load->view("proyecto_view/datatables",$data);

    }
    public function update(){
        $id=$this->input->post("id");
        $object=[];
            $nombre=trim($this->input->post("nombre"));
            $object["nombre"]=$nombre;
            

        $this->Proyecto_model->update($id,$object);

        $this->session->set_flashdata("exito","Registro actualizado exitosamente");
        redirect("proyecto_controller/view_update/".$id,"refresh");
    }

    public function add(){

        $object=[];
            $nombre=trim($this->input->post("nombre"));
            $object["nombre"]=$nombre;
            
        $this->Proyecto_model->add($object);
        $this->session->set_flashdata("exito","Registro creado exitosamente");
        redirect("proyecto_controller","refresh");
    }
    public function delete($id){
        $this->Proyecto_model->delete($id);
        $this->session->set_flashdata("exito","Registro eliminado exitosamente");
        redirect("proyecto_controller","refresh");
    }
public function ajax_listar(){

                $query_resultado = $this->Proyecto_model->make_datatables();
                $data = array();
                foreach($query_resultado as $row)
                {
                    $sub_array = array();
                    $sub_array[] = $row->nombre;
                    $sub_array[] = '<a href="'.base_url().'proyecto_controller/view_update/'.$row->id.'"><i class="fas fa-pencil-alt text-info"></i></a>
                    <a class="ml-3" href="'.base_url().'proyecto_controller/delete/'.$row->id.'"><i class="fas fa-times text-danger"></i></a>
                    ';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                =>     intval($_POST["draw"]),
                    "recordsTotal"        =>     $this->Proyecto_model->get_all_data(),
                    "recordsFiltered"     =>     $this->Proyecto_model->get_filtered_data(),
                    "data"                =>     $data
                );
                echo json_encode($output);
            }
}
