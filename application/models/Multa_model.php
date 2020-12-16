<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Multa_model extends CI_Model {

	private $id_multa;
    private $obc;
    private $id_usuario;
    private $id_tipo_multa;

    public function __construct() {
		parent::__construct();
	}

	public function getIdMulta() {
		return $this->id_multa;
	}

	public function getObc() {
		return $this->obc;
	}

	public function getIdUsuario() {
		return $this->id_usuario;
	}

	public function getIdTipoMulta() {
		return $this->id_tipo_multa;
	}

	public function setIdMulta($valor) {
		$this->id_multa = $valor;
	}

	public function setObc($valor) {
		$this->obc = $valor;
	}

	public function setIdUsuario($valor) {
		$this->id_usuario = $valor;
	}

	public function setIdTipoMulta($valor) {
		$this->id_tipo_multa = $valor;
	}

	public function salvarMulta() {
		$resultado = false;
		$this->db->set('obc', $this->getObc());
		$this->db->set('id_usuario', $this->getIdUsuario());
		$this->db->set('id_tipo_multa', $this->getIdTipoMulta());
		$this->db->insert('tb_multa');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function multaUsuario($id) {
		$this->db->select('*');
		$this->db->from('tb_multa m');
		$this->db->join('tb_tipo_multa t', 'm.id_tipo_multa = t.id_tipo_multa');
		$this->db->where('id_usuario', $id);

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;
	}

}


?>