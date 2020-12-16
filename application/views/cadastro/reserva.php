<h1 class="mt-3">Cadastro reserva</h1>
<?php
  print validation_errors();
  echo form_open("tipo_reserva/salvarReserva");
?>
<div class="form-group">
  <?php
    echo form_label("Nome reserva", "nome");
    echo form_input(array(
      "name" => "nome",
      "type" => "text",
      "id" => "nome",
      "class" => "form-control"
    ));
  ?>
</div>
<div class="form-group">
  <?php
    echo form_label("Descrição", "descricao");
    echo form_textarea(array(
      "name" => "descricao",
      "id" => "descricao",
      "class" => "form-control"
    ));
  ?>
</div>
<div class="form-group">
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
