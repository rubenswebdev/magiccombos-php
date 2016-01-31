<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                 <div class="page-header">
				  <h3><?=@$title?></h3>
				</div>
                  <div class="row">
                    <div class="col-md-12">
                      <form method="post" class="form-inline" action="<?=get_url('colecoes/add')?>" role="form">
                              <div class="form-group">
                                <label class="sr-only"  for="nome_colecao">Criar uma nova Coleção</label>
                                <input type="text" class="form-control" name="nome_colecao" placeholder="Nome da Coleção">      
                                 <select name="tipo" class="form-control">
                                   <option value="deck">Deck</option>
                                   <option value="want">Want</option>
                                   <option value="have">Have</option>
                                   <option value="box">Box</option>
                                 </select>     
                              </div>
                              <button type="submit" id="buscar_cartas" class="btn btn-success">Nova Coleção</button>
                               <a role="button" onclick="history.back()"   class="btn btn-warning">Voltar</a>
                      </form>
                    </div>
                  </div>
                  <hr/>
                  <?php  if(isset($colecoes)) if(count($colecoes) > 0) foreach (@$colecoes as $id => $colecao){ ?>
                  <div class="modal fade" id="renomear_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Digite um novo nome para seu Deck</h4>
                              </div>
                              <div class="modal-body">
									<form role="form">
									
						              <div class="form-group">
						                <input type="text" placeholder="Novo nome" value="<?=$colecao['nome']?>" id="novo_nome_<?=$id?>" class="form-control">
						              </div>
						             <select id="tipo_<?=$id?>" class="form-control">
	                                   <option value="deck" <?= ($colecao['tipo'] == 'Deck' ? 'selected' : '')  ?>>Deck</option>
	                                   <option value="want" <?= ($colecao['tipo'] == 'Want' ? 'selected' : '')  ?>>Want</option>
	                                   <option value="have" <?= ($colecao['tipo'] == 'Have' ? 'selected' : '')  ?>>Have</option>
	                                   <option value="box" <?= ($colecao['tipo'] == 'Box' ? 'selected' : '')  ?>>Box</option>
	                                 </select> 

						              <div class="checkbox">
							             <label>
							                <input type="checkbox" value="1" <?php if($colecao['publico'] == 1) echo 'checked'?> id="publico_<?=$id?>">
							             Público</label>
						              </div>
							         
							         <button type="button" id_colecao="<?=$id?>" class="btn salvar btn-success">Salvar</button>
							       	
						           </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      
                              </div>
                          </div>
                        </div>
                      </div>
                      
                   <?php } ?>
                  <div class="row">
                      <?php if(count($colecoes) > 0){ foreach ($colecoes as $id => $colecao){ ?>



                      <div class="col-sm-4 col-md-3">
                        <div class="thumbnail">
                          <img alt="" style="background :url(<?=$colecao['capa']?>) no-repeat center top; width: 300px; height: 200px;" >
                          <div class="caption">
                            <h5><?=$colecao['nome']?> - <?=$colecao['tipo']?></h5>
                            <p><a role="button" class="btn btn-warning btn-xs" href="<?=get_url('colecoes/ver/'.$id)?>"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>
                            	<button role="button" data-toggle="modal" data-target="#renomear_<?=$id?>" class="btn btn-primary  btn-xs" id_colecao="<?=$id?>" ><span class="glyphicon glyphicon-pencil"></span> Editar</button>
                               <a role="button" class="btn btn-danger  btn-xs" href="<?=get_url('colecoes/excluir/'.$id)?>"><span class="glyphicon glyphicon-remove"></span> Excluir</a></p>
                          </div>

                        </div>
                        <?php $this->get_like_fb(get_url('colecoes/ver/'.$id))?>
                      </div>
                     	
                    <?php }  } else{ ?>
                        <span class="alert alert-warning">Você ainda não cadastrou nenhuma coleção!</span>
                    <?php  } ?>
                     
                  </div>
</div>


            
</div><!--END DIV LATERAL-->