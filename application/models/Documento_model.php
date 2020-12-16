<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {

	private $id_documento;
	private $cpf;
	private $rg;

	public function __construct() {
		parent::__construct(); 
	}

	public function getIdDocumento() {
		return $this->id_documento;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function getRg() {
		return $this->rg;
	}

	public function setIdDocumento($valor) {
		$this->id_documento = $valor;
	}

	public function setCpf($valor) {
		$this->cpf = $valor;
	}

	public function setRg($valor) {
		$this->rg = $valor;
	}

	public function salvarDocumento() {
		
		$resultado = false;
		$this->db->set('cpf', $this->getCpf());
		$this->db->set('rg', $this->getRg());
		$this->db->insert('tb_documento');

		$resultado = ($this->db->affected_rows() > 0) ? true : false;

		return $resultado;

	}

	public function updateDocumento() {
		$resultado = false;

        $this->db->set('cpf', $this->getCpf());
        $this->db->set('rg', $this->getRg());
		$this->db->where('id_documento', $this->getIdDocumento());
        $this->db->update('tb_documento');
	    $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
	}

	//retorna lista de pessoas
    public function selectUsuarioCPF($cpf='') {
        $this->db->select('*');
        $this->db->from('tb_documento');
		if($cpf != ''){
			$this->db->where('cpf',$cpf);
		}
        $consulta = $this->db->get();
        $resultado = $consulta->result_array();

        //validando a consulta
        if ($consulta->num_rows() > 0):
            return $resultado;
        else:
            return FALSE;
        endif;
    }

    public function consultaCpf($cpf = '') {
        $result = false;
        if ($cpf != '') {
            $this->db->select('*');
            $this->db->from('tb_documento');
            $this->db->where('cpf =', $cpf);
            $query = $this->db->get();
            $result = ($query->num_rows() == 0) ? false : true;
        }
        return $result;
    }

    public function consultaCpfupdate($cpf = '', $id = ''){
        $result = false;
        if ($cpf != '') {
            $this->db->select('*');
            $this->db->from('tb_documento');
            $this->db->where('cpf =', $cpf);
            $this->db->where('id_documento !=', $id);
            $query = $this->db->get();
            $result = ($query->num_rows() == 0) ? true : false;
        }
        return $result;
    }
	
}