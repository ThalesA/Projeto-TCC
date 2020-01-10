<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_multa_model extends CI_Model {

	private $id_tipo_multa;
	private $tipo_multa;
	private $valor_multa;

	public function __construct() {
		parent::__construct();
	}

	public function getIdTipoMulta() {
		return $this->id_tipo_multa;
	}
	
	public function getTipoMulta() {
		return $this->tipo_multa;
	}

	public function getValorMulta() {
		return $this->valor_multa;
	}

	public function setIdTipoMulta($valor) {
		$this->id_tipo_multa = $valor;
	}

	public function setTipoMulta($valor) {
		$this->tipo_multa = $valor;
	}

	public function setValorMulta($valor) {
		$this->valor_multa = $valor;
	}

	public function salvarTipoMulta() {
		$resultado = false;
		$this->db->set('tipo_multa', $this->getTipoMulta());
		$this->db->set('valor_multa', $this->getValorMulta());
		$this->db->insert('tb_tipo_multa');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function listarTipoMulta() {
		$this->db->select('*');
		$this->db->from('tb_tipo_multa');

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;
	}
}