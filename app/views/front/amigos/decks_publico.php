 <div class="col-sm-9 col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		
	    		<div class="jumbotron">

			      <div class="row">
                      <?php if(count($colecoes) > 0){ foreach ($colecoes as $id => $colecao){ ?>

                      <div class="col-sm-4 col-md-3">
                        <div class="thumbnail">
                          <a role="button" class="btn btn-primary btn-xs" href="<?=get_url('amigos/decks/'.$colecao['id_usuario'].'/ver/'.$id)?>">
                          	<img alt="" style="background :url(<?=$colecao['capa']?>) no-repeat center top; width: 205px; height: 116px;" >
                          </a>
                          <div class="caption">
                            <h5><?=$colecao['nome']?> - <span class="badge"><?=$colecao['tipo']?></span> - <?= count($colecao['cartas'])?> Cartas</h5>
                            <p><a role="button" class="btn btn-primary btn-xs" href="<?=get_url('amigos/decks/'.$colecao['id_usuario'].'/ver/'.$id)?>">Ver</a>
                              </p>
                          </div>

                        </div>
                       	<?php $this->get_like_fb(get_url('colecoes/ver/'.$id))?>
                      </div>
                     

                    <?php }  } else{ ?>
                        <span class="alert alert-warning">Ele ainda não cadastrou nenhuma coleção!</span>
                    <?php  } ?>
                     
                  </div>
				
				</div>
</div>

</div><!--END DIV LATERAL-->