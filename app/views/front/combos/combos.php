 <div class="col-sm-9 col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<div class="page-header">
				  <h3><?=@$title?></h3>
				</div>
				<?=($this->segments(2) == 'ok') ? '<div class="alert alert-success  alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Combo removido com sucesso!</div><br><br><br>' : ''?>
	    			<?=($this->segments(2) == 'erro') ? '<div class="alert alert-danger  alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Erro ao remover !</div><br><br><br>' : ''?>
	    		<div class="jumbotron">
	    			<a class="btn btn-success" href="<?=get_url('combos/novo')?>">Novo</a>
	    			
			     	<table class=" table table-striped">
			     
				      <thead>
				        <tr>
				          
				          <th>Nome</th>
				          <th>Colaborador</th>
				          <th>Manas</th>
				         
				          <th>Opções</th>
				          
				        </tr>
				      </thead>
				      <tbody>
				      <?php 
				      if(isset($combos))
				      	if(count($combos > 0))
				      	foreach (@$combos as $combo) { ?>

				      		<tr>
				      			<td><a href="<?=get_url('combos/ver/'.$combo['id'])?>"><?php echo $combo['nome']?></a></td>
				      			<td><?php echo $combo['usuario']['nome']?></td>
				      			<td><?php foreach ($combo['manas_img'] as  $value) {
				      				echo $value;
				      			}?></td>
				      			<td><?php if($combo['id_usuario'] == $this->auth->get_data('id')): ?>
				      					<a href="<?= get_url('combos/remover/'.$combo['id']) ?>" class="btn btn-primary">Remova</a></td>
						        	<?php endif; ?>
				      		</tr>
				       <?php } ?>
				      </tbody>
				    </table>
				</div>
</div>

</div><!--END DIV LATERAL-->