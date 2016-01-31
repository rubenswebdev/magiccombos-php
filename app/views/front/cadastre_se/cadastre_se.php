<div class="row">
	<div class="col-md-12">
		<?php if(isset($erros)) echo '<span style="color:red">Preencha corretamente os campos em vermelho ou ative o javascript do navegador para uma melhor experiência.</span>';?>
	</div>
</div>
<div class="row">

 <form action="" method="post" name="cadastro" id="cadastro" role="form">
   <div class="col-md-6">
         <div class="panel panel-default">
	      <div class="panel-heading">Cadastre-se</div>
	      	<div class="panel-body">
	     			
			       <div class="form-group nome <?php if(isset($erros['nome'])) echo ($erros['nome'] == 1 ? 'has-error' : '')?>">
			          <label for="nome" class="control-label">Nome *</label>
			          <input type="text" class="form-control" id="nome" name="nome" value="<?=$this->post('nome')?>" placeholder="Nome">
			        </div>
			        <div class="form-group email <?php if(isset($erros['email']) ) echo ($erros['email'] == 1  ? 'has-error' : ''); if(isset($erros['email_existe'])) echo 'has-error' ;?>">
			          <label for="email" class="control-label">Email *</label>
			          <input type="text" class="form-control" id="email" name="email" value="<?=$this->post('email')?>" placeholder="Email">
			          <?php if(isset($erros['email_existe'])) echo '<span style="color:red">Este email já está cadastrado, digite outro ou efetue login na sua conta.</span>';?>
			        </div>
			        <div class="form-group login <?php if(isset($erros['login'])) echo ($erros['login'] == 1 ? 'has-error' : '') ; if(isset($erros['login_existe'])) echo 'has-error' ;?>">
			          <label for="login" class="control-label">Login *</label>
			          <input type="text" class="form-control" id="login" name="login" value="<?=$this->post('login')?>" placeholder="Login">
			           <?php if(isset($erros['login_existe'])) echo '<span style="color:red">Este login já está cadastrado, escolha outro.</span>';?>
			        </div>
			        <div class="form-group senha <?php if(isset($erros['senha'])) echo ($erros['senha'] == 1 ? 'has-error' : '')?>">
			          <label for="senha" class="control-label">Senha *</label>
			          <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
			        </div>
			        <div class="form-group senhac <?php if(isset($erros['senhac'])) echo ($erros['senhac'] == 1 ? 'has-error' : '')?>">
			          <label for="senhac" class="control-label">Confirme a Senha *</label>
			          <input type="password" class="form-control" id="senhac" name="senhac" placeholder="Confirme a senha">
			        </div>

			        <div class="form-group">
			          <p>* campos obrigatórios</p>
			        </div>
			        <button type="submit" id="cadastrar" class="btn btn-success">Cadastrar</button>


        	</div>
   		</div>
      
   </div>
  <div class="col-md-6">
  
    <div class="panel panel-default">
      <div class="panel-heading">Vai negociar? Essas informações podem ser adicionadas mais tarde.</div>
      <div class="panel-body">
     


     

       
        <div class="form-group documento <?php if(isset($erros['documento'])) echo ($erros['documento'] == 1 ? 'has-error' : '')?>">
          <label for="documento" class="control-label ">Documento</label>
          <input type="text"  data-mask="000.000.000-00" placeholder="CPF 000.000.000-00" data-mask-clearifnotmatch="true"  class="form-control" id="documento" name="documento" placeholder="CPF ou RG">
        </div>
          <div class="form-group">
            <label for="sexo">Sexo</label>
            <select name="sexo" class="form-control">
              <option value="m">Masculino</option>
              <option value="f">Feminino</option>
              <option value="xyz">XYZ</option>
            </select>
          </div>
        <div class="form-group dtnascimento <?php if(isset($erros['dtnascimento'])) echo ($erros['dtnascimento'] == 1 ? 'has-error' : '')?>">
          <label for="dtnascimento" class="control-label">Data de Nascimento</label>
          <input type="text" class="form-control" data-mask="00/00/0000" data-mask-clearifnotmatch="true" id="dtnascimento" name="dtnascimento" placeholder="Data de Nascimento">
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="receber_novidades" value="1"> Receber Novidades
          </label>
        </div>
        
      

       </div>
    </div>


 
  </div>
   </form>
</div>
