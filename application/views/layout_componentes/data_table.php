<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<!--<div class="table-header">
    Listagem
</div>-->
<table class="table table-striped table-bordered table-hover dynamic-table" id="example<?= $id_token ?>">
    <thead>
        <tr>
            <?php
            if($arg_controlador != ''){
                $controlador = $arg_controlador;
            } else {
                $controlador = $this->router->fetch_class();
            }
            $action = $this->router->fetch_method();


            foreach ($tabela['colunas'] as $key => $valor) {?>
                <th><?= $valor; ?></th>
            <?php } ?>    <!-- adicionado o if(exibeAcoes==false) para poder aparecer os campos editar e excluir! -->
               
                <?php
				$acao = $exibeAcoes;
				$arr_acao = explode(',',$acao);
				if((count($arr_acao) > 0) && $arr_acao[0] !=''){ ?>
					<th  style="text-align:center">A&ccedil;&otilde;es</th>
				<?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($tabela != false) {
            foreach ($tabela['linhas'] as $key => $linha) {
                ?>
                <tr class="">
                    <?php
                    foreach ($linha as $key => $coluna) {
                        ?>                        
                        <td><?= $coluna; ?></td>                        
                        <?php
                    }

					$acao = $exibeAcoes;
					$arr_acao = explode(',',$acao);
					$labels = $exibeLabels;
					$arr_labels = explode(',',$labels);
					
					if((count($arr_acao) > 0) && $arr_acao[0] !=''){
						?>
                        <td style="text-align:center">
                        <?php
						$contador = 1;
						foreach($arr_acao as $key_label => $valor){
							$barra_separadora = ($contador == 2)? '&nbsp; | &nbsp;':'';
							$existe_label = (((count($arr_labels) > 0) && $arr_labels[0] !='') && array_key_exists($key_label,$arr_labels))? true : false;
							if(!$existe_label){
								print  $barra_separadora.'<a href="' . base_url('index.php/' . $controlador) . '/'.$valor.'/' . $linha['id_checkin'] . '">'.ucfirst($valor).' </a>  ';
							}else{
								print  $barra_separadora.'<a href="' . base_url('index.php/' . $controlador) . '/'.$valor.'/' . $linha['id_checkin'] . '">'.$arr_labels[$key_label].' </a>  ';
							}
							$contador++;
						}
						?>
                        </td>
                        <?php
					}
                    ?>
                </tr>
                <?php
            }
        }
        ?>    
    </tbody>
</table>
<script type="text/javascript">
$(document).ready(function(){
        //initiate dataTables plugin
        var id = 'example<?= $id_token ?>';       
        configDataTable(id);
});
</script>
<?php //include_once('libs.php'); ?>