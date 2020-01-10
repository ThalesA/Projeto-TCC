<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_model extends CI_Model {

	private $id_reserva;
	private $dia_reserva;
	private $status_reserva;
	private $tb_tipo_reserva_id_tipo_reserva;
	private $tb_usuario_id_usuario;

	public function __construct() {
		parent::__construct();
	}
	
	public function getIdReserva() {
		return $this->id_reserva;
	}
	public function getDiaReserva() {
		return $this->dia_reserva;
	}
	public function getStatusReserva() {
		return $this->status_reserva;
	}
	public function getIdTipoReserva() {
		return $this->tb_tipo_reserva_id_tipo_reserva;
	}
	public function getIdUsuario() {
		return $this->tb_usuario_id_usuario;
	}

	public function setIdReserva($valor){
		$this->id_reserva = $valor;
	}
	public function setDiaReserva($valor) {
		$this->dia_reserva = $valor;
	}
	public function setStatusReserva($valor) {
		$this->status_reserva = $valor;
	}
	public function setIdTipoReserva($valor) {
		$this->tb_tipo_reserva_id_tipo_reserva = $valor;
	}
	public function setIdUsuario($valor) {
		$this->tb_usuario_id_usuario = $valor;
	}

	public function salvar() {
		$resultado = false;
		$this->db->set('dia_reserva', $this->getDiaReserva());
		$this->db->set('status_reserva', $this->getStatusReserva());
		$this->db->set('tb_tipo_reserva_id_tipo_reserva', $this->getIdTipoReserva());
		$this->db->set('tb_usuario_id_usuario', $this->getIdUsuario());
		$this->db->insert('tb_reserva');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;

	}

	public function reservas() {
		$this->db->select('*');
		$this->db->from('tb_reserva as r');
		$this->db->join('tb_tipo_reserva as t', 't.id_tipo_reserva = r.tb_tipo_reserva_id_tipo_reserva');
		$this->db->order_by('dia_reserva');
		$result = $this->db->get();

		$result = $result->result_array();

		return $result;
	}

	public function buscarData($data) {
		$this->db->select('*');
		$this->db->from('tb_reserva');
		$this->db->where('dia_reserva', $data);
		$result = $this->db->get();

		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	} 
}