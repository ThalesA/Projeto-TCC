<h1 class="mt-3">Alterar morador</h1>
  <?php
    print validation_errors();
    $hidden = array('id' => $this->uri->segment(3));
    echo form_open("usuario/alterarMorador", array('class' => 'form-horizontal'),$hidden);
    //print_r($usuario);
  ?>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <?php
        echo form_label("Login", "login");
        echo form_input(array(
          "name" => "login",
          "type" => "text",
          "id" => "login",
          "class" => "form-control",
          "value" => $usuario[0]['login']
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
          "class" => "form-control",
          "value" => $usuario[0]['senha']
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
          "class" => "form-control",
          "value" => $usuario[0]['nome']
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
          "class" => "form-control",
          "value" => $usuario[0]['cpf']
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
          "class" => "form-control",
          "value" => $usuario[0]['rg']
        ));
      ?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <?php
        echo form_label("Endereço");
        echo form_input(array(
          "name" => "rua",
          "type" => "text",
          "id" => "rua",
          "class" => "form-control mb-3",
          "placeholder" => "Rua",
          "value" => $usuario[0]['rua']
        ));
        echo form_input(array(
          "name" => "lote",
          "type" => "text",
          "id" => "lote",
          "class" => "form-control",
          "placeholder" => "Lote",
          "value" => $usuario[0]['lote']
        ));
      ?>
    </div>
    <div class="form-group">
      <legend class="col-form-label col-sm-2 pt-0">Possui veículo?</legend>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="possui" id="sim" value="sim">
          <label class="form-check-label" for="sim">
            Sim
          </label>
        </div>
      </div>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="possui" id="nao" value="nao">
          <label class="form-check-label" for="nao">
            Não
          </label>
        </div>
      </div>
      <input type="hidden" name="oculto" id="oculto" value="<?= $usuario[0]['possui']?>">
    </div>
    <div id="veiculo">
      <div class="form-group">
        <?php
          echo form_label("Nome veículo","nomeveiculo");
          echo form_input(array(
            "name" => "nomeveiculo",
            "type" => "text",
            "id" => "nomeveiculo",
            "class" => "form-control mb-3",
            "value" => $usuario[0]['nomeveiculo']
          ));
        ?>
      </div>
      <div class="form-group">
        <?php
          echo form_label("Placa veículo","placa");
          echo form_input(array(
            "name" => "placa",
            "type" => "text",
            "id" => "placa",
            "class" => "form-control mb-3",
            "value" => $usuario[0]['placa']
          ));
        ?>
      </div>
    </div>
  </div>
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
<input type="hidden" name="id_documento" id="id_documento" value="<?= $usuario[0]['tb_documento_id_documento']?>">
<input type="hidden" name="id_endereco" id="id_endereco" value="<?= $usuario[0]['tb_endereco_id_endereco']?>">
<input type="hidden" name="id_acesso" id="id_acesso" value="<?= $usuario[0]['id_acesso']?>">
<input type="hidden" name="id_morador" id="id_morador" value="<?= $usuario[0]['id_morador']?>">
  <?php
    echo form_close();
  ?>

<script>
  $(document).ready(() => {

    if($('#oculto').val() == 'sim') {
      $('#sim').prop("checked", true);
    } else {
      $('#nao').prop("checked", true);
    }

  });

</script>




