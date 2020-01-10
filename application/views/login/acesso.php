        
<div class="row justify-content-center align-items-center" style="height:100vh">
    <div class="col-md-4">
        <div class="card">
          <h1>Acesso</h1>
            <div class="card-body">
              <?php
                print validation_errors();
                echo form_open("acesso/logar");

                echo form_input(array(
                  "name" => "login",
                  "id" => "login",
                  "class" => "form-control mb-3",
                  "maxlength" => "255",
                  "placeholder" => "Login"
                ));
                //echo form_error("login");
                echo form_password(array(
                  "name" => "senha",
                  "id" => "senha",
                  "class" => "form-control",
                  "maxlength" => "255",
                  "placeholder" => "Senha"
                ));
                //echo form_error("senha");
                echo form_button(array(
                  "class" => "btn btn-primary mt-3",
                  "content" => "Entrar",
                  "type" => "submit",
                  "id" => "sendlogin"
                ));

                echo form_close();
              ?>
            </div>
        </div>
    </div>
</div>