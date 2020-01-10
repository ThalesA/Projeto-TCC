<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Taxa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("Taxa_model", "taxa");
		$this->load->model("Multa_model", "multa");
	}
	
	public function salvarTaxa() {
		$form = $this->input->post(NULL, TRUE);
	
		$this->load->library("form_validation");
		$this->form_validation->set_rules("valor_taxa", "Valor taxa", "trim|required");
		$this->form_validation->set_rules("data_vencimento", "Data vencimento", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso) {
			//print_r($form);
			//die();
			date_default_timezone_set('America/Sao_Paulo');
			$taxa = $this->taxa->taxaMes($form['data_vencimento'],$form['id_usuario']);
			$dataProximo = date('Y-m-d', strtotime('+1 months', strtotime($taxa[0]['data_vencimento'])));
			$mes = $taxa[0]['data_vencimento'];
			$arr = explode('-',$mes);
			$mesGerado = $arr[1];

			$mesInput = $form['data_vencimento'];
			$arrInput = explode('-', $mesInput);
			$mesForm = $arrInput[1];

			if ($mesGerado = $mesForm) {
				$this->session->set_flashdata("danger", "Taxa do mês já gerado!");
			} else {
				$this->taxa->setValorTaxa($form['valor_taxa']);
				$this->taxa->setDataVencimento($form['data_vencimento']);
				$this->taxa->setIdUsuario($form['id_usuario']);
				if($this->taxa->salvarTaxa() == TRUE) {
					$this->session->set_flashdata("success", "Taxa gerada com sucesso!");
				} else {
					$this->session->set_flashdata("danger", "Dados inválidos!");
				}
			}
			redirect("usuario/lista");
		}
			redirect("usuario/lista");	
	}

	public function emitir() {

		$id = autoriza()['tb_usuario_id_usuario'];
		
		$taxa = $this->taxa->taxaId($id);
		if (empty($taxa)) {
			$this->session->set_flashdata("danger", "Taxa condominial não foi gerada!");
			$this->load->template('home_morador/index');
			return;
		}
		$multa = $this->multa->multaUsuario($id);
		$data['taxa'] = $taxa;
		$data['multa'] = $multa;
		$this->load->view("boleto_bb",$data);
	}
}