<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Modelo_modulos extends CI_Model {
    
        public function tablas(){
            $tables = $this->db->list_tables();
            return $tables;
        }
        public function fields($tabla){
            return $this->db->field_data($tabla);
        }
        public function add_link($link){
            $this->db->insert('link', $link);
            
        }
        public function get_link(){
            $this->db->select('*');
            return $this->db->get('link')->result_array();
            
        }
    }
    
    /* End of file Modelo_modulos.php */
    
?>