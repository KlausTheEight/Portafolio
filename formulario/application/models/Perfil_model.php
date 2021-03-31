<?php
class Perfil_model extends CI_Model {
    public function add($object){
        $this->db->insert('perfil', $object);
    }
    public function delete($id=null){
        $this->db->where('id', $id);
        $this->db->delete('perfil');
    }
    public function update($id=null,$object){
        $this->db->where('id', $id);
        $this->db->update('perfil', $object);
    }
    public function get($id=null){
        $this->db->select('*');
        if($id!=null){
            $this->db->where('id', $id);
            return $this->db->get('perfil')->row_array();
        }
        return $this->db->get('perfil')->result_array();
    }
}
