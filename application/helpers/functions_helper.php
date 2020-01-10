<?php

//componente datatable
function prepareDataTable($dados_tabela = '',$acoes = '',$labels = '',$controlador = ''){
	$data_table = '';
	if($dados_tabela != ''){	
		$dados['id_token'] = geraToken();			
		$dados['tabela'] = $dados_tabela;		
		$dados['exibeAcoes'] = false;
		$dados['exibeLabels'] = false;
		$dados['arg_controlador'] = $controlador;
		if($acoes !=''){
			$dados['exibeAcoes'] = $acoes;	
		}
		if($labels !=''){
			$dados['exibeLabels'] = $labels;	
		}
		$dados['acoes']	= $acoes;		
		$data_table = view_loader('layout_componentes/data_table.php',$dados,true);			
	}
	
	return $data_table;
}

function getDataTable(IDataTable $model, $acoes = '', $labels = '', $controlador = ''){	
	
	$data_table_1 = prepareDataTable($model->listaDataTable(),$acoes,$labels,$controlador);				
	return $data_table_1;
}

function getDataTableTwo(IDataTable $model, $acoes = '', $labels = '',$controlador = ''){
	
	$data_table = prepareDataTable($model->listaDataTableTwo(),$acoes,$labels,$controlador);			
	return $data_table;
}



function geraToken(){
	$token = sha1( uniqid( mt_rand() + time(), true ) );
	return $token;	
}
function formataDataToSave($data){	
	$arr = explode('/',$data);
	$novo_formato = $arr[2].'-'.$arr[1].'-'.$arr[0];
	return $novo_formato;
}
function formataDataToView($data){	
	$arr = explode('-',$data);
	$novo_formato = $arr[2].'/'.$arr[1].'/'.$arr[0];
	return $novo_formato;
}
function formataMoeda($valor){
	return number_format($valor,2,",",".");
}
function formataMoedaToSave($valor){
	return str_replace(',','.',str_replace('.','',$valor));	
}
function calculaDias($data1,$data2){
	$data1 = new DateTime( formataDataToSave($data1) );
	$data2 = new DateTime( formataDataToSave($data2) );	
	$intervalo = $data1->diff( $data2 );
	
	return $intervalo->d;
}



?>
