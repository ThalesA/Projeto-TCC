<h1 class="mt-3">Cadastro multa</h1>
<?php
  print validation_errors();
  echo form_open("multa/salvarTipoMulta");
?> 

<div class="form-group">
  <?php
    echo form_label("Tipo multa", "tipo_multa");
    echo form_input(array(
      "name" => "tipo_multa",
      "type" => "text",
      "id" => "tipo_multa",
      "class" => "form-control"
    ));
  ?>
</div>

<label for="valor" class="col-form-label">Valor multa</label>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">R$</span>
  </div>
  <input class="form-control" type="number" name="valor_multa">
  <div class="input-group-append">
    <span class="input-group-text">,00</span>
  </div>
</div>

<div class="form-group mt-5">
  <?php
    echo form_button(array(
      "class" => "btn btn-primary",
      "content" => "Salvar",
      "type" => "submit",
      "id" => "salvar"
    ));
  ?>
</div>
<?php
  echo form_close();
?>
