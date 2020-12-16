<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin_model extends CI_Model {

	private $id_checkin;
	private $data_checkin;
	private $numero_cartao;
	private $perfil_usuario;
	private $tb_acesso_id_acesso;

	public function __construct() {
		parent::__construct();
	}

	public function getIdCheckin() {
		return $this->id_checkin;
	}
	public function getDataCheckin() {
		return $this->data_checkin;
	}
	public function getNumeroCartao() {
		return $this->numero_cartao;
	}
	public function getPerfilUsuario() {
		return $this->perfil_usuario;
	}
	public function getIdAcesso() {
		return $this->tb_acesso_id_acesso;
	}

	public function setIdCheckin($valor) {
		$this->id_checkin = $valor;
	}
	public function setDataCheckin($valor) {
		$this->data_checkin = $valor;
	}
	public function setNumeroCartao($valor) {
		$this->numero_cartao = $valor;
	}
	public function setPerfilUsuario($valor) {
		$this->perfil_usuario = $valor;
	}
	public function setIdAcesso($valor) {
		$this->tb_acesso_id_acesso = $valor;
	}

	public function entrada() {
		$resultado = false;
		date_default_timezone_set('America/Sao_Paulo');
		$this->db->set('data_checkin', date('Y-m-d H:i:s'));
		$this->db->set('numero_cartao', $this->getNumeroCartao());
		$this->db->set('perfil_usuario', $this->getPerfilUsuario());
		$this->db->set('tb_acesso_id_acesso', $this->getIdAcesso());
		$this->db->insert('tb_checkin');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function pegarIdCheckin($id) {
		$this->db->select('*');
        $this->db->from('tb_checkin');
        $this->db->where('id_checkin',$id);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
	}

}