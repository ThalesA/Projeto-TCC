<div class="lista mt-5">
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Rua</th>
                <th>Ações</th>
                <th>Taxa condominal</th>
                <th>Multa</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($usuarios as $key => $value) { ?>

	            <tr>
	                <td><?= $value['nome'] ?></td>
	                <td><?= $value['cpf'] ?></td>
	                <td><?= $value['rg'] ?></td>
	                <td><?= $value['rua'] ?></td>
	                <td><a href="<?php print base_url('index.php/usuario/alterar/'.$value['usuario_id_usuario']) ?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a> / <a href="<?php print base_url('index.php/usuario/excluir/'.$value['usuario_id_usuario']) ?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>
	                <td><a type="button" class="btn btn-primary" id="taxa" onclick="setaDadosModal('<?= $value['id_usuario'] ?>')" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" value="<?= $value['id_usuario'] ?>">Gerar taxa</a></td>
	                <td><a type="button" class="btn btn-primary" id="multa" onclick="setaDadosModal('<?= $value['id_usuario'] ?>')" data-toggle="modal" data-target="#exampleModal2" data-whatever="@getbootstrap">Gerar multa</a></td>
	            </tr>

        	<?php } ?>
        </tbody>
    </table>
</div>
<!--Popup taxa-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar taxa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php print base_url('index.php/taxa/salvarTaxa') ?>" method="post">
          <div class="form-group">
            <label for="taxa" class="col-form-label">Valor taxa</label>
            <input type="text" class="form-control" id="valor_taxa" name="valor_taxa">
          </div>
          <!--<div class="form-group">
            <label for="taxa" class="col-form-label">Pago</label>
            <div class="radio">
            <label>Sim</label>
              <input type="radio" name="pago" value="1">
            <label>Não</label>
              <input type="radio" name="pago" value="0">
            </div>
          </div>-->
          <div class="form-group">
            <label for="taxa" class="col-form-label">Data vencimento</label>
            <input class="form-control" type="date" name="data_vencimento" value="" id="data_vencimento">
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Gerar</button>

          <input type="hidden" name="id_usuario2" id="id_usuario2" value="">
        </form>
      </div>
        
    </div>
  </div>
</div>

<!--Popup multa-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar Multa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php print base_url('index.php/multa/salvarMulta') ?>" method="post">
          <div class="form-group">
            <label for="local">Tipo multa</label>
            <select name="id_tipo_multa" class="form-control">
              <option value="">Selecione</option>
              <?php foreach ($tipo_multa as $key => $value): ?>
                <option value="<?= $value['id_tipo_multa']?>"><?= $value['tipo_multa']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="obc" class="col-form-label">Observações</label>
            <textarea class="form-control" id="obc" name="obc"></textarea>
          </div>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Gerar</button>

          <input type="hidden" name="id_usuario" id="id_usuario" value="">
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  function setaDadosModal(valor) {
    document.getElementById('id_usuario').value = valor;
    document.getElementById('id_usuario2').value = valor;
  }
</script>