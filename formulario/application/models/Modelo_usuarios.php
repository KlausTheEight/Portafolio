<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Modelo_usuarios extends CI_Model {

        
        public function __construct()
        {
            parent::__construct();
        
        }
        
        public function get_2(){
            $this->db->select('*');
            $this->db->where('perfil_id', 2);
            return $this->db->get('usuario')->result_array();
        }

        public function login($email){
            $this->db->select('*');
            $this->db->where('email', $email);
            //$this->db->where('password', $password);
            $this->db->where('status', 1);
            return $this->db->get('usuario')->row_array();
        }

        public function get_user($email=null,$rut=null,$pasaporte=null){
            $this->db->select('*');
            $this->db->where('email', $email);
           /* if ($rut!=null) {
                $this->db->or_where('rut', $rut);
            }
            if ($pasaporte!=null) {
                $this->db->or_where('pasaporte', $pasaporte);
            } */
            return $this->db->get('usuario')->result_array();
        }

        public function get_userbyrut($rut){
            $this->db->select('*');
            $this->db->where('rut', $rut);
            return $this->db->get('usuario')->row_array();
        }

        public function user($id){
            $this->db->select('usuario.*');  
            $this->db->where('usuario.id', $id);
            return $this->db->get('usuario')->row_array();
        }

        public function verificar_uuid($uuid=null){
            $this->db->select('*');
            $this->db->where('uuid !=', $uuid);
            $result = $this->db->get('usuario')->row_array();
            if ($result!=null) {
                return true;
            }else{
                return false;
            }
        }

        public function verify_email($uuid=null,$email=null){
            
            $this->db->select('*');
            if ($uuid!=null) {
                $this->db->where('uuid !=', $uuid);
            }
            $this->db->where('email', $email);
            return $this->db->get('usuario')->row_array();
            
        }

        public function add_pwdreset($object){
            $this->db->insert('password_reset', $object);
        }
        public function update_pwdreset($id,$object){
            $this->db->where('id', $id);
            $this->db->update('password_reset', $object);
        }
        public function invalidate_pwdreset($id,$uuid){
            $this->db->where('id !=', $id);
            $this->db->where('usuario_uuid', $uuid);
            $this->db->update('password_reset',["status"=>0]);
        }
        public function get_pwdreset($code,$usuario_uuid){
            $this->db->select('*');
            $this->db->where('codigo', $code);
            $this->db->where('status', 1);
            $this->db->where('usuario_uuid', $usuario_uuid);
            return $this->db->get('password_reset')->row_array();
            
        }

        public function add($object){
            $this->db->insert('usuario', $object);
        }

        public function update($uuid,$object){
            $this->db->where('uuid', $uuid);
            $this->db->update('usuario', $object);
        }

        public function add_has_perfil($object){
            $this->db->insert('usuario_has_perfil', $object);
        }

        public function cantidad_solicitudes($usuario_id){
            $this->db->select('count(id) as "cantidad"');
            $this->db->where('usuario_id', $usuario_id);
            return $this->db->get('solicitud')->row_array()["cantidad"];
        }

        public function usuarios_solicitudes(){
            $this->db->select('usuario.email, usuario.nombre, usuario.id');
            $usuarios=$this->db->get('usuario')->result_array();
            foreach ($usuarios as $key => $value) {
                $usuarios[$key]["solicitudes"]=$this->cantidad_solicitudes($value["id"]);
                $usuarios[$key]["color"]=$this->color();
            }
            return $usuarios;
        }

        public function color(){
            $hex = '#';
 
            //Create a loop.
            foreach(array('r', 'g', 'b') as $color){
                //Random number between 0 and 255.
                $val = mt_rand(0, 255);
                //Convert the random number into a Hex value.
                $dechex = dechex($val);
                //Pad with a 0 if length is less than 2.
                if(strlen($dechex) < 2){
                    $dechex = "0" . $dechex;
                }
                //Concatenate
                $hex .= $dechex;
            }
            
            //Print out our random hex color.
            return $hex;
        }

        public function uuid(){
            $query = $this->db->query('select uuid() as "uuid"');
            $result=$query->row_array();
            return $result["uuid"];
        }

        var $order_column = array('usuario.nombre','usuario.email','usuario.etiqueta','perfil.nombre','usuario.status',null,null);  

        function make_query()  
            {
                $this->db->select('usuario.*,perfil.nombre as "perfil"');  
                $this->db->join('perfil', 'perfil.id = usuario.perfil_id', 'left');
                $this->db->from('usuario');
                
                
                
                #BUSQUEDA
                if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)  
                {  
                    $search_string=$_POST["search"]["value"];
                    $this->db->where("(usuario.nombre LIKE '%".$search_string."%' 
                    OR usuario.email LIKE '%".$search_string."%' 
                    OR usuario.etiqueta LIKE '%".$search_string."%' 
                    OR perfil.nombre LIKE '%".$search_string."%' 
                    OR usuario.etiqueta LIKE '%".$search_string."%' 
                    )", NULL, FALSE);   
                }  
                #ORDEN
                if(isset($_POST["order"]))  
                {  
                    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
                }  
                else  
                {  
                    $this->db->order_by('usuario.nombre', 'asc');  
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
                $this->db->from('usuario');  
                return $this->db->count_all_results();  
            }    

    }
?>