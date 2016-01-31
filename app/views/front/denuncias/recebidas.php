 <div class="col-sm-9 col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<div class="page-header">
				  <h3><?=@$title?></h3>
				</div>
	    		<div class="jumbotron">
			     	<table class=" table table-striped">
			     
				      <thead>
				        <tr>
				          
				          <th>Nome</th>
				          <th>Email</th>
				          <th>Motivo</th>
				          <th>Carta</th>
				          <th>Responda</th>
				          
				        </tr>
				      </thead>
				      <tbody>
				      <?php 
				      if(isset($denuncias))
				      	if(count($denuncias > 0))
				      	foreach (@$denuncias as $key => $denuncia) { ?>

				      		<tr>
				      			<td><?php echo $denuncia['usuario']['nome']?></td>
				      			<td><?php echo $denuncia['usuario']['email']?></td>
				      			<td><?php foreach ($denuncia['motivos_texto'] as $i => $texto) {
				      				echo $texto.'<br>';
				      			}?></td>
				      			<td><a href="<?=get_url('colecoes/carta/ver//'.$denuncia['cod_carta'])?>">Ver</a></td>
				      			<td><button class="btn btn-primary" data-toggle="modal" data-target=".modal_msg_<?=$denuncia['id_denunciante']?>">Responda</button></td>
						        <div class="modal fade modal_msg  modal_msg_<?=$denuncia['id_denunciante']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		                            <div class="modal-dialog modal-sm">
		                              <div class="modal-content">
		                                  <div class="modal-header">
		                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                    <h4 class="modal-title">Envie sua mensagem!</h4>
		                                  </div>
		                                  <div class="modal-body">
		                                    <textarea id="msg" class="msg_<?=$denuncia['id_denunciante']?> form-control"></textarea>
		                                    <input type="hidden" class="cod_carta_<?=$denuncia['id_denunciante']?>" value="<?=$denuncia['cod_carta']?>">
		                  
		                                  </div>
		                                  <div class="modal-footer">
		                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		                                    <button type="button" id_user="<?=$denuncia['id_denunciante']?>" id="enviar" class="btn enviar btn-primary">Enviar</button>
		                                  </div>
		                              </div>
		                            </div>
		                          </div>	
				      		</tr>
				       <?php } ?>
				      </tbody>
				    </table>
				</div>
</div>

</div><!--END DIV LATERAL-->