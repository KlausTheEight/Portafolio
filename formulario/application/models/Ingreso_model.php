<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingreso_model extends CI_Model {

	function get($id = null, $formulario_id = null)
	{
		$this->db->select('ingreso.*,formulario.nombre as "formulario", COALESCE(usuario.nombre, "") as "ingresador", valor.valor as "identificacion"');
		$this->db->join('formulario', 'formulario.id = ingreso.formulario_id', 'left');
		$this->db->join('usuario', 'usuario.id = ingreso.usuario_ingresa_id', 'left');
		$this->db->join('seccion', 'seccion.formulario_id = formulario.id');
		$this->db->join('campo', 'campo.seccion_id = seccion.id AND campo.identificacion = 1', 'left');
		$this->db->join('valor', 'valor.campo_id = campo.id', 'left');
		$this->db->group_by('ingreso.id');
		if ($id != null) {
			$this->db->where('ingreso.id', $id);
			return $this->db->get('ingreso')->row_array();
		}elseif($formulario_id){
			$this->db->where('ingreso.formulario_id', $formulario_id);
			return $this->db->get('ingreso')->result_array();
		}
	}

	function get_campo($id_ingreso, $id_campo = null)
	{
		$this->db->where('valor.ingreso_id', $id_ingreso);
		if ($id_campo != null) {
			$this->db->where('valor.campo_id', $id_campo);
			return $this->db->get('valor')->row_array();
		}
		return $this->db->get('valor')->result_array();
	}

}

/* End of file Ingreso_model.php */
/* Location: .//private/var/folders/6t/td7gq4_d24x4s5srhffpbjdm0000gn/T/fz3temp-2/Ingreso_model.php */