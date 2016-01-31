 <div class="col-sm-9 col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<div class="page-header">
				  <h3><?=@$title?></h3>
				</div>
	    		<div class="row">
                      <div class="col-md-12">
                          
                              <div class="form-group">
                                <label class="sr-only"  for="nome_carta">Buscar Amigos</label>
                                <input type="text" class="form-control"  id="nome_email" placeholder="Nome ou email">

                              </div>
                              <div class="form-group">
                               	<button type="button" id="buscar" class="btn btn-success">Buscar</button>
                              </div>
                      </div>
                  </div>
                  <div class="row resultado">
                  		
                  </div>
	    		<div class="jumbotron">
			     	<table class=" table table-striped">
			     
				      <thead>
				        <tr>
				          
				          <th>Nome</th>
				          <th>Sobrenome</th>
				          <th>Email</th>
				          <th>Decks Público</th>
				          <th>Opções</th>
				        </tr>
				      </thead>
				      <tbody>
				      <?php 
				      if(isset($amigos[0]['amigos']))
				      	if(count($amigos[0]['amigos'] > 0))
				      	foreach (@$amigos[0]['amigos'] as $key => $amigo) { ?>

				      		<tr>
				      			<td><?php echo $amigo['nome']?></td>
				      			<td><?php echo $amigo['sobrenome']?></td>
				      			<td><?php echo $amigo['email']?></td>
				      			<td>
				      				
				      				<a href="<?=get_url('amigos/decks/'.$amigo['id_usuario'])?>">Visualizar decks</a></td>
				      				

						        <td>
						        		<a class="btn btn-danger" href="<?= get_url('amigos/desfazer/'.$amigo['id_usuario'])?>">Desfazer amizade</a>  
						        		<!--<a class="btn btn-primary" href="<?= get_url('amigos/bloquear/'.$amigo['id_usuario'])?>">Bloquear</a> -->
						       
						        </td>
						        	
				      		</tr>
				       <?php } ?>
				      </tbody>
				    </table>
				</div>
</div>

</div><!--END DIV LATERAL-->