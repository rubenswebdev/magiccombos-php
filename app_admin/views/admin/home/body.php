      <h2 class="sub-header">Estatísticas</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Usuários</th>
               
                <th>Combos</th>
                <th>Edições</th>
                <th>Cartas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$usuarios?></td>
               
                <td><?=$combos?></td>
                <td><a href="<?=$this->get_url('edicoes')?>"><?=$edicoes?></a></td>
                <td><?=$cartas?></td>
              </tr>
            </tbody>
          </table>
        </div>