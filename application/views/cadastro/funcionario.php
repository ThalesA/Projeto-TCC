<h1 class="mt-3">Cadastro funcionário</h1>
<?php
  print validation_errors();
  echo form_open("usuario/salvarFuncionario");
?>
<div class="form-group">
  <?php
    echo form_label("Login", "login");
    echo form_input(array(
      "name" => "login",
      "type" => "text",
      "id" => "login",
      "class" => "form-control"
    ));
  ?>
</div>
<div class="form-group">
  <?php
    echo form_label("Senha", "senha");
    echo form_input(array(
      "name" => "senha",
      "type" => "password",
      "id" => "senha",
      "class" => "form-control"
    ));
  ?>
</div>
<div class="form-group">
  <?php
    echo form_label("Nome", "nome");
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
    echo form_label("CPF", "cpf");
    echo form_input(array(
    	"name" => "cpf",
    	"type" => "text",
    	"id" => "cpf",
    	"class" => "form-control"
    ));
  ?>
</div>
<div class="form-group">
  <?php
    echo form_label("RG", "rg");
    echo form_input(array(
    	"name" => "rg",
    	"type" => "text",
    	"id" => "rg",
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
