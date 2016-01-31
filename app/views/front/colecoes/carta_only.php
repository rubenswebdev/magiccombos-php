    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <p><a onclick="history.back()"  class="btn btn-warning" role="button">Voltar</a></p>
        <div class="row">
          <div class="col-sm-6 col-md-4">
          
            <div class="thumbnail">
              <img src="<?=get_img_carta($carta)?>" alt="<?=$carta['nome']?>">
              
              
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="caption">
            <p title="<?=$carta['hws']['have'].' Pessoa'.($carta['hws']['want'] > 1 ? 's' : '').' est'.($carta['hws']['want'] > 1 ? 'ão' : 'á').' passando essa carta!'?> "><a href="<?=get_url('cartas/have/'.$carta['cod']) ?>" class="btn btn-primary" role="button">Comprar <span class=" label label-default"><?=$carta['hws']['have']?></span></a></p>
            <p title="<?=$carta['hws']['want'].' Pessoa'.($carta['hws']['want'] > 1 ? 's' : '').' est'.($carta['hws']['want'] > 1 ? 'ão' : 'á').' querendo essa carta!'?> "><a href="<?=get_url('cartas/want/'.$carta['cod']) ?>" class="btn btn-success" role="button">Vender <span class=" label label-default"><?=$carta['hws']['want']?></span></a></p>
                <h4><?=$carta['nome']?></h4>

                <?php if(count($carta['tipos']) != 0):?>
                    <b>Tipos:</b>
                    <?php foreach ($carta['tipos'] as $key => $value) {
                      echo "<i>$value </i>";
                    } ?>
                <?php endif ?>

                <p><b>Descrição: </b><?=converte_mana($carta['descricao'],false)?></p>

                <?php if($carta['edicao'] != ''):?>
                  <p><b>Edição: </b><?=$carta['edicao']?></p>
                <?php endif ?>

                <?php if($carta['raridade'] != ''):?>
                  <p><b>Raridade: </b><?=$carta['raridade']?></p>
                <?php endif ?>

                 <?php if($carta['idioma'] != ''):?>
                  <p><b>Idioma: </b><?=$this->get_idioma($carta['idioma'])?></p>
                <?php endif ?>

                 <?php if($carta['mana'] != ''):?>
                  <p><b>Custo de Mana: </b><?=converte_mana($carta['mana'])?></p>
                <?php endif ?>

                <?php if($carta['ataque'] != ''):?>
                  <p><b>Ataque: </b><?=$carta['ataque']?></p>
                <?php endif ?>

                <?php if($carta['resistencia'] != ''):?>
                  <p><b>Resistência: </b><?=$carta['resistencia']?></p>
                <?php endif ?>

                <?php if($carta['lealdade'] != ''):?>
                  <p><b>Lealdade: </b><?=$carta['lealdade']?></p>
                <?php endif ?>

                <?php if($carta['texto'] != ''):?>
                  <p><b>Texto: </b><i><?=$carta['texto']?></i></p>
                <?php endif ?>

              </div>
          </div>
        </div>

    </div>


      
</div><!--END DIV LATERAL-->
