<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Endereco_model extends CI_Model {

	private $id_endereco;
	private $rua;
	private $lote;

	public function __construct() {
		parent::__construct();
	}

	public function getIdEndereco() {
		return $this->id_endereco;
	}

	public function getRua() {
		return $this->rua;
	}

	public function getLote() {
		return $this->lote;
	}

	public function setIdEndereco($valor) {
		$this->id_endereco = $valor;
	}

	public function setRua($valor) {
		$this->rua = $valor;
	}

	public function setLote($valor) {
		$this->lote = $valor;
	}

	public function pegarUltimoId() {
		
	}

	public function salvarEndereco() {
		$resultado = false;
		$this->db->set('rua', $this->getRua());
		$this->db->set('lote', $this->getLote());
		$this->db->insert('tb_endereco');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;
		return $resultado;
	}

	public function updateEndereco() {
		$resultado = false;

        $this->db->set('lote', $this->getLote());
        $this->db->set('rua', $this->getRua());
		$this->db->where('id_endereco', $this->getIdEndereco());
        $this->db->update('tb_endereco');
	    $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
	}
}