<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends CI_Controller {


        public function __construct()
        {
            parent::__construct();
            $this->load->helper('api');
            $this->load->model('Usuario_model');
        }

        public function index()
        {
            if (is_login(1)) {
                redirect('home','refresh');
                die();
            }
            $this->load->view('auth/login');
        }

        public function logout(){
            $this->session->unset_userdata('usuario');
            redirect('auth/index','refresh');
        }
        
        public function logueado(){
            if ($this->session->userdata('usuario')!=null) {
                echo "true";
                die();
            }else{
                echo "false";
                die();
            }
        }

        public function generar(){
            
            if ($this->input->post()==null) {
                echo "false";
                die();
            }
            $usuario_id=$this->input->post('usuario_id');
            $token=$this->input->post('token');

            $usuario=$this->Usuario_model->get($usuario_id,null);
            if ($usuario!=null && $token=='789542212aA34gbr') {
                $this->session->set_userdata('usuario',$usuario);
                echo "true";
            }else{
                echo "false";
                die();
            }
           
            
        }

        public function login(){
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            if ($email==null || $password==null) {
                $this->session->set_flashdata('error','Credenciales ingresadas incorrectas');
                redirect('auth/index','refresh');
            }
            $result=$this->Usuario_model->login($email,$password);
            if ($result) {
                if ($this->session->userdata('volver') != null) {
                    redirect($this->session->userdata('volver'),'refresh');
                }else{
                    redirect('home','refresh');
                }

            }else{
                $this->session->set_flashdata('error','Credenciales ingresadas incorrectas');
                redirect('auth/index','refresh');
            }


        }

    }

    /* End of file Login.php */

?>