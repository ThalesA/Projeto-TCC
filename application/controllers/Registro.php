<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("Checkin_model", "checkin");
		$this->load->model("Checkout_model", "checkout");
		$this->load->model("Visitante_model", "visitante");
		$this->load->model("Documento_model", "documento");
		$this->load->model("Endereco_model", "endereco");
		$this->load->model("Acesso_model", "acesso");
        $this->load->model("Usuario_model", "usuario");
		
	}

    public function verificaDocs($cpf='') {
        $doc = $this->documento->selectUsuarioCPF($cpf);
        if(!empty($this->usuario->listarVisitanteCpf($doc[0]['id_documento']))){
            $dados['usuario'] = $this->usuario->listarVisitanteCpf($doc[0]['id_documento']);
        } else {
            $dados['usuario'] = $this->usuario->listarMoradorCpf($doc[0]['id_documento']);
        }
        //print_r($dados['usuario']);
        $this->load->view('home/principal', $dados);
    
    }

	public function registrar() {
		//$_POST
        $dadosForm = $this->input->post(NULL, TRUE);
		
        //carrega a biblioteca de validação de campo
        $this->load->library('form_validation');
        //define as regras de validação
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required', array(
            'required' => 'Digite um %s.'
                )
        );

        $this->form_validation->set_rules('nome', 'nome', 'trim|required', array(
            'required' => 'Digite um %s.'
                )
        );
		/*$this->form_validation->set_rules('cards[]', 'Cartão de Visitante', 'required', array(
            'required' => 'Selecione um %s.'
                )
        );*/

        //define como será o alerta de erro
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        //se algum campo não foi preenchido, recarrega a página, senão, salva os dados
        if ($this->form_validation->run() == true) {
			
            try {
                if($dadosForm['tipo'] == 'morador') {
                    if ($this->documento->selectUsuarioCPF($dadosForm['cpf'])) {
                        $doc = $this->documento->selectUsuarioCPF($dadosForm['cpf']);
                        $morador = $this->usuario->listarMoradorCpf($doc[0]['id_documento']);
                        $visitante = $this->usuario->listarVisitanteCpf($doc[0]['id_documento']);
                        //print_r($visitante);
                        //die();
                        if (!empty($morador)) {
                            $this->checkin->setIdAcesso($morador[0]['id_acesso']);    
                        }
                        if (!empty($visitante)) {
                            $this->checkin->setIdAcesso($visitante[0]['id_acesso']);
                        }
                        $this->checkin->setNumeroCartao($dadosForm['numero']);
                        $this->checkin->setPerfilUsuario(autoriza()['tb_usuario_id_usuario']);
                        $registrado = $this->checkout->usuarioRegistrado($doc[0]['id_documento']);
                        if (!empty($registrado)) {
                            $this->session->set_flashdata("danger", "Entrada de usuário já registrada!");
                            return false;
                        } 
                        if ($this->checkin->entrada()) {
                            $this->session->set_flashdata("success", "Entrada registrada!");
                        } else {
                            $this->session->set_flashdata("danger", "Erro em registrar entrada!");
                        }

                    }    
                }
                
            	if ($dadosForm['tipo'] == 'visitante') {
                    
            		$this->visitante->setNome($dadosForm['nome']);
            		$this->visitante->setModoEntrada($dadosForm['modo_entrada']);
            		$this->visitante->setVeiculo($dadosForm['veiculo']);
                    if ($dadosForm['entrega'] == '') {
                        $this->visitante->setEntrega('0');
                    } else {
                        $this->visitante->setEntrega($dadosForm['entrega']);
                    }
            		$this->visitante->setPlaca($dadosForm['placa']);
            		$this->endereco->setRua($dadosForm['rua']);
            		$this->endereco->setLote($dadosForm['lote']);
            		$this->documento->setCpf($dadosForm['cpf']);
            		$this->documento->setRg($dadosForm['rg']);
            		if ($this->visitante->salvarVisitante()) {
                        $id_usuario = $this->usuario->ultimoUsuario();
                        $this->acesso->setUsuarioIdUsuario($id_usuario[0]['id_usuario']);
                        $this->acesso->salvarAcessoVisitante();
                        $id_acesso = $this->acesso->ultimoAcesso();
                        $this->checkin->setNumeroCartao($dadosForm['numero']);
                        $this->checkin->setPerfilUsuario(autoriza()['tb_usuario_id_usuario']);
                        $this->checkin->setIdAcesso($id_acesso[0]['id_acesso']);
                        if ($this->checkin->entrada()) {
                            $this->session->set_flashdata("success", "Entrada registrada!");
                        } else {
                            $this->session->set_flashdata("danger", "Erro em registrar entrada!");
                        }
                    } 
            		
            	}		

            } catch (Exception $e) {
                $this->session->set_flashdata('danger', $e->getMessage());
            } finally{
                redirect('/usuario/principal');
            }
        }

        $this->load->template('home/principal');
	}
}