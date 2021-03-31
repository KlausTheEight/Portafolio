<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Modelo_general extends CI_Model {
    
        public function get_config($config){
            $this->db->select('*');
            $this->db->where('nombre', $config);
            return $this->db->get('configuracion')->row_array()["valor"];
        }

        public function total(){
            $this->db->select('count(id) as "total"');
            return $this->db->get('solicitud')->row_array()["total"];
        }

        public function total_hoy(){
            $this->db->select('count(id) as "total"');
            $this->db->where('date(fecha_creacion)', date('Y-m-d'));
            
            return $this->db->get('solicitud')->row_array()["total"];
        }

        public function total_categoria(){
            $this->db->select('count(solicitud.id) as "total",categoria.*');
            $this->db->join('categoria', 'categoria.id = solicitud.categoria_id', 'left');
            
            $this->db->group_by('solicitud.categoria_id');
            $this->db->order_by('total', 'desc');
            return $this->db->get('solicitud')->row_array();
        }

        public function total_macrosector(){
            $this->db->select('count(solicitud.id) as "total",macro_sector.*');
            $this->db->join('macro_sector', 'macro_sector.id = solicitud.macro_sector_id', 'left');
            
            $this->db->group_by('solicitud.macro_sector_id');
            $this->db->order_by('total', 'desc');
            return $this->db->get('solicitud')->row_array();
        }

        public function update_configuracion($config,$valor){
            $this->db->where('nombre', $config);
            $this->db->update('configuracion', ["valor"=>$valor]);
        }

        public function get_sin_derivar_usuarios()
        {
            $this->db->select('count(solicitud.id) as "cantidad",usuario.id, usuario.nombre as "nombre_usuario",usuario.email as "email_usuario"');
            $this->db->join('usuario', 'usuario.id = solicitud.usuario_id', 'left');
            
            $this->db->where('solicitud.bandeja_id', null);
            $this->db->group_by('usuario.id');
            
            $this->db->order_by('cantidad', 'desc');
            
            return $this->db->get('solicitud')->result_array();
            
            
        }
    }
    
    /* End of file Modelo_general.php */
    
?>