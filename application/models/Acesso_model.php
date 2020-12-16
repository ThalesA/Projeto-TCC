<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso_model extends CI_Model {

	private $id_acesso;
    private $login;
	private $senha;
    private $tb_usuario_id_usuario;

    public function __construct() {
        parent::__construct();
    }

    public function getIdAcesso() {
    	return $this->id;
    }
    public function getLogin() {
    	return $this->login;
    }
    public function getSenha() {
    	return $this->senha;
    }
    public function getUsuarioIdUsuario() {
        return $this->tb_usuario_id_usuario;
    }
    public function setIdAcesso($valor) {
    	$this->id = $valor;
    }
    public function setLogin($valor) {
    	$this->login = $valor;
    }
    public function setSenha($valor) {
    	$this->senha = $valor;
    }
    public function setUsuarioIdUsuario($valor) {
        $this->tb_usuario_id_usuario = $valor;
    }

	public function logar($login,$senha) {
		$this->db->where("login", $login);
		$this->db->where("senha", $senha);
		$acesso = $this->db->get("tb_acesso")->row_array();
		return $acesso;
	}

    public function salvarAcesso() {
        $resultado = false;
        $this->db->set('login', $this->getLogin());
        $this->db->set('senha', $this->getSenha());
        $this->db->set('tb_usuario_id_usuario',$this->getUsuarioIdUsuario());
        $this->db->insert('tb_acesso');
        $resultado = ($this->db->affected_rows() > 0) ? true : false;

        return $resultado;
    }

    public function salvarAcessoVisitante() {
        $resultado = false;
        $this->db->set('login', '');
        $this->db->set('senha', '');
        $this->db->set('tb_usuario_id_usuario',$this->getUsuarioIdUsuario());
        $this->db->insert('tb_acesso');
        $resultado = ($this->db->affected_rows() > 0) ? true : false;

        return $resultado;
    }

    public function perfilMorador($id_usuario) {
        $this->db->select('*');
        $this->db->from('tb_morador');
        $this->db->where('usuario_id_usuario', $id_usuario);

        $result = $this->db->get();
        $result = $result->result_array();
        //var_dump($result);
        //break;
        return $result;
    }

    public function updateAcesso() {
        $resultado = false;
        $this->db->set('login', $this->getLogin());
        $this->db->set('senha', $this->getSenha());
        $this->db->where('id_acesso', $this->getIdAcesso());
        $this->db->update('tb_acesso');
        $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
    }

    public function alterarSenha($id) {
        $resultado = false;
        $this->db->set('senha', $this->getSenha());
        $this->db->where('tb_usuario_id_usuario', $id);
        $this->db->update('tb_acesso');
        $resultado = ($this->db->affected_rows() > 0) ? true : false;
        return $resultado;
    }

    public function ultimoAcesso() {
        $this->db->select('*');
        $this->db->from('tb_acesso');
        $this->db->order_by('id_acesso', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

    public function pegarAcesso($id_acesso) {
        $this->db->select('*');
        $this->db->from('tb_acesso');
        $this->db->order_by('id_acesso', 'DESC');
        $this->db->limit(1);

        $result = $this->db->get();
        $result = $result->result_array();

        return $result;
    }

}