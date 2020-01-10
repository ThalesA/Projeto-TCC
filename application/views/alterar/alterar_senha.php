<div class="row justify-content-center align-items-center" style="height:80vh">
    <div class="col-md-4">
        <div class="bloco">
          <h1 align="center">Alterar senha</h1>
            <div class="bloco-body">
              <?php
                print validation_errors();
                echo form_open("acesso/alterarAcesso");

                echo form_password(array(
                  "name" => "senha",
                  "id" => "senha",
                  "class" => "form-control mb-3",
                  "maxlength" => "255",
                  "placeholder" => "Senha"
                ));

                echo form_password(array(
                  "name" => "senha2",
                  "id" => "senha2",
                  "class" => "form-control",
                  "maxlength" => "255",
                  "placeholder" => "Confirmar senha"
                ));

                echo form_button(array(
                  "class" => "btn btn-primary mt-3",
                  "content" => "Alterar",
                  "type" => "submit",
                  "id" => "sendlogin"
                ));

                echo form_close();
              ?>
            </div>
        </div>
    </div>
</div>