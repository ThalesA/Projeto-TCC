<?php defined('BASEPATH') OR exit('No direct script access allowed');

get_instance()->load->iface('IDataTable');
class Checkout_model extends CI_Model implements IDataTable {

	private $id_checkout;
	private $data_checkout;
	private $perfil_usuario;
	private $id_checkin;
	private $tb_acesso_id_acesso;

	public function __construct() {
		parent::__construct();
	}

	public function getIdCheckout() {
		return $this->id_checkout;
	}
	public function getDataCheckout() {
		return $this->data_checkout;
	}
	public function getPerfilUsuario() {
		return $this->perfil_usuario;
	}
	public function getIdCheckin() {
		return $this->id_checkin;
	}
	public function getIdAcesso() {
		return $this->tb_acesso_id_acesso;
	}

	public function setIdCheckout($valor) {
		$this->id_checkout = $valor;
	}
	public function setDataCheckout($valor) {
		$this->data_checkout = $valor;
	}
	public function setPerfilUsuario($valor) {
		$this->perfil_usuario = $valor;
	}
	public function setIdCheckin($valor) {
		$this->id_checkin = $valor;
	}
	public function setIdAcesso($valor) {
		$this->tb_acesso_id_acesso = $valor;
	}

	public function saida() {
		$resultado = false;
		date_default_timezone_set('America/Sao_Paulo');
		$this->db->set('data_checkout', date('Y-m-d H:i:s'));
		$this->db->set('perfil_usuario', $this->getPerfilUsuario());
		$this->db->set('id_checkin', $this->getIdCheckin());
		$this->db->set('tb_acesso_id_acesso', $this->getIdAcesso());
		$this->db->insert('tb_checkout');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function listaDataTable() {
		
		$colunas[] = 'ID';
		$colunas[] = 'Quem?';
        $colunas[] = 'CPF';
        $colunas[] = 'RG';
		$colunas[] = 'Entrada';
		$colunas[] = 'Saída';

		$this->db->select('c.id_checkin, u.nome, d.cpf, d.rg, 
		CONCAT(DATE_FORMAT(c.data_checkin, "%d/%m/%Y às %H:%i:%s")) as Entrada,
		CONCAT(DATE_FORMAT(o.data_checkout, "%d/%m/%Y às %H:%i:%s")) as Saída');
		$this->db->from('tb_usuario u');
		$this->db->join('tb_acesso a', 'u.id_usuario = a.tb_usuario_id_usuario');
		$this->db->join('tb_checkin c', 'a.id_acesso = c.tb_acesso_id_acesso');
		$this->db->join('tb_checkout o', 'c.id_checkin = o.id_checkin');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->order_by("o.data_checkout",'desc');


		$query = $this->db->get();
        $result['colunas'] = $colunas;
        $result['linhas'] = $query->result_array();

        return $result;
	}
	public function listaDataTableTwo() {}
	
	public function usuarioRegistrado($id) {

		$this->db->select('*');
		$this->db->from('tb_usuario u');
		$this->db->join('tb_acesso a', 'u.id_usuario = a.tb_usuario_id_usuario');
		$this->db->join('tb_checkin i', 'i.tb_acesso_id_acesso = a.id_acesso');
		$this->db->join('tb_checkout c', 'i.id_checkin = c.id_checkin', 'left');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('d.id_documento', $id);
		$this->db->where('c.id_checkin IS NULL');

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;

	}
}