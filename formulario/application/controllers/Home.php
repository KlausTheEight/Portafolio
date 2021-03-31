<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->session->set_flashdata('active', 'inicio');
    }


    public function index()
    {
        $this->load->model('Proyecto_model');
        $this->load->model('Formulario_model');

        $data["proyectos"]=$this->Proyecto_model->get();
        foreach ($data["proyectos"] as $key => $proyecto) {
            $data["proyectos"][$key]["formularios"]=$this->Formulario_model->get_formularios($proyecto["id"]);
            foreach ($data["proyectos"][$key]["formularios"] as $fkey => $f) {
                $data["proyectos"][$key]["formularios"][$fkey]["total"] = $this->Formulario_model->get_total_registros($f["id"]);
            }
        }
        $this->load->view('home/index',$data);
    }


}
?>