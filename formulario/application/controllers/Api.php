<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api_helper');
        $this->load->model('Modelo_vecino');

    }

    public function buscar_vecinos_get(){
        if (is_login(true)) {
            $rut=$this->input->get('rut');
            if($rut==null){
                echo json_encode([]);
                die();
            }
            $rut=str_replace('.','',$rut);
            $resultado=$this->Modelo_vecino->buscar($rut);
            echo json_encode($resultado);
            die();
        }else{
            echo "false";
            die();
        }
    }

    public function buscar_solicitudes_get()
    {
        if (is_login(true)) {
            $this->load->model('Modelo_solicitud');
            $rut=$this->input->get('rut');
            $rut=str_replace('.','',$rut);
            $nombre = $this->input->get('nombre');
            $id=$this->input->get('id');
            $macro_sector = $this->input->get('macro_sector');
            $direccion = $this->input->get('direccion');
            $resultado=$this->Modelo_solicitud->buscar($id,$rut, $nombre, $direccion, $macro_sector);
            echo json_encode($resultado);
            die();
        }else{
            echo "false";
            die();
        }
    }

}



?>