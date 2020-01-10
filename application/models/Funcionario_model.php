<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Usuario_model.php");
require_once("Acesso_model.php");

class Funcionario_model extends Usuario_model {

	private $id_funcionario;
	private $usuario_id_usuario;

	public function __construct() {
		parent::__construct();
		$this->load->model("Acesso_model", "acesso");
	}

	public function getIdFuncionario() {
		return $this->id_funcionario;
	}
	public function getUsuarioIdUsuario() {
		return $this->usuario_id_usuario;
	}
	public function setIdFuncionario($valor) {
		$this->id_funcionario = $valor;
	}
	public function setUsuarioIdUsuario($valor) {
		$this->usuario_id_usuario = $valor;
	}

	public function salvarFunc() {
		parent::salvarUsuario();
		
		$resultado = false;
		$this->db->set('usuario_id_usuario', $this->db->insert_id());
		$this->db->insert('tb_funcionario');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}
}