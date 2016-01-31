	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<div class="page-header">
				  <h3><?=@$title?></h3>
				</div>
	    		<div class="jumbotron">
			     	<table class="table table-striped">
			     
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>De</th>
				          <th>Email</th>
				          <th>Mensagem</th>
				          <th>Carta</th>
				          <th>Opções</th>
				        </tr>
				      </thead>
				      <tbody>
				      <?php 
				      if(isset($msgs))
				      if(count($msgs) > 0 )
				      foreach ($msgs as $m) { 
				      	    if(isset($m['mensagens']))
				      		if(count($m['mensagens']) > 0)
				      		foreach ($m['mensagens'] as $msg) {?>
							        <tr class="<?= (($msg['lida'] ==  0) ? 'success' : 'active')?>">
							          <td><?=date('d-m-Y H:i:s', @$msg['enviada_dia']->sec);?></td>
							          <td><?=$msg['nome'] ?></td>
							          <td><?=$msg['email'] ?></td>
							          <td><?=$msg['msg'] ?></td>
							          <td><a href="<?=get_url('colecoes/carta/ver/'.@$msg['cod_colecao'].'/'.$msg['cod_carta'])?>"><img class="media-object"  style="width:64px" src="<?=get_url('public/cartas/'.$msg['imagem_local'])?>" ></a></td>
							          <td><a class="btn btn-danger" href="<?= get_url('mensagens/excluir_msg/'.$msg['id'])?>">Excluir</a>  <button class="btn btn-primary" data-toggle="modal" data-target=".modal_msg_<?=$msg['id_remetente'].$msg['id']?>">Responder</button> </td>
							        	

			                          <div class="modal modal_msg fade modal_msg_<?=$msg['id_remetente'].$msg['id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			                            <div class="modal-dialog modal-sm">
			                              <div class="modal-content">
			                                  <div class="modal-header">
			                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                                    <h4 class="modal-title">Envie sua mensagem!</h4>
			                                  </div>
			                                  <div class="modal-body">
			                                    <textarea id="msg" class="msg_<?=$msg['id_remetente'].$msg['id']?> form-control"></textarea>
			                                    <input type="hidden" class="cod_carta_<?=$msg['id_remetente'].$msg['id']?>" value="<?=$msg['cod_carta']?>">
			                                    <input type="hidden" class="cod_colecao_<?=$msg['id_remetente'].$msg['id']?>" value="<?=$msg['cod_colecao']?>">
			                                    <input type="hidden" class="cod_colecao_<?=$msg['id_remetente'].$msg['id']?>" value="<?=$msg['cod_colecao']?>">
			                                  </div>
			                                  <div class="modal-footer">
			                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			                                    <button type="button" id_user="<?=$msg['id_remetente']?>" id_msg = "<?=$msg['id']?>" id="enviar" class="btn enviar btn-primary">Enviar</button>
			                                  </div>
			                              </div>
			                            </div>
			                          </div>
			                       
							        </tr>
				      <?php } } ?>
				        
				      </tbody>
				    </table>

			    </div>
	    </div>

    </div><!--END DIV LATERAL-->