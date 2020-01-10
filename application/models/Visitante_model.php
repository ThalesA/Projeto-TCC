<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Usuario_model.php");
require_once("Acesso_model.php");

class Visitante_model extends Usuario_model {

	private $id_visitante;
	private $modo_entrada;
	private $entrega;
	private $veiculo;
	private $placa;
	private $usuario_id_usuario;

	public function __construct() {
		parent::__construct();
	}

	public function getIdVisitante() {
		return $this->id_visitante;
	}
	public function getModoEntrada() {
		return $this->modo_entrada;
	}
	public function getEntrega() {
		return $this->entrega;
	}
	public function getVeiculo() {
		return $this->veiculo;
	}
	public function getPlaca() {
		return $this->placa;
	}
	public function getIdUsuario() {
		return $this->usuario_id_usuario;
	}


	public function setIdVisitante($valor) {
		$this->id_visitante = $valor;
	}
	public function setModoEntrada($valor) {
		$this->modo_entrada = $valor;
	}
	public function setEntrega($valor) {
		$this->entrega = $valor;
	}
	public function setVeiculo($valor) {
		$this->veiculo = $valor;
	}
	public function setPlaca($valor) {
		$this->placa = $valor;
	}
	public function setIdUsuario($valor) {
		$this->usuario_id_usuario = $valor;
	}

	public function salvarVisitante() {
		parent::salvarUsuario();
		$resultado = false;

		$this->db->set('usuario_id_usuario', $this->db->insert_id());
		$this->db->set('veiculo', $this->getVeiculo());
		$this->db->set('placa', $this->getPlaca());
		$this->db->set('entrega', $this->getEntrega());
		$this->db->set('modo_entrada', $this->getModoEntrada());
		$this->db->insert('tb_visitante');

		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}
}