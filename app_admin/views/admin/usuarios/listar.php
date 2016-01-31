      <h2 class="sub-header">Cadastrados</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Login</th>
                <th>Administrador</th>
                <th>Email</th>
             
             
              </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $key => $usuario) { ?>
              <tr>
                <td><?=$usuario['nome']?></td>
                <td><?=$usuario['login']?></td>
                <td><?=$usuario['admin'] ? 'Sim' : 'Não' ?></td>
                <td><?=$usuario['email'] ? $usuario['email'] : 'Não cadastrado' ?></td>
              
               
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>