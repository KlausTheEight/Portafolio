<?php
class Tipo_model extends CI_Model {
    public function add($object){
        $this->db->insert('tipo', $object);
    }
    public function delete($id=null){
        $this->db->where('id', $id);
        $this->db->delete('tipo');
    }
    public function update($id=null,$object){
        $this->db->where('id', $id);
        $this->db->update('tipo', $object);
    }
    public function get($id=null){
        $this->db->select('*');
        if($id!=null){
            $this->db->where('id', $id);
            return $this->db->get('tipo')->row_array();
        }
        return $this->db->get('tipo')->result_array();
    }

var $order_column = array();  

function make_query()  
    {
        $this->db->select('*');  

        $this->db->from('tipo');
        
        #BUSQUEDA
        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)  
        {  
            $search_string=$_POST["search"]["value"];
            $this->db->where("(tipo.nombre LIKE '%".$search_string."%' 
            )", NULL, FALSE);   
        }  
        #ORDEN
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
      
    
    }  
    #CONSTRUIR LA CONSULTA // ESTE MÉTODO SE LLAMA DIRECTO DEL CONTROLADOR
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
        $this->db->from('tipo');  
        return $this->db->count_all_results();  
    }    

}
