<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Taxa_model extends CI_Model {

	private $id_taxa;
	private $valor_taxa;
	private $pago;
	private $data_vencimento;
	private $tb_usuario_id_usuario;

	public function __construct() {
		parent::__construct();
	}

	public function getIdTaxa() {
		return $this->id_taxa;
	}
	public function getValorTaxa() {
		return $this->valor_taxa;
	}
	public function getDataVencimento() {
		return $this->data_vencimento;
	}
	public function getIdUsuario() {
		return $this->tb_usuario_id_usuario;
	}

	public function setIdTaxa($valor) {
		$this->id_taxa = $valor;
	}
	public function setValorTaxa($valor) {
		$this->valor_taxa = $valor;
	}
	public function setDataVencimento($valor) {
		$this->data_vencimento = $valor;
	}
	public function setIdUsuario($valor) {
		$this->tb_usuario_id_usuario = $valor;
	}

	public function salvarTaxa() {
		$resultado = false;
		$this->db->set('valor_taxa', $this->getValorTaxa());
		$this->db->set('data_vencimento', $this->getDataVencimento());
		$this->db->set('tb_usuario_id_usuario', $this->getIdUsuario());
		$this->db->insert('tb_taxa');
		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;
	}

	public function taxaMes($data,$id) {
		$this->db->select('*');
        $this->db->from('tb_taxa');
        $this->db->where('data_vencimento', $data);
        $this->db->where('tb_usuario_id_usuario', $id);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
	}

	public function taxaId($id) {
		$this->db->select('*');
        $this->db->from('tb_taxa');
        $this->db->where('tb_usuario_id_usuario', $id);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
	}


}