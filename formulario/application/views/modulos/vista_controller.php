<?php
echo '<?php'.PHP_EOL ;
echo 'class '.ucfirst($tabla).'_controller extends CI_Controller {'.PHP_EOL ;
echo '    public function __construct()'.PHP_EOL ;
echo '    {'.PHP_EOL ;
echo '        parent::__construct();'.PHP_EOL ;
echo ' $this->session->set_flashdata("active", "'.$tabla.'");'.PHP_EOL;
echo '        $this->load->model(\''.ucfirst($tabla).'_model\');'.PHP_EOL ;
echo '    }'.PHP_EOL ;


echo ''.PHP_EOL ;
echo ''.PHP_EOL ;
echo '    public function view_add(){'.PHP_EOL ;
echo '        $data["pagina"]="Nuevo registro '.$tabla.'";'.PHP_EOL ;
foreach ($tablas_selectivas as $t) {
    echo '$this->load->model(\''.ucfirst($t).'_model\');'.PHP_EOL ;

    echo ' $data["lista_'.$t.'"]=$this->'.ucfirst($t).'_model->get();'.PHP_EOL ;
}

echo '  
            $this->load->view("'.$tabla.'_view/add",$data);
'.PHP_EOL;
echo '    }'.PHP_EOL ;
echo ''.PHP_EOL ;


echo '    public function view_update($id=null){'.PHP_EOL ;
echo '
        if($id==null){
            redirect("\'.$tabla.\'_controller","refresh");
        }
'.PHP_EOL;
echo '        $data["pagina"]="Modificar registro '.$tabla.'";'.PHP_EOL ;
echo '        $data["object"]=$this->'.ucfirst($tabla).'_model->get($id);'.PHP_EOL ;
foreach ($tablas_selectivas as $t) {
    echo '$this->load->model(\''.ucfirst($t).'_model\');'.PHP_EOL ;
    echo ' $data["lista_'.$t.'"]=$this->'.ucfirst($t).'_model->get();'.PHP_EOL ;
}
echo '        $this->load->view("'.$tabla.'_view/update",$data);'.PHP_EOL ;
echo '    }'.PHP_EOL ;
#------------
echo '    public function ajax_get($id=null){'.PHP_EOL ;
echo '
        if($id==null){
            redirect("\'.$tabla.\'_controller","refresh");
        }
'.PHP_EOL;
echo '        $data["pagina"]="Modificar registro '.$tabla.'";'.PHP_EOL ;
echo '        $data["object"]=$this->'.ucfirst($tabla).'_model->get($id);'.PHP_EOL ;
foreach ($tablas_selectivas as $t) {
    echo '$this->load->model(\''.ucfirst($t).'_model\');'.PHP_EOL ;
    echo ' $data["lista_'.$t.'"]=$this->'.ucfirst($t).'_model->get();'.PHP_EOL ;
}
echo '       echo json_encode($data["object"]);'.PHP_EOL ;
echo '    }'.PHP_EOL ;
#-------------
echo ''.PHP_EOL ;
echo '    public function index(){'.PHP_EOL ;
echo '        $data["datos"]=$this->'.ucfirst($tabla).'_model->get();'.PHP_EOL ;
echo '        $data["pagina"]="Listar registros de '.$tabla.'";'.PHP_EOL ;
echo '       $this->load->view("'.$tabla.'_view/datatables",$data);'.PHP_EOL ;
echo ''.PHP_EOL ;
echo '    }'.PHP_EOL ;
echo '    public function update(){'.PHP_EOL ;
echo '        '.$update_add_input.''.PHP_EOL ;
echo '        '.$controller_add_input.''.PHP_EOL ;
echo ''.PHP_EOL ;
echo '        $this->'.ucfirst($tabla).'_model->update($id,$object);'.PHP_EOL ;
echo ''.PHP_EOL ;
echo '        $this->session->set_flashdata("exito","Registro actualizado exitosamente");'.PHP_EOL ;
echo '        redirect("'.$tabla.'_controller/view_update/".$id,"refresh");'.PHP_EOL ;
echo '    }'.PHP_EOL ;
echo ''.PHP_EOL ;
echo '    public function add(){'.PHP_EOL ;
echo ''.PHP_EOL ;
echo '        '.$controller_add_input.''.PHP_EOL ;
echo '        $this->'.ucfirst($tabla).'_model->add($object);'.PHP_EOL ;
echo '        $this->session->set_flashdata("exito","Registro creado exitosamente");'.PHP_EOL ;
echo '        redirect("'.$tabla.'_controller","refresh");'.PHP_EOL ;
echo '    }'.PHP_EOL ;
echo '    public function delete($id){'.PHP_EOL ;
echo '        $this->'.ucfirst($tabla).'_model->delete($id);'.PHP_EOL ;
echo '        $this->session->set_flashdata("exito","Registro eliminado exitosamente");'.PHP_EOL ;
echo '        redirect("'.$tabla.'_controller","refresh");'.PHP_EOL ;
echo '    }'.PHP_EOL ;

$arrays='';
foreach ($campos as $campo) {
    $arrays.='$sub_array[] = $row->'.$campo.';';
}

$datatables='public function ajax_listar(){

                $query_resultado = $this->'.ucfirst($tabla).'_model->make_datatables();
                $data = array();
                foreach($query_resultado as $row)
                {
                    $sub_array = array();
                    '.$arrays.'
                    $sub_array[] = \'<a href="\'.base_url().\''.$tabla.'_controller/view_update/\'.$row->id.\'"><i class="fas fa-pencil-alt text-info"></i></a>
                    <a class="ml-3" href="\'.base_url().\''.$tabla.'_controller/delete/\'.$row->id.\'"><i class="fas fa-times text-danger"></i></a>
                    \';
                    $data[] = $sub_array;
                }
                $output = array(
                    "draw"                =>     intval($_POST["draw"]),
                    "recordsTotal"        =>     $this->'.ucfirst($tabla).'_model->get_all_data(),
                    "recordsFiltered"     =>     $this->'.ucfirst($tabla).'_model->get_filtered_data(),
                    "data"                =>     $data
                );
                echo json_encode($output);
            }';
echo $datatables.PHP_EOL ;
echo '}'.PHP_EOL ;


