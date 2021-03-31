<?php
class Formulario_model extends CI_Model {

    public function get_formularios($proyecto_id){
        $this->db->where('proyecto_id', $proyecto_id);
        return $this->db->get('formulario')->result_array();
    }

    public function add($object){
        $this->db->insert('formulario', $object);
    }

    public function delete($id=null){
        $this->db->where('id', $id);
        $this->db->delete('formulario');
    }

    public function add_ingreso($ingreso){
        $this->db->insert('ingreso', $ingreso);
        return $this->db->insert_id();
    }

    public function get_ingreso($id){
        $this->db->where('id', $id);
        return $this->db->get('ingreso')->row_array();
    }

    public function update_ingreso($id,$ingreso){
        $this->db->where('id', $id);
        $this->db->update('ingreso', $ingreso);
    }

    public function delete_ingreso($id){
        $this->db->where('id', $id);
        $this->db->delete('ingreso');
    }

    public function get_estado($id=null,$formulario_id=null){
        $this->db->select('*');
        if ($formulario_id!=null) {
            $this->db->where('formulario_id', $formulario_id);
        }
        if ($id!=null) {
            $this->db->where('id', $id);
            return $this->db->get('estado')->row_array();
        }
        return $this->db->get('estado')->result_array();
    }

    public function update_estado($id,$estado){
        $this->db->where('id', $id);
        $this->db->update('estado', $estado);
    }

    public function add_estado($estado){
        $this->db->insert('estado', $estado);
        return $this->db->insert_id();
    }

    public function delete_estado($id){
        $this->db->where('id', $id);
        $this->db->delete('estado');
    }

    public function add_valor($valor){
        $this->db->insert('valor', $valor);
    }

    public function update_valor($ingreso_id=null,$campo_id=null,$valor_id=null,$valor){
        if ($ingreso_id!=null) {
            $this->db->where('ingreso_id', $ingreso_id);
        }
        if ($campo_id!=null) {
            $this->db->where('campo_id', $campo_id);
        }
        if ($valor_id!=null) {
            $this->db->where('valor_id', $valor_id);
        }
        $this->db->update('valor', $valor);
    }

    public function update($id=null,$object){
        $this->db->where('id', $id);
        $this->db->update('formulario', $object);
    }

    public function get($id=null,$sha1id=null){
        $this->db->select('*');
        if($id!=null){
            $this->db->where('id', $id);
            return $this->db->get('formulario')->row_array();
        }
        if($sha1id!=null){
            $this->db->where('sha1(id)', $sha1id);
            return $this->db->get('formulario')->row_array();
        }
        return $this->db->get('formulario')->result_array();
    }

    public function add_seccion($seccion){
        $this->db->insert('seccion', $seccion);
    }

    public function get_seccion($id=null,$formulario_id=null,$shaid=null){
        $this->db->select('*');
        if ($id!=null) {
            $this->db->where('id', $id);
            return $this->db->get('seccion')->row_array();
        }

        if ($formulario_id!=null) {
            $this->db->where('formulario_id', $formulario_id);
        }

        if ($shaid!=null) {
            $this->db->where('sha1(formulario_id)', $shaid);
        }
        $this->db->order_by('seccion.orden', 'asc');
        return $this->db->get('seccion')->result_array();
    }

    public function add_campo($object){
        $this->db->insert('campo', $object);
    }

    public function update_campo($id,$object){
        $this->db->where('id', $id);
        $this->db->update('campo', $object);
    }

    public function delete_campo($id){
        $this->db->where('id', $id);
        $this->db->delete('campo');
    }

    public function get_campos($id=null,$id_seccion=null,$ids=null, $solo_inputs = false){
        $this->db->select('campo.*,tipo.tipo as "tipo",tipo.type as "type"');
        $this->db->join('tipo', 'tipo.id = campo.tipo_id', 'left');
        if ($solo_inputs) {
            $this->db->where_not_in('campo.tipo_id', [8, 9]);
        }
        if ($id!=null) {
            $this->db->where('campo.id', $id);
            return $this->db->get('campo')->row_array();
        }
        if ($id_seccion!=null) {
            $this->db->where('campo.seccion_id', $id_seccion);
            $this->db->order_by('orden', 'desc');
            return $this->db->get('campo')->result_array();
        }
        if ($ids!=null) {
            $this->db->where_in('campo.id', $ids);
            $this->db->order_by('orden', 'desc');
            return $this->db->get('campo')->result_array();
        }

    }

    public function delete_campos_ingreso($ingreso_id){
        $this->db->where('ingreso_id', $ingreso_id);
        $this->db->delete('valor');
    }

    public function get_valor($ingreso_id=null,$campo_id=null,$todos=false){
        $this->db->select('valor.*, campo.tipo_id');
        $this->db->join('campo', 'campo.id = valor.campo_id');
        if ($ingreso_id!=null) {
            $this->db->where('ingreso_id', $ingreso_id);
        }

        if ($campo_id!=null) {
            $this->db->where('campo_id', $campo_id);
        }
        if ($todos) {
            return $this->db->get('valor')->result_array();
        }

        return $this->db->get('valor')->row_array()["valor"];
    }

    public function validar_unico($campo_id=null,$valor){
        $this->db->select('valor');

        if ($campo_id!=null) {
            $this->db->where('campo_id', $campo_id);
        }
        $this->db->where('valor', $valor);

        return $this->db->get('valor')->row_array()["valor"];
    }

    public function get_tipos(){
        $this->db->select('*');
        return $this->db->get('tipo')->result_array();
    }

    var $order_column = array();

    function make_query()
    {
        $this->db->select('*');

        $this->db->from('formulario');

        #BUSQUEDA
        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"]!=null)
        {
            $search_string=$_POST["search"]["value"];
            $this->db->where("(formulario.nombre LIKE '%".$search_string."%'
            )", NULL, FALSE);
        }
        #ORDEN
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
        $this->db->from('formulario');
        return $this->db->count_all_results();
    }


    function get_total_registros($id)
    {
        $this->db->where('ingreso.formulario_id', $id);
        if ($this->session->userdata('usuario')["perfil_id"] == "2") {
            $this->db->where('ingreso.usuario_id', $this->session->userdata('usuario')["id"]);
        }
        return $this->db->get('ingreso')->num_rows();
    }

    function historial_ingreso($id_ingreso)
    {
        $this->db->select('*');
        $this->db->where('ingreso.id', $id_ingreso);
        $ingreso = $this->db->get('ingreso')->row_array();

        $this->db->where('valor.ingreso_id', $id_ingreso);
        $valores = $this->db->get('valor')->result_array();

        $this->db->insert('historial_ingreso', [
            "ingreso_id" => $id_ingreso,
            "usuario_id" => $this->session->userdata('usuario')["id"],
            "json_ingreso" => json_encode($ingreso),
            "json_valores" => json_encode($valores),
        ]);

        return;
    }
}
