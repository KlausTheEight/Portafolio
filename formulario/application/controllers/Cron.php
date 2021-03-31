<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cron extends CI_Controller {
    
        public function index()
        {
            
        }

        public function actualizar_semana(){
            $this->load->model('Modelo_general');
            $semana_anterior=configuracion('SEMANA');
            $this->Modelo_general->update_configuracion('SEMANA',$semana_anterior+1);
            echo "Semana actualizada";
        }
    
    }
    
    /* End of file Cron.php */
    
?>