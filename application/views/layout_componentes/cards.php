<div class="cards-container"><div id="dialog-message-dar-baixa" class="hide">
    <p class="conteudo">
        Nome:<br />RG:
    </p>
</div>
<?php
	$numero_cartao = '';
	if(isset($cartao_selecionado)){
		$numero_cartao = $cartao_selecionado;
	}
	$total_cartoes = 50;
?>
	<h4 class="widget-title lighte grey pull-left" >
		<i class="ace-icon fa fa-credit-card blue"></i>
		Cartões de Visita (<?= $total_cartoes ?>)
	</h4>
	<span class="legend-wrap pull-right">
		<span class="legend"><span class="square cinza">cinza</span>Em uso (<?= count($cartoes_emprestados) ?>)</span>
		<span class="legend"><span class="square azul">azul</span>Disponível (<?= ($total_cartoes - count($cartoes_emprestados))?>)</span>
		<span class="legend"><span class="square amarelo">Amarelo</span>Selecionado</span>
		<span class="legend no-margin-right"><span class="square verde">Amarelo</span>Atual</span>
	</span>
				
<div class="hr hr8 hr-double" style="clear:both"></div>
<div class="space-12"></div>
<?php
	for($i = 1 ; $i <= $total_cartoes ; $i++){
		if(array_key_exists($i,$cartoes_emprestados) == true){
			if($numero_cartao == $i){							
				print '<label for="card-'.$i.'" class="card ativo atual" data-identrada = "'.$cartoes_emprestados[$i]->id.'" data-rg = "'.$cartoes_emprestados[$i]->rg.'" data-nome = "'.$cartoes_emprestados[$i]->nome.'" title="Visitante: '.$cartoes_emprestados[$i]->nome.' <br/>RG: '.$cartoes_emprestados[$i]->rg.'<br/>Entrada: '.$cartoes_emprestados[$i]->data_entrada.'">'.$cartoes_emprestados[$i]->numero_cartao.'</label>';
				print '<input type="radio" name="cards" class="card-radio emprestado" id="card-'.$i.'" checked="checked" />';
			}else{							
				print '<label for="card-'.$i.'" class="card emprestado" data-identrada = "'.$cartoes_emprestados[$i]->id.'" data-rg = "'.$cartoes_emprestados[$i]->rg.'" data-nome = "'.$cartoes_emprestados[$i]->nome.'" title="Visitante: '.$cartoes_emprestados[$i]->nome.'<br/> RG: '.$cartoes_emprestados[$i]->rg.'<br/>Entrada: '.$cartoes_emprestados[$i]->data_entrada.' <hr> Clique para dar baixa."><span class="numero">'.$cartoes_emprestados[$i]->numero_cartao.'</span><i class="fa fa-arrow-down" aria-hidden="true"></i></label>';
				//print '<input type="radio" name="cards" class="card-radio emprestado" id="card-'.$i.'" />';
			}
		}else{					
			print '<label for="card-'.$i.'" class="card ativo lb-card" title="Disponível">'.$i.'</label>';
			print '<input type="radio" name="cards" class="card-radio ativo" id="card-'.$i.'" value="'.$i.'" />';
		}
	}
?></div>

<script type="text/javascript">
    $(document).ready(function(){
		//evento sobre os cartões
		$('.card.emprestado').on('click',function(e){
				var conteudo = 'RG: '+$(this).data('rg')+'<br/>Nome: '+$(this).data('nome');
				var identrada = $(this).data('identrada');
				$('#dialog-message-dar-baixa .conteudo').html(conteudo);
				var dialog = $( "#dialog-message-dar-baixa" ).removeClass('hide').dialog({
					  modal: true,
					  title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Dar baixa?</h4></div>",
					  title_html: true,
					  buttons: [ 
						  {
							  text: "Não",
							  "class" : "btn btn-minier",
							  click: function() {
								  $( this ).dialog( "close" ); 
							  } 
						  },
						  {
							  text: "sim",
							  "class" : "btn btn-primary btn-minier",
							  click: function() {
								  $( this ).dialog( "close" ); 
								  
								  $.ajax({
									  url: "<?= base_url('index.php/cartas/registrarSaidaPorId/'); ?>/"+identrada+"", 
									  type: 'GET',										  						
									  success: function(result){								
										  $('.cards-container').empty().hide(100);
										  $('.cards-container').html(result).fadeIn(150);	
										  mostraMensagem('Saída registrada')
										  					  
									  }
								  });
							  } 
						  }
					  ]
				  });

		});
		//tooltips
		$( ".card" ).tooltip({
					track: true,
					html:true
				});
		//cartões
		$('.lb-card').click(function(){
			$('.lb-card').removeClass('selecionado');
			$(this).toggleClass('selecionado');
		});
		
		
		
		
		
		
		
    });
</script>