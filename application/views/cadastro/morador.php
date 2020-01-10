<h1 class="mt-3">Cadastro morador</h1>
  <?php
    print validation_errors();
    echo form_open("usuario/salvarMorador");
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
          "placeholder" => "Rua"
        ));
        echo form_input(array(
          "name" => "lote",
          "type" => "text",
          "id" => "lote",
          "class" => "form-control",
          "placeholder" => "Lote"
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
    </div>
    <div id="veiculo">
      <div class="form-group">
        <?php
          echo form_label("Nome veículo","nomeveiculo");
          echo form_input(array(
            "name" => "nomeveiculo",
            "type" => "text",
            "id" => "nomeveiculo",
            "class" => "form-control mb-3"
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
            "class" => "form-control mb-3"
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
  <?php
    echo form_close();
  ?>

<script>

  $(document).ready(() => {
    $('#veiculo').hide();
    $('#sim').click(() => {
      $('#veiculo').show(1000);
    });
    $('#nao').click(() => {
      $('#veiculo').hide(1000);
    });
  });

</script>
