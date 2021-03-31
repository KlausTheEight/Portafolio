<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelo_modulos');
        is_admin();
    }

    public function index()
    {
        $tablas=$this->Modelo_modulos->tablas();
        $fin=[];
        foreach ($tablas as $x => $tabla) {
            $fields=$this->Modelo_modulos->fields($tabla);
            $temp_field=[];
            foreach ($fields as $f) {
                $temporales=[
                    "campo"=>$f->name,
                    "tipo"=>$f->type,
                    "max"=>$f->max_length,
                    "primary"=>$f->primary_key
                ];
                array_push($temp_field, $temporales);
            }
            $temp=[
                "tabla"=>$tabla,
                "campos"=>$temp_field
            ];
            array_push($fin, $temp);

        }
        $data["tablas"]=$fin;
        $data["pagina"]="Módulos";
        
        #$content=$this->load->view('modulos/nuevo', $data, TRUE);
        #$data["custom_js"]=$this->load->view('modulos/custom_js',null,TRUE);
        #$data["content"]=$content;
        $this->load->view('modulos/nuevo', $data);
    }

    public function add(){
        $this->load->helper('file');

        $radios = $this->input->post('radio_tipo');
        $select_texto = $this->input->post('select_tipo');
        $tabla=$this->input->post('tabla');

        $controller_add="";
        $view_input="";
        $view_input_update='<input type="hidden" name="id" value="<?=$object["id"]?>">';
        $controller_add_input='$object=[];';
        $thead="";
        $lista="?><tr>";
        $tablas_selectivas = [];
        $campos=[];
        foreach ($radios as $rkey => $radio) {
            $result = explode(",", $radios[$rkey]);
            $nombre_campo = $result[0];
            $tipo = $result[1];
            $label = $this->input->post('label['.$rkey.']');
            array_push($campos,$nombre_campo);
            $controller_add_input=$controller_add_input.'
            $'.$nombre_campo.'=trim($this->input->post("'.$nombre_campo.'"));
            $object["'.$nombre_campo.'"]=$'.$nombre_campo.';
            ';

            $update_add_input='$id=$this->input->post("id");';
            $lista=$lista.'
            <td><?=$dato["'.$nombre_campo.'"]?></td>
            ';
            $thead=$thead."<th>".$nombre_campo."</th>";
            switch ($tipo) {
                case 'texto':

                    $tipo_texto=$select_texto[$rkey];
                   
                    $view_input=$view_input.'
                    <div class="form-group">
                    <label class="form-control-label">'.$label.'</label>
                    <input required class="form-control" name="'.$nombre_campo.'" type="'.$tipo_texto.'">
                    </div>
                    ';
                    $view_input_update=$view_input_update.'
                    <div class="form-group">
                    <label class="form-control-label">'.$label.'</label>
                    <input required class="form-control" name="'.$nombre_campo.'" type="'.$tipo_texto.'" value="<?=$object["'.$nombre_campo.'"]?>">
                    </div>
                    ';

                break;

                case 'checkbox':

                    $view_input=$view_input.'
                    <div class="form-group">
                    <label class="form-control-label">Activar '.$label.'</label>
                    <input  name="'.$nombre_campo.'" type="hidden" value="0">
                    <input  name="'.$nombre_campo.'" type="checkbox" value="1">
                    
                    </div>
                    ';
                    $view_input_update=$view_input_update.'
                    <div class="form-group">
                    <label class="form-control-label">Activar '.$label.'</label>
                    <input name="'.$nombre_campo.'" type="hidden" value="0">
                    <input name="'.$nombre_campo.'" type="checkbox" <?php if($object["'.$nombre_campo.'"]==1){ echo "checked";} ?> value="1">
                    </div>
                    ';

                   

                break;

                case 'textarea':
                $view_input=$view_input.'
                <div class="form-group">
                <label class="form-control-label">'.$label.'</label>
                <textarea required class="form-control" name="'.$nombre_campo.'"></textarea>
                </div>';
                $view_input_update=$view_input_update.'
                <div class="form-group">
                <label class="form-control-label">'.$label.'</label>
                <textarea required class="form-control" name="'.$nombre_campo.'"><?=$object["'.$nombre_campo.'"]?></textarea>
                </div>';
                break;

               

                case 'select':
                $tabla_selectiva = $this->input->post('selectiva['.$rkey.']');
                array_push($tablas_selectivas, $tabla_selectiva);
                $view_input=$view_input.'
                <div class="form-group">
                <label class="form-control-label">'.$label.'</label>
                <select required class="form-control" name="'.$nombre_campo.'">
                <?php foreach($lista_'.$tabla_selectiva.' as $option){
                    ?>
                    <option value="<?php echo $option["id"] ?>"><?php echo $option["nombre"] ?></option>
                    <?php
                    } ?>
                    </select>
                    </div>
                    ';
                    $view_input_update=$view_input_update.'
                    <div class="form-group">
                    <label class="form-control-label">'.$label.'</label>
                    <select required class="form-control" name="'.$nombre_campo.'">
                    <?php foreach($lista_'.$tabla_selectiva.' as $option){
                        ?>
                        <option <?php echo $object["'.$nombre_campo.'"] == $option["id"] ? "selected" : "" ?> value="<?php echo $option["id"] ?>"><?php echo $option["nombre"] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </div>
                    ';
                    break;

                    default:
                    $view_input=$view_input.'
                    <div class="form-group">
                    <label class="form-control-label">'.$label.'</label>
                    <input required class="form-control" name="'.$nombre_campo.'" type="text">
                    </div>';
                    $view_input_update=$view_input_update.'
                    <div class="form-group">
                    <label class="form-control-label">'.$label.'</label>
                    <input required class="form-control" name="'.$nombre_campo.'" type="text" value="<?=$object["'.$nombre_campo.'"]?>">
                    </div>
                    ';
                    break;
                }

            }
            $thead=$thead."<th>Acciones</th>";
            $lista=$lista.'<td><a href="<?=base_url()?>'.$tabla.'_controller/view_update/<?=$dato["id"]?>" class="btn btn-warning btn-sm">Ver / modificar</a></td><td><a href="<?=base_url()?>'.$tabla.'_controller/delete/<?=$dato["id"]?>" class="btn btn-danger btn-sm">Eliminar</a></td></tr><?php '.PHP_EOL;

            $data_ingreso = [
                "tabla" => $tabla,
                "view_input" => $view_input,
            ];
            $view = $this->load->view('modulos/vista_ingreso', $data_ingreso, TRUE);
            $data_update = [
                "tabla" => $tabla,
                "view_input_update" => $view_input_update,
            ];
            $view_update = $this->load->view('modulos/vista_update', $data_update, TRUE);
            $data_lista = [
                "thead" => $thead,
                "lista" => $lista,
            ];
            $view_list = $this->load->view('modulos/vista_lista', $data_lista, TRUE);

            $data_lista2 = [
                "thead" => $thead,
                "tabla" => $tabla,
            ];
            $datatables = $this->load->view('modulos/datatables', $data_lista2, TRUE);

            $data_controller = [
                "tabla" => $tabla,
                "update_add_input" => $update_add_input,
                "controller_add_input" => $controller_add_input,
                "tablas_selectivas" => $tablas_selectivas,
                "campos"=>$campos
            ];
            $controller = $this->load->view('modulos/vista_controller', $data_controller, TRUE);
            $data_model = [
                "tabla" => $tabla,
            ];
            $model = $this->load->view('modulos/vista_model', $data_model, TRUE);

            write_file('./application/controllers/'.ucfirst($tabla).'_controller.php', utf8_decode($controller));
            if (!is_dir('application/views/'.$tabla.'_view')) {
                mkdir('./application/views/'.$tabla.'_view', 0777, TRUE);
            }
         /*   if (!is_dir('uploads/'.$tabla)) {
                mkdir('./uploads/'.$tabla, 0777, TRUE);
            } */
            write_file('./application/models/'.ucfirst($tabla).'_model.php', utf8_decode($model));
            write_file('./application/views/'.$tabla.'_view/add.php', utf8_decode($view));
            write_file('./application/views/'.$tabla.'_view/list.php', utf8_decode($view_list));
            write_file('./application/views/'.$tabla.'_view/datatables.php', utf8_decode($datatables));
            write_file('./application/views/'.$tabla.'_view/update.php', utf8_decode($view_update));
            $identificador=uniqid();
            $data_link = [
                "identificador" => $identificador,
                "tabla" => $tabla,
            ];
            $link = $this->load->view('modulos/vista_link', $data_link, TRUE);
            $objeto=["link"=>$link];
            $this->Modelo_modulos->add_link($objeto);
            $modulos=$this->Modelo_modulos->get_link();
            $this->session->set_userdata('modulos',$modulos);

            $this->session->set_flashdata('exito',"Módulo creado exitosamente");
            redirect('modulos/','refresh');

        }

        public function ajax_getCampos(){
            header("Access-Control-Allow-Origin: *");
            $this->load->model('Modelo_modulos');
            $tabla=$this->input->post('tabla');

            $fields=$this->Modelo_modulos->fields($tabla);
            $temp_field=[];
            foreach ($fields as $f) {
                $temporales=[
                    "campo"=>$f->name,
                    "tipo"=>$f->type,
                    "max"=>$f->max_length,
                    "primary"=>$f->primary_key
                ];
                array_push($temp_field, $temporales);
            }
            echo json_encode($temp_field);

        }

    }


?>