<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Modelo_ccu extends CI_Model {
    
        public function __construct()
        {
            parent::__construct();
            $this->ccu=$this->load->database('ccu',TRUE);
        }

     

        function get_cursos($id=null){
            $this->ccu->select('*');
            if ($id!=null) {
                $this->ccu->where('id', $id);
                return $this->ccu->get('course')->row_array();
            }
            $this->ccu->order_by('code', 'asc');
            return $this->ccu->get('course')->result_array();
            
        }

        
        public function get_alumnos($course_id){
            $this->ccu->select('user.id,user.firstname,user.lastname');
            $this->ccu->join('course_rel_user', 'course_rel_user.user_id = user.id', 'left');
            $this->ccu->where('course_rel_user.c_id', $course_id);
            $this->ccu->where('course_rel_user.status', 5);
            $this->ccu->where('user.active', 1);
            #$this->ccu->where('course_rel_user.status', 1);
            $this->ccu->order_by('firstname', 'asc');
            return $this->ccu->get('user')->result_array();
        }
    

        function get_field($user_id,$field_id){
            $this->ccu->select('*');
            $this->ccu->where('field_id', $field_id);
            $this->ccu->where('item_id', $user_id);
            $field=$this->ccu->get('extra_field_values')->row_array();
            return $field["value"];
        }

        public function get_alumnos_cant($course_id){
            $this->ccu->select('count(user.id) as "cantidad"');
            $this->ccu->join('course_rel_user', 'course_rel_user.user_id = user.id', 'left');
            $this->ccu->where('course_rel_user.c_id', $course_id);
            $this->ccu->where('course_rel_user.status', 5);
            #$this->ccu->where('course_rel_user.status', 1);
            $this->ccu->order_by('firstname', 'asc');
            
            return $this->ccu->get('user')->row_array();
        }
    
        public function get_curso($user_id=null,$id){
            $this->ccu->select('course.title,course.code,course.id');
            $this->ccu->join('course_rel_user', 'course_rel_user.c_id = course.id', 'left');
            if ($user_id!=null) {
                $this->ccu->where('course_rel_user.user_id', $user_id);
                #$this->ccu->where('course_rel_user.is_tutor', 5);
            }
            
            $this->ccu->where('course.id', $id);
            #$this->ccu->where('course_rel_user.is_tutor', 1);
            
            $this->ccu->where('course_rel_user.status', 5);
            return $this->ccu->get('course')->row_array();
        }

        public function get_lessons($c_id){
            $this->ccu->select('*');
            $this->ccu->where('c_id', $c_id);
            #$this->ccu->where('course_rel_user.status', 1);
            return $this->ccu->get('c_lp')->result_array();
        }
    
        public function get_cant_lessons($c_id){
            $this->ccu->select('count(id) as "cantidad"');
            $this->ccu->where('c_id', $c_id);
            #$this->ccu->where('course_rel_user.status', 1);
            return $this->ccu->get('c_lp')->row_array();
        }
    
        public function get_progress($lp_id,$user_id){
            $this->ccu->select('*');
            $this->ccu->where('lp_id', $lp_id);
            $this->ccu->where('user_id', $user_id);
            #$this->ccu->where('course_rel_user.status', 1);
            return $this->ccu->get('c_lp_view')->row_array();
        }

        public function get_items($lp_id){
            $this->ccu->select('*');
            $this->ccu->where('lp_id', $lp_id);
            #$this->ccu->where('course_rel_user.status', 1);
            return $this->ccu->get('c_lp_item')->result_array();
        }

        public function get_item_view($item_id,$progreso_id){
            $this->ccu->select('*');
            $this->ccu->where('lp_item_id', $item_id);
            $this->ccu->where('lp_view_id', $progreso_id);
            #$this->ccu->where('course_rel_user.status', 1);
            return $this->ccu->get('c_lp_item_view')->result_array();
        }
    
    
    }
    
    /* End of file Modelo_ccu.php */
    
?>