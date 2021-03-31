<?php
class Proyecto_model extends CI_Model {
    public function add($object){
        $this->db->insert('proyecto', $object);
    }
    public function delete($id=null){
        $this->db->where('id', $id);
        $this->db->delete('proyecto');
    }
    public function update($id=null,$object){
        $this->db->where('id', $id);
        $this->db->update('proyecto', $object);
    }
    public function get($id=null){
        $this->db->select('*');
        if($id!=null){
            $this->db->where('id', $id);
            return $this->db->get('proyecto')->row_array();
        }
        return $this->db->get('proyecto')->result_array();
    }

var $order_column = array();  

function make_query()  
    {
        $this->db->select('*');  

        $this->db->from('proyecto');
        
        #BUSQUEDA
        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)  
        {  
            $search_string=$_POST["search"]["value"];
            $this->db->where("(proyecto.nombre LIKE '%".$search_string."%' 
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
        $this->db->from('proyecto');  
        return $this->db->count_all_results();  
    }    

}
