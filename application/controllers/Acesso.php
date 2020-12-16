<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Acesso extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Acesso_model", "acesso");
		$this->load->model("Morador_model", "morador");
		$this->output->enable_profiler(true);
	}

	public function index($dados='') {
		$this->load->template('login/acesso');
	}

	public function logar() {

		$form = $this->input->post(NULL, TRUE);

		//validação dos campos
		$this->load->library("form_validation");
		$this->form_validation->set_rules("login", "login", "trim|required");
		$this->form_validation->set_rules("senha", "senha", "trim|required");
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso){
			$login = $this->input->post("login");
			$senha = $this->input->post("senha");
			$usuario = $this->acesso->logar($login,$senha);
			if ($usuario) {
				$this->session->set_userdata("usuario_logado",$usuario);
				$this->session->set_flashdata("success", "Logado com sucesso!");
				redirect("usuario/principal");
			} else {
				$this->session->set_flashdata("danger", "Login ou senha inválidos!");
				redirect("/");
			}
		} else {
			$this->load->template("login/acesso");
		}
		
	}

	public function logout() {
		$this->session->unset_userdata("usuario_logado");
		$this->session->set_flashdata("success", "Deslogado com sucesso!");
		redirect('/');
	}

	public function alterar() {
		$this->load->template('alterar/alterar_senha');
	}

	public function alterarAcesso() {
		$form = $this->input->post(NULL, TRUE);

		//validação dos campos
		$this->load->library("form_validation");
		$this->form_validation->set_rules("senha", "Senha", "trim|required");
		$this->form_validation->set_rules("senha2", "Confirmar senha", "trim|required|matches[senha]");
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso){
			$this->acesso->setSenha($form['senha']);
			$usuario = $this->session->userdata("perfil_usuario");
			$id_usuario = $usuario[0]['usuario_id_usuario'];
			$ativo = $usuario[0]['ativo'];

			if($this->acesso->alterarSenha($id_usuario) == TRUE ) {
				if ($ativo == 0) {
					$this->morador->ativarSenha($id_usuario);
				}
				$this->session->set_flashdata("success", "Senha alterada com sucesso!");
				redirect("acesso/alterar");
			} else {
				$this->session->set_flashdata("danger", "Error ao alterar senha!");
				redirect("acesso/alterar");
			}
		}
		$this->load->template('alterar/alterar_senha');
	}

}
