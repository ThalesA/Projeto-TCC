<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_reserva_model extends CI_Model {

	private $id_tipo_reserva;
	private $nome_reserva;
	private $descricao;

	public function __construct() {
		parent::__construct();
	}

	public function getIdTipoReserva() {
		return $this->id_tipo_reserva;
	}

	public function getNomeReserva() {
		return $this->nome_reserva;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setIdTipoReserva($valor) {
		$this->id_tipo_reserva = $valor;	
	}

	public function setNomeReserva($valor) {
		$this->nome_reserva = $valor;
	}

	public function setDescricao($valor) {
		$this->descricao = $valor;
	}

	public function salvarTipoReserva() {
		$resultado = false;
		$this->db->set('nome_reserva', $this->getNomeReserva());
		$this->db->set('descricao', $this->getDescricao());
		$this->db->insert('tb_tipo_reserva');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function listarTipoReserva() {
		$this->db->select('*');
		$this->db->from('tb_tipo_reserva');

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;

	}



}