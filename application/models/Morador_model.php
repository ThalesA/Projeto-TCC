<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Usuario_model.php");
require_once("Acesso_model.php");

class Morador_model extends Usuario_model {

	private $id_morador;
	private $usuario_id_usuario;
	private $nomeveiculo;
	private $placa;
	private $possui;
	private $ativo;

	public function __construct() {
		parent::__construct();
		$this->load->model("Acesso_model", "acesso");
	}

	public function getIdMorador() {
		return $this->id_morador;
	}
	public function getUsuarioIdUsuario() {
		return $this->usuario_id_usuario;
	}
	public function getNomeveiculo() {
		return $this->nomeveiculo;
	}
	public function getPlaca() {
		return $this->placa;
	}
	public function getPossui() {
		return $this->possui;
	}
	public function getAtivo() {
		return $this->ativo;
	}

	public function setIdMorador($valor) {
		$this->id_morador = $valor;
	}
	public function setUsuarioIdUsuario($valor) {
		$this->usuario_id_usuario = $valor;
	}
	public function setNomeveiculo($valor) {
		$this->nomeveiculo = $valor;
	}
	public function setPlaca($valor) {
		$this->placa = $valor;
	}
	public function setPossui($valor) {
		$this->possui = $valor;
	}
	public function setAtivo($valor) {
		$this->ativo = $valor;
	}

	public function salvar() {
		parent::salvarUsuario();
		$resultado = false;

		$this->db->set('usuario_id_usuario', $this->db->insert_id());
		$this->db->set('nomeveiculo', $this->getNomeveiculo());
		$this->db->set('placa', $this->getPlaca());
		$this->db->set('possui', $this->getPossui());
		$this->db->insert('tb_morador');

		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function listarMoradores() {
		$this->db->select('*');
		$this->db->from('tb_morador m');
		$this->db->join('tb_usuario u', 'm.usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;

	}

	public function alterarMorador() {
		$resultado = false;
		parent::updateUsuario();
		$this->acesso->updateAcesso();
		
        $this->db->set('nomeveiculo', $this->getNomeveiculo());
        $this->db->set('placa', $this->getPlaca());
        $this->db->set('possui', $this->getPossui());
		$this->db->where('id_morador', $this->getIdMorador());
        $this->db->update('tb_morador');
	    $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
	}

	public function ativarSenha($id){
		$resultado = false;
        $this->db->set('ativo', 1);
		$this->db->where('usuario_id_usuario', $id);
        $this->db->update('tb_morador');
	    $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
	}

}
