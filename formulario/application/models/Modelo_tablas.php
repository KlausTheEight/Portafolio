<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Modelo_tablas extends CI_Model {
    
        public function get_datos($formulario_id,$filtro=null){
            $this->db->select('ingreso.*,
            GROUP_CONCAT(valor.valor SEPARATOR ";") as "valores",
            GROUP_CONCAT(campo.nombre SEPARATOR ";") as "campos",
            campo.nombre as "nombre",
            ');
            $this->db->join('valor', 'valor.ingreso_id = ingreso.id', 'left');
            $this->db->join('campo', 'valor.campo_id = campo.id', 'left');
            $this->db->where('formulario_id', $formulario_id);
            if ($filtro!=null) {
                $this->db->like('valor.valor', $filtro);
            }
           
            $this->db->group_by('ingreso.id');
            
            return $this->db->get('ingreso')->result_array();
        }

        var $order_column = array();  


        function make_query()  
        {
            $this->db->select('ingreso.*,
            GROUP_CONCAT(valor.valor SEPARATOR ";") as "valores",
            GROUP_CONCAT(campo.nombre SEPARATOR ";") as "campos",
            campo.nombre as "nombre",
            coalesce(null,estado.nombre,"sin estado") as "estado",
            coalesce(null,estado.color,"#000") as "estado_color",
            coalesce(null,usuario.nombre,"Sin asignar") as "usuario_nombre",
            ');
            $this->db->join('valor', 'valor.ingreso_id = ingreso.id', 'left');
            $this->db->join('campo', 'valor.campo_id = campo.id', 'left');
            $this->db->join('estado', 'ingreso.estado_id = estado.id', 'left');
            $this->db->join('usuario', 'ingreso.usuario_id = usuario.id', 'left');
            $this->db->from('ingreso');
            $this->db->where('ingreso.formulario_id', $_POST["formulario_id"]);
            if ($this->session->userdata('usuario')["perfil_id"]==2) {
                $this->db->where('ingreso.usuario_id', $this->session->userdata('usuario')["id"]);
            }
            if(isset($_POST["estado_id"]) && $_POST["estado_id"]!=null)  
            {
                $this->db->where("ingreso.estado_id",$_POST["estado_id"]);   
            } 
            #BUSQUEDA
          
            if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)  
            {  
                $search_string=$_POST["search"]["value"];
                $this->db->where("(valor.valor LIKE '%".$search_string."%' 
                )", NULL, FALSE);   
            }  

            $this->db->group_by('ingreso.id');
            #ORDEN
            $this->db->order_by('ingreso.id', 'desc');
            
            if(isset($_POST["order"]))  
            {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
            }
        
        
        }  
        #CONSTRUIR LA CONSULTA // ESTE M�TODO SE LLAMA DIRECTO DEL CONTROLADOR
        function make_datatables(){  
            $this->make_query();  
            if($_POST["length"] != -1)  
            {  
                $this->db->limit($_POST['length'], $_POST['start']);  
            }  
            $query = $this->db->get();  
            return $query->result();  
        }  
        #OBTENER TOTAL DE REGISTROS FILTRADOS
        function get_filtered_data(){  
            $this->make_query();  
            $query = $this->db->get();  
            return $query->num_rows();  
        }
        #OBTENER TOTAL DE REGISTROS       
        function get_all_data()  
        {  
            $this->db->select("*");  
            $this->db->from('ingreso');  
            $this->db->where('formulario_id', $_POST["formulario_id"]);
            return $this->db->count_all_results();  
        }    
    
    }
    
    /* End of file Modelo_tablas.php */
    
?>