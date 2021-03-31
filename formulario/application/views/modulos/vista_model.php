<?php
echo '<?php'.PHP_EOL;
echo 'class '.ucfirst($tabla).'_model extends CI_Model {'.PHP_EOL;


echo '    public function add($object){'.PHP_EOL;
echo '        $this->db->insert(\''.$tabla.'\', $object);'.PHP_EOL;
echo '    }'.PHP_EOL;

echo '    public function delete($id=null){'.PHP_EOL;
echo '        $this->db->where(\'id\', $id);'.PHP_EOL;
echo '        $this->db->delete(\''.$tabla.'\');'.PHP_EOL;
echo '    }'.PHP_EOL;

echo '    public function update($id=null,$object){'.PHP_EOL;
echo '        $this->db->where(\'id\', $id);'.PHP_EOL;
echo '        $this->db->update(\''.$tabla.'\', $object);'.PHP_EOL;
echo '    }'.PHP_EOL;

echo '    public function get($id=null){'.PHP_EOL;
echo '        $this->db->select(\'*\');'.PHP_EOL;
echo '        if($id!=null){'.PHP_EOL;
echo '            $this->db->where(\'id\', $id);'.PHP_EOL;
echo '            return $this->db->get(\''.$tabla.'\')->row_array();'.PHP_EOL;
echo '        }'.PHP_EOL;
echo '        return $this->db->get(\''.$tabla.'\')->result_array();'.PHP_EOL;
echo '    }'.PHP_EOL;


$datatables='
var $order_column = array();  

function make_query()  
    {
        $this->db->select(\'*\');  

        $this->db->from(\''.$tabla.'\');
        
        #BUSQUEDA
        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)  
        {  
            $search_string=$_POST["search"]["value"];
            $this->db->where("('.$tabla.'.nombre LIKE \'%".$search_string."%\' 
            )", NULL, FALSE);   
        }  
        #ORDEN
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST[\'order\'][\'0\'][\'column\']], $_POST[\'order\'][\'0\'][\'dir\']);  
        }  
      
    
    }  
    #CONSTRUIR LA CONSULTA // ESTE MÉTODO SE LLAMA DIRECTO DEL CONTROLADOR
    function make_datatables(){  
        $this->make_query();  
        if($_POST["length"] != -1)  
        {  
            $this->db->limit($_POST[\'length\'], $_POST[\'start\']);  
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
        $this->db->from(\''.$tabla.'\');  
        return $this->db->count_all_results();  
    }    
';

echo $datatables.PHP_EOL;
echo '}'.PHP_EOL;
