<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_Reserva extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("Tipo_reserva_model", "tipo");
	}

	public function reserva() {
		autoriza();
		$this->load->template("cadastro/reserva");
	}

	public function salvarReserva() {
		$form = $this->input->post(NULL, TRUE);

		$this->load->library("form_validation");
		$this->form_validation->set_rules("nome", "nome", "trim|required");
		$this->form_validation->set_rules("descricao", "descricao", "trim|required");

		$sucesso = $this->form_validation->run();

		if ($sucesso) {
			$this->tipo->setNomeReserva($form['nome']);
			$this->tipo->setDescricao($form['descricao']);
			if ($this->tipo->salvarTipoReserva()) {
				$this->session->set_flashdata("success", "Dados cadastrados com sucesso!");
			} else {
				$this->session->set_flashdata("danger", "Dados não foram cadastrados!");
			}
		}

		$this->load->template("cadastro/reserva");
	}
}