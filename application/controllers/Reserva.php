<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reserva extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("Tipo_reserva_model", "tipo");
		$this->load->model("Reserva_model", "reserva");
	}

	public function reservar() {

		$tipo_reserva = $this->tipo->listarTipoReserva();
		$reserva = $this->reserva->reservas();

		$dados["tipo_reserva"] = $tipo_reserva;

		$dados["reserva"] = $reserva;
		
		$this->load->template('home_morador/reserva', $dados);
	}

	public function salvarReserva() {
		autoriza();

		$form = $this->input->post(NULL, TRUE);

		$usuario = autoriza();
		$usuario = $usuario['tb_usuario_id_usuario'];

		$status = 1;

		$this->load->library("form_validation");
		$this->form_validation->set_rules("dia", "Dia reserva", "trim|required");
		$this->form_validation->set_rules("local", "Local reserva", "trim|required");

		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if ($sucesso) {
			$this->reserva->setDiaReserva($form['dia']);
			$this->reserva->setStatusReserva($status);
			$this->reserva->setIdTipoReserva($form['local']);
			$this->reserva->setIdUsuario($usuario);
			
			if ($this->reserva->buscarData($form['dia']) == TRUE) {
				$this->session->set_flashdata("danger", "Dia já reservado!");
				redirect('reserva/reservar');
			}

			if ($this->reserva->salvar()) {
				$this->session->set_flashdata("success", "Reserva efetuada com sucesso!");
			} else {
				$this->session->set_flashdata("danger", "Erro ao fazer reserva!");
				
			}
			redirect('reserva/reservar');
			
		} else {
			$tipo_reserva = $this->tipo->listarTipoReserva();
			$reserva = $this->reserva->reservas();

			$dados["tipo_reserva"] = $tipo_reserva;

			$dados["reserva"] = $reserva;

			$this->load->template("home_morador/reserva", $dados);
		}
	}
}