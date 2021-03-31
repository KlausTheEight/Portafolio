<?php
class Usuario_model extends CI_Model {
    public function add($object){
        $this->db->insert('usuario', $object);
        return $this->db->insert_id();
    }
    public function login($email=null,$password=null){

        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('status', 1);
        $this->db->where('password', sha1($password));
        $result = $this->db->get('usuario')->row_array();
        if ($result!=null) { 
            $this->session->set_userdata('usuario',$result);
            return true;
        }else{
            return false;
        }

    }
  
    
    public function delete($id=null){
        $this->db->where('id', $id);
        $this->db->delete('usuario');
    }
    public function update($id=null,$object){
        $this->db->where('id', $id);
        $this->db->update('usuario', $object);
    }
    public function get($id=null,$email=null){
        $this->db->select('usuario.*,perfil.nombre as "perfil"');
        $this->db->join('perfil', 'perfil.id = usuario.perfil_id', 'left');
        if($id!=null){
            $this->db->where('usuario.id', $id);
            return $this->db->get('usuario')->row_array();
        }
        if($email!=null){
            $this->db->where('usuario.email', $email);
            return $this->db->get('usuario')->row_array();
        }
        return $this->db->get('usuario')->result_array();
    }
}
