 <div class="col-sm-9 col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<div class="page-header">
				  <h3><?=@$title?></h3>
				</div>

	    		<div class="jumbotron">
	    			<?=($this->segments(2) == 'ok') ? '<div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Denuncia removida com sucesso!</div><br><br><br>' : ''?>
	    			<?=($this->segments(2) == 'erro') ? '<div class="alert alert-danger  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Erro ao remover !</div><br><br><br>' : ''?>
			     	<table class=" table table-striped">
			     
				      <thead>
				        <tr>
				          
				          <th>Nome</th>
				          <th>Email</th>
				          <th>Motivo</th>
				          <th>Remova</th>
				          
				        </tr>
				      </thead>
				      <tbody>
				      <?php 
				      if(isset($denunciados))
				      	if(count($denunciados > 0))
				      	foreach (@$denunciados as $denuncia) { ?>

				      		<tr>
				      			<td><?php echo $denuncia['usuario']['nome']?></td>
				      			<td><?php echo $denuncia['usuario']['email']?></td>
				      			<td><?php foreach ($denuncia['motivos_texto'] as  $value) {
				      				echo $value.'<br>';
				      			}?></td>
				      			<td><a href="<?= get_url('denuncias/remover/'.$denuncia['id_denunciado']) ?>" class="btn btn-primary remover ">Remova</a></td>
						        	
				      		</tr>
				       <?php } ?>
				      </tbody>
				    </table>
				</div>
</div>

</div><!--END DIV LATERAL-->