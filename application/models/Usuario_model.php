<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Documento_model.php");
require_once("Endereco_model.php");
get_instance()->load->iface('IDataTable');
class Usuario_model extends CI_Model implements IDataTable {
	
	private $id_usuario;
	private $nome;
	private $imagem;
	private $tb_documento_id_documento;
	private $tb_endereço_id_endereço;

	public function __construct() {
		parent::__construct();
		$this->load->model("Documento_model", "documento");
		$this->load->model("Endereco_model", "endereco");
	}

	public function getIdUsuario() {
		return $this->id_usuario;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getImagem() {
		return $this->imagem;
	}
	public function getIdDocumento() {
		return $this->tb_documento_id_documento;
	}
	public function getIdEndereco() {
		return $this->tb_endereço_id_endereco;
	}
	public function setIdUsuario($valor) {
		$this->id_usuario = $valor;
	}
	public function setNome($valor) {
		$this->nome = $valor;
	}
	public function setImagem($valor) {
		$this->imagem = $valor;
	}
	public function setIdDocumento($valor) {
		$this->tb_documento_id_documento = $valor;
	}
	public function setIdEndereco($valor) {
		$this->tb_endereço_id_endereco = $valor;
	}

	public function salvarUsuario() {
		
		$resultado = false;

		if ($this->documento->consultaCpf($this->documento->getCpf()) == false) {
			$this->documento->salvarDocumento();
			$this->endereco->salvarEndereco();
			$this->db->set('nome', $this->getNome());
			$this->db->set('tb_documento_id_documento', $this->db->insert_id());
			$this->db->set('tb_endereco_id_endereco', $this->db->insert_id());
			$this->db->insert('tb_usuario');
			$resultado = ($this->db->affected_rows() > 0) ? true : false;
		} else {
			throw new Exception('CPF já existe em nossa base de dados!');
		}
		return $resultado;
		
	}

	public function listarUsuario($id) {
		$this->db->select('*');
		$this->db->from('tb_acesso a');
		$this->db->join('tb_usuario u', 'a.tb_usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_morador m', 'm.usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('id_usuario', $id);

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;

	}

	public function listarMoradorCpf($id) {
		$this->db->select('*');
		$this->db->from('tb_acesso a');
		$this->db->join('tb_usuario u', 'a.tb_usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_morador m', 'm.usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('d.id_documento', $id);

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;

	}

	public function listarVisitanteCpf($id) {
		$this->db->select('*');
		$this->db->from('tb_acesso a');
		$this->db->join('tb_usuario u', 'a.tb_usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_visitante v', 'v.usuario_id_usuario = u.id_usuario');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('d.id_documento', $id);

		$result = $this->db->get();
		$result = $result->result_array();
		return $result;

	}

	public function listaDataTable() {
		
		$colunas[] = 'ID';
		$colunas[] = 'Quem?';
		$colunas[] = 'Nº cartão';
        $colunas[] = 'CPF';
        $colunas[] = 'RG';
		$colunas[] = 'Horário';
		$colunas[] = 'Rua';
		$colunas[] = 'Lote';

		$this->db->select('c.id_checkin, u.nome, c.numero_cartao, d.cpf , d.rg, CONCAT("Hoje às ",DATE_FORMAT(c.data_checkin, "%H:%i:%s")), e.rua, e.lote');
		$this->db->from('tb_usuario u');
		$this->db->join('tb_acesso a', 'u.id_usuario = a.tb_usuario_id_usuario');
		$this->db->join('tb_checkin c', 'a.id_acesso = c.tb_acesso_id_acesso');
		$this->db->join('tb_checkout o', 'c.id_checkin = o.id_checkin', 'left');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('o.id_checkin IS NULL');
		$this->db->where("DATE_FORMAT(c.data_checkin, '%Y-%m-%d') = CURDATE()");
		$this->db->order_by("c.data_checkin",'asc');


		$query = $this->db->get();
        $result['colunas'] = $colunas;
        $result['linhas'] = $query->result_array();

        return $result;
	}

	public function updateUsuario() {

        $resultado = false;

		if ($this->documento->consultaCpfupdate($this->documento->getCpf(),$this->documento->getIdDocumento()) == true) {
			$this->documento->updateDocumento();
			$this->endereco->updateEndereco();
			$this->db->set('nome', $this->getNome());
			$this->db->set('tb_documento_id_documento', $this->getIdDocumento());
			$this->db->set('tb_endereco_id_endereco', $this->getIdEndereco());
			$this->db->where('id_usuario', $this->getIdUsuario());
	        $this->db->update('tb_usuario');
	        $resultado = ($this->db->affected_rows() > 0) ? true : false;
		} else {
			throw new Exception('CPF já existe em nossa base de dados!');
		}
		return $resultado;

    }

    public function deleteUsuario($id) {
        $this->db->where('id_usuario', $id);
        return $this->db->delete('tb_usuario');
    }

    public function ultimoUsuario() {
        $this->db->select('*');
        $this->db->from('tb_usuario');
        $this->db->order_by('id_usuario', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

    public function listaDataTableTwo() {
    	
    	$colunas[] = 'ID';
		$colunas[] = 'Quem?';
		$colunas[] = 'Nº cartão';
        $colunas[] = 'CPF';
        $colunas[] = 'RG';
		$colunas[] = 'Horário';
		$colunas[] = 'Rua';
		$colunas[] = 'Lote';

		$this->db->select('c.id_checkin, u.nome, c.numero_cartao, d.cpf , d.rg, CONCAT(DATE_FORMAT(c.data_checkin, "%d/%m/%Y às %H:%i:%s")), e.rua, e.lote');
		$this->db->from('tb_usuario u');
		$this->db->join('tb_acesso a', 'u.id_usuario = a.tb_usuario_id_usuario');
		$this->db->join('tb_checkin c', 'a.id_acesso = c.tb_acesso_id_acesso');
		$this->db->join('tb_checkout o', 'c.id_checkin = o.id_checkin', 'left');
		$this->db->join('tb_endereco e', 'u.tb_endereco_id_endereco = e.id_endereco');
		$this->db->join('tb_documento d', 'u.tb_documento_id_documento = d.id_documento');
		$this->db->where('o.id_checkin IS NULL');
		$this->db->where("DATE_FORMAT(c.data_checkin, '%Y-%m-%d') < CURDATE()");
		$this->db->order_by("c.data_checkin",'asc');


		$query = $this->db->get();
        $result['colunas'] = $colunas;
        $result['linhas'] = $query->result_array();

        return $result;

    }

}