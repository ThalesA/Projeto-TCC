<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Usuario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("Usuario_model", "usuario");
		$this->load->model("Morador_model", "morador");
		$this->load->model("Documento_model", "documento");
		$this->load->model("Endereco_model", "endereco");
		$this->load->model("Funcionario_model", "funcionario");
		$this->load->model("Acesso_model", "acesso");
		$this->load->model("Checkout_model", "checkout");
		$this->load->model("Checkin_model", "checkin");
		$this->load->model("Tipo_multa_model", "tipo");
	}

	public function principal() {
		autoriza();
		$usuario = autoriza();
		$usuario = $usuario['tb_usuario_id_usuario'];
		$perfil = $this->acesso->perfilMorador($usuario);
		@$ativo = $perfil[0]['ativo'];

		$acoes = 'registrarsaida';
		$labels = 'Dar baixa';
		$dados['grid_entradas'] = getDataTable($this->usuario, $acoes, $labels);
		$dados['grid_sem_baixa'] = getDataTableTwo($this->usuario, $acoes, $labels);

		$dados['data_table_historico'] = getDataTable($this->checkout);

		if($perfil) {
			$this->session->set_userdata("perfil_usuario",$perfil);
			if ($ativo == 0) {
				$this->load->template("alterar/alterar_senha");
			} else {
				$this->load->template("home_morador/index",$dados);
			}
			
		} else {
			$this->session->set_userdata("perfil_usuario",$perfil);
			$this->load->template('home/principal',$dados);
		}
		
	}

	public function registrarSaida($id) {
		try{
			$usuario_sistema = autoriza()['tb_usuario_id_usuario'];
			$checkin = $this->checkin->pegarIdCheckin($id);
			$this->checkout->setPerfilUsuario($usuario_sistema);
			$this->checkout->setIdCheckin($checkin[0]['id_checkin']);
			$this->checkout->setIdAcesso($checkin[0]['tb_acesso_id_acesso']);			
			if($this->checkout->saida() == true){
				$this->session->set_flashdata('success', 'Registro de saída efetuado.');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('danger', $e->getMessage());
		}finally{
			redirect('/usuario/principal');
		}
	}

	public function morador() {
		autoriza();
		$this->load->template("cadastro/morador");
	}
	public function funcionario() {
		autoriza();
		$this->load->template("cadastro/funcionario");
	}

	public function lista() {
		autoriza();
		
		$usuarios = $this->morador->listarMoradores();
		$tipo_multa = $this->tipo->listarTipoMulta();

		$dados["usuarios"] = $usuarios;

		$dados["tipo_multa"] = $tipo_multa;
		
		$this->load->template("cadastro/lista", $dados);
	}

	public function alterar($id) {
		autoriza();

		$usuario =  $this->usuario->listarUsuario($id);

		$dados = array("usuario"=> $usuario);

		$this->load->template("alterar/alterar_morador", $dados);
	}

	public function salvarMorador() {
		$form = $this->input->post(NULL, TRUE);

		//validação dos campos
		$this->load->library("form_validation");
		$this->form_validation->set_rules("login", "login", "trim|required");
		$this->form_validation->set_rules("senha", "senha", "trim|required");
		$this->form_validation->set_rules("nome", "nome", "trim|required");
		$this->form_validation->set_rules("cpf", "cpf", "trim|required");
		$this->form_validation->set_rules("rg", "rg", "trim|required");
		$this->form_validation->set_rules("rua", "rua", "trim|required");
		$this->form_validation->set_rules("lote", "lote", "trim|required");
		$this->form_validation->set_rules("possui", "possui", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso){

			try {
				$this->morador->setNome($form['nome']);
				$this->morador->setNomeveiculo($form['nomeveiculo']);
				$this->morador->setPlaca($form['placa']);
				$this->morador->setPossui($form['possui']);
				$this->documento->setCpf($form['cpf']);
				$this->documento->setRg($form['rg']);
				$this->endereco->setRua($form['rua']);
				$this->endereco->setLote($form['lote']);
				
				if($this->morador->salvar() == TRUE) {
					$id_usuario = $this->usuario->ultimoUsuario();
	            	$this->acesso->setUsuarioIdUsuario($id_usuario[0]['id_usuario']);
					$this->acesso->setLogin($form['login']);
					$this->acesso->setSenha($form['senha']);
					$this->acesso->salvarAcesso();
	                $this->session->set_flashdata("success", "Dados cadastrados com sucesso!");
	            } else {
	            	$this->session->set_flashdata("danger", "Dados não foram cadastrados!");
	            }
			} catch (Exception $e) {
                $this->session->set_flashdata('danger', $e->getMessage());
            } finally{
                redirect("usuario/morador");
            }
		}
		$this->morador();
		
	}

	public function salvarFuncionario() {
		$form = $this->input->post(NULL, TRUE);

		//validação dos campos
		$this->load->library("form_validation");
		$this->form_validation->set_rules("login", "login", "trim|required");
		$this->form_validation->set_rules("senha", "senha", "trim|required");
		$this->form_validation->set_rules("nome", "nome", "trim|required");
		$this->form_validation->set_rules("cpf", "cpf", "trim|required");
		$this->form_validation->set_rules("rg", "rg", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();
		
		if($sucesso){
			
			try{
				$this->funcionario->setNome($form['nome']);
				$this->documento->setCpf($form['cpf']);
				$this->documento->setRg($form['rg']);
				$this->endereco->setRua('');
				$this->endereco->setLote('');
				if($this->funcionario->salvarFunc() == TRUE) {
					$id_usuario = $this->usuario->ultimoUsuario();
	            	$this->acesso->setUsuarioIdUsuario($id_usuario[0]['id_usuario']);
					$this->acesso->setLogin($form['login']);
					$this->acesso->setSenha($form['senha']);
					$this->acesso->salvarAcesso();
	                $this->session->set_flashdata("success", "Dados cadastrados com sucesso!");
	            } else {
	            	$this->session->set_flashdata("danger", "Dados não foram cadastrados!");
	            }
			} catch (Exception $e) {
                $this->session->set_flashdata("danger", $e->getMessage());
            } finally{
                redirect("usuario/funcionario");
            }
		} 
		$this->funcionario();
	}


	public function alterarMorador() {
		$form = $this->input->post(NULL, TRUE);

		//validação dos campos
		$this->load->library("form_validation");
		$this->form_validation->set_rules("login", "login", "trim|required");
		$this->form_validation->set_rules("senha", "senha", "trim|required");
		$this->form_validation->set_rules("nome", "nome", "trim|required");
		$this->form_validation->set_rules("cpf", "cpf", "trim|required");
		$this->form_validation->set_rules("rg", "rg", "trim|required");
		$this->form_validation->set_rules("rua", "rua", "trim|required");
		$this->form_validation->set_rules("lote", "lote", "trim|required");
		$this->form_validation->set_rules("possui", "possui", "trim|required");
		
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>","</p>");

		$sucesso = $this->form_validation->run();

		if($sucesso){
			try {
				$this->acesso->setIdAcesso($form['id_acesso']);
				$this->acesso->setLogin($form['login']);
				$this->acesso->setSenha($form['senha']);
				$this->usuario->setIdUsuario($form['id']);
				$this->usuario->setIdDocumento($form['id_documento']);
				$this->usuario->setIdEndereco($form['id_endereco']);
				$this->usuario->setNome($form['nome']);
				$this->morador->setIdMorador($form['id_morador']);
				$this->morador->setNomeveiculo($form['nomeveiculo']);
				$this->morador->setPlaca($form['placa']);
				$this->morador->setPossui($form['possui']);
				$this->documento->setIdDocumento($form['id_documento']);
				$this->documento->setCpf($form['cpf']);
				$this->documento->setRg($form['rg']);
				$this->endereco->setIdEndereco($form['id_endereco']);
				$this->endereco->setRua($form['rua']);
				$this->endereco->setLote($form['lote']);
				//print_r($form);
				//die();
				if($this->morador->alterarMorador() != TRUE) {
	                $this->session->set_flashdata("success", "Dados alterados com sucesso!");
	            } else {
	            	$this->session->set_flashdata("danger", "Dados não foram alterados!");
	            }
			} catch (Exception $e) {
	            $this->session->set_flashdata('danger', $e->getMessage());
	        } finally {
	            redirect('/usuario/alterar/'.$form['id']);	
				//$this->editar($form['id']);
	        }
    	}
    	redirect('/usuario/alterar/'.$form['id']);
	}

	public function excluir($id) {

		try{
			if($this->usuario->deleteUsuario($id)){
				$this->session->set_flashdata('success', 'Dados Excluídos');
			} else {
				$this->session->set_flashdata('danger', 'Ocorreu um erro ao excluir o usuário!');
			}
		}catch(Exception $e){
			 $this->session->set_flashdata('danger', $e->getMessage());
		}finally{
            redirect($_SERVER['HTTP_REFERER']);
		}
		
    }
}