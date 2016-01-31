      <h2 class="sub-header"><?php  echo $subtitle['nome'] .' - '. strtoupper($subtitle['idioma']) ?></h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Mana</th>
                <th>Resistência</th>
                <th>Ataque</th>
             
              </tr>
            </thead>
            <tbody>
            <?php foreach ($cartas as $key => $carta) { ?>
              <tr>
                <td><a href="<?=$this->get_url('cartas/exibir/'.$carta['cod'])?>"><?=$carta['nome']?></a></td>
                <td><?=converte_mana($carta['mana'])?></td>
                <td><?=$carta['resistencia']?></td>
                <td><?=$carta['ataque']?></td>
               
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>