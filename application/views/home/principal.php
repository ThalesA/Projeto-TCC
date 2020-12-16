<?php 
print form_open("registro/registrar", array('class' => 'form-horizontal'));
?>
    <div class="row">
        <div class="col-sm-6">
            <h4 class="widget-title lighte grey mt-4">
                <i class="fa fa-user"></i>
                Dados do Usuário
            </h4>
            <div class="form-group">
                <?php
                    print form_label('CPF', 'cpf', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <div class="input-group-btn"><?php
                        print form_input(
                            array(
                                'name' => 'cpf',
                                'id' => 'cpf',
                                'class' => 'form-control col-xs-10 col-sm-12',
                                'value' => '',
                                'maxlength' => '20',
                                'size' => '10'
                            ));
                        ?>
                     </div>
                </div>
            </div>
            <div class="form-group">
                <?php
                    print form_label('RG', 'rg', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <div class="input-group-btn"><?php
                        print form_input(
                            array(
                                'name' => 'rg',
                                'id' => 'rg',
                                'class' => 'form-control col-xs-10 col-sm-12',
                                'value' => '',
                                'maxlength' => '20',
                                'size' => '10'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php
                    print form_label('Nome', 'nome', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <?php
                        print form_input(
                            array(
                                'name' => 'nome',
                                'id' => 'nome',
                                'value' => '',
                                'maxlength' => '100',
                                'size' => '50',
                                'class' => 'form-control col-xs-10 col-sm-12'                 
                        ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <?php
                    print form_label('Número cartão', 'numero', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <div class="input-group-btn"><?php
                        print form_input(
                            array(
                                'name' => 'numero',
                                'type' => 'number',
                                'id' => 'numero',
                                'class' => 'form-control col-xs-10 col-sm-12',
                                'value' => '',
                                'maxlength' => '20',
                                'size' => '10'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                <?php
                    print form_label('Tipo', 'tipo', array(
                        'class' => 'control-label'
                        )
                    );
                ?>
                    <label class="col-sm-5">
                        <input name="tipo" type="radio" class="morador" value="morador" checked>
                        <span class="usu"> Cadastrado</span>
                    </label>
                    <label class="col-sm-4">
                        <input name="tipo" type="radio" class="visitante" value="visitante" >
                        <span class="visi"> Visitante</span>
                    </label>
               </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="ocultar">
            <div class="form-group">

                <div class="col-sm-9">
                    <?php
                        echo form_label("Endereço");
                        echo form_input(array(
                            "name" => "rua",
                            "type" => "text",
                            "id" => "rua",
                            "class" => "form-control mb-3 ",
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
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                <?php
                    print form_label('Modo entrada', 'modo_entrada', array(
                        'class' => 'control-label'
                        )
                    );
                ?>  
                    <label class="col-sm-4">
                        <input name="modo_entrada" type="radio" class="pedestre" value="pedestre" checked>
                        <span class="ped"> Pedestre</span>
                    </label>
                    <label class="col-sm-4">
                        <input name="modo_entrada" type="radio" class="veiculo" value="veiculo">
                        <span class="vei"> Veículo</span>
                    </label>
                    
               </div>
            </div>
            <div id="modo">
            <div class="form-group">
                <?php
                    print form_label('Nome veículo', 'veiculo', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <div class="input-group-btn"><?php
                        print form_input(
                            array(
                                'name' => 'veiculo',
                                'id' => 'veiculo',
                                'class' => 'form-control col-xs-10 col-sm-12',
                                'value' => '',
                                'maxlength' => '20',
                                'size' => '10'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php
                    print form_label('Placa veículo', 'placa', array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                        )
                    );
                ?>
                <div class="col-sm-9">
                    <div class="input-group-btn"><?php
                        print form_input(
                            array(
                                'name' => 'placa',
                                'id' => 'placa',
                                'class' => 'form-control col-xs-10 col-sm-12',
                                'value' => '',
                                'maxlength' => '20',
                                'size' => '10'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                    <input name="entrega" class="entrega" type="checkbox" value="1" id="entrega">
                    <label class="form-check-label" for="entrega">
                        Entrega
                    </label>
                </div>
            </div>
        </div>
        </div> 
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <?php
                print form_button(
                    array(
                        "class" => "btn btn-primary bt-entrada mb-3",
                        "content" => "<i class='fa fa-plus-square-o bigger-120 blue'></i> REGISTRAR ENTRADA",
                        "type" => "submit",
                        //"disabled" => true
                ));
            ?>
        </div>
    </div>
    <hr>

<?php
print form_close();
?>
<div class="tabbable">
    <ul class="nav nav-tabs" id="myTab">
    
        <li id="active">
            <a data-toggle="tab" href="#entradas-corrente" aria-expanded="true">
                <i class="fa fa-list-ul bigger-120"></i>&nbsp;&nbsp;&nbsp;
                Fila do Dia
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#historico-saidas" aria-expanded="false">
                <i class="fa fa-history bigger-120" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                Histórico de Registros   
            </a>
        </li>
        
        <li>
            <a data-toggle="tab" href="#entradas-sem-baixa" aria-expanded="false">
                <i class="fa fa-exclamation-triangle bigger-120" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                Sem baixa (Esquecidos/Não devolvidos)   
            </a>
        </li>
         
    </ul>   
    <div class="tab-content">
        <div id="entradas-corrente" class="tab-pane fade active in" aria-expanded="true">
             <?= $grid_entradas ?>
        </div>
        
        <div id="historico-saidas" class="tab-pane fade">
                 <?= $data_table_historico; ?>     
        </div>
        <div id="entradas-sem-baixa" class="tab-pane fade">
                 <?= $grid_sem_baixa; ?>     
        </div>                  
    </div>
</div>


<script>

  $(document).ready(() => {
    $('#ocultar').hide();
    $('.visitante').click(() => {
      $('#ocultar').show(1000);
    });
    $('.morador').click(() => {
      $('#ocultar').hide(1000);
    });

    $('#modo').hide();
    $('.veiculo').click(() => {
      $('#modo').show(1000);
    });
    $('.pedestre').click(() => {
      $('#modo').hide(1000);
    });

    $('#entradas-corrente').collapse()
  });

</script>