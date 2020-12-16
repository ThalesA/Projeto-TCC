<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Multa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("Multa_model", "multa");
		$this->load->model("Tipo_multa_model", "tipo_multa");
	}

	public function salvarMulta() {
		$form = $this->input->post(NULL, TRUE);

		$this->load->library("form_validation");
		$this->form_validation->set_rules("id_tipo_multa", "Tipo multa", "trim|required");
		$this->form_validation->set_rules("obc", "obc", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso) {
			$this->multa->setObc($form['obc']);
			$this->multa->setIdUsuario($form['id_usuario']);
			$this->multa->setIdTipoMulta($form['id_tipo_multa']);
			if($this->multa->salvarMulta() == TRUE)
			$this->session->set_flashdata("success", "Multa gerada com sucesso!");
		} else {
			$this->session->set_flashdata("danger", "Dados inválidos!");
		}

		redirect("usuario/lista");
		
	}

	public function tipoMulta() {
		$this->load->template("cadastro/multa");
	}

	public function salvarTipoMulta() {
		$form = $this->input->post(NULL, TRUE);

		$this->load->library("form_validation");
		$this->form_validation->set_rules("tipo_multa", "Tipo multa", "trim|required");
		$this->form_validation->set_rules("valor_multa", "Valor multa", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso) {
			$this->tipo_multa->setTipoMulta($form['tipo_multa']);
			$this->tipo_multa->setValorMulta($form['valor_multa']);
			if($this->tipo_multa->salvarTipoMulta() == TRUE)
			$this->session->set_flashdata("success", "Tipo de multa gerada com sucesso!");
		} else {
			$this->session->set_flashdata("danger", "Dados inválidos!");
		}

		$this->load->template("cadastro/multa");

	}
}
