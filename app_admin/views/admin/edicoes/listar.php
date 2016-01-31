      <h2 class="sub-header">Cadastradas</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Idioma</th>
                <th>Cartas</th>
             
              </tr>
            </thead>
            <tbody>
            <?php foreach ($edicoes as $key => $edicao) { ?>
              <tr>
                <td><?=$edicao['nome']?></td>
                <td><?=$edicao['sigla']?></td>
                <td><?=$edicao['idioma']?></td>
                <td><a href="<?=$this->get_url('cartas/listar/'.$edicao['sigla'].'/'.$edicao['idioma'])?>"><?=$edicao['qtd_cartas']?></a></td>
               
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>