    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <p><a href="<?=get_url('cartas/buscar/'.$this->segments(2)) ?>" class="btn btn-warning" role="button">Voltar</a></p>
       

          <div class="row">
            <div class="col-sm-12 col-md-12">
            <?php if(count($usuarios)>0){ ?>
                <table class="table table-striped">
                  <th>Usuário</th>
                  <th>Quantidade</th>
                  <th>Denuncias</th>
                  <th>Contato</th>
                  <th>Mensagem</th>
                  <th>Opções</th>
                  <?php  foreach ($usuarios as $id => $usuario) { ?>
                    <tr>
                        <td><?= $usuario['nome']?></td>
                        <td><?= $usuario['qtd']?></td>
                        <td><?= $usuario['denuncias']?></td>
                        <td><?= $usuario['email']?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target=".modal_msg_<?=$usuario['id']?>"><?= ($this->segments(1) == 'want' ? 'Vender' : 'Comprar')?></button></td>
                        <!-- Button trigger modal -->
						<td><button class="btn btn-danger " data-toggle="modal" data-target="#denunciar_<?=$usuario['id']?>">
						  Denunciar
						</button></td>

						 <?php if($this->auth->loged()) : ?>
						<div class="modal model_denuncia fade" id="denunciar_<?=$usuario['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Efetue a Denuncia</h4>
						      </div>
						      <div class="modal-body">
						      <form>
						        <div class="checkbox">
								    <label>
								      <input value="1" class="tipo_denuncia_<?=$usuario['id']?>" type="checkbox"> Não cumpriu o acordo
								    </label>
								</div>
								<div class="checkbox">
								    <label>
								      <input value="2" class="tipo_denuncia_<?=$usuario['id']?>" type="checkbox"> Não enviou o produto / Não pagou
								    </label>
								</div>
								<div class="checkbox">
								    <label>
								      <input value="3" class="tipo_denuncia_<?=$usuario['id']?>"  type="checkbox"> Enviou produto diferente
								    </label>
								</div>
								<div class="checkbox">
								    <label>
								      <input value="4" class="tipo_denuncia_<?=$usuario['id']?>"  type="checkbox"> Usou linguagem ofensiva
								    </label>
								</div>
						      </div>
						        <input type="hidden" class="cod_carta_<?=$usuario['id']?>" value="<?=$this->segments(2)?>">
						      </form>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						        <button type="button" id="enviar_denuncia_<?=$usuario['id']?>" id_denunciado = "<?=$usuario['id']?>" class="enviar_denuncia btn btn-primary">Denunciar</button>
						      </div>
						    </div>
						  </div>
						</div>
					 <?php else:?>
					 	<div class="modal fade" id="denunciar_<?=$usuario['id']?>"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Efetue Login para denunciar!</h4>
                                  </div>
                                  <div class="modal-body">
										<form class="navbar-form navbar-right" method="post" action="<?=get_url()?>home/index/<?= $this->segments(1)?>/<?= $this->segments(2)?>" role="form">
							              <div class="form-group">
							                <input type="text" placeholder="Login" name="login" class="form-control">
							              </div>
							              <div class="form-group">
							                <input type="password" placeholder="Password" name="senha" class="form-control">
							              </div>
							              <button type="submit" class="btn btn-success">Login</button>
							            </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                          
                                  </div>
                              </div>
                            </div>
                          </div>

                         <?php endif;?>
                         
                        <?php if($this->auth->loged()) : ?>
                          <div class="modal fade modal_msg  modal_msg_<?=$usuario['id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Envie sua mensagem!</h4>
                                  </div>
                                  <div class="modal-body">
                                    <textarea id="msg" class="msg_<?=$usuario['id']?> form-control"></textarea>
                                    <input type="hidden" class="cod_carta_<?=$usuario['id']?>" value="<?=$this->segments(2)?>">
                                    <input type="hidden" class="cod_colecao_<?=$usuario['id']?>" value="<?=$usuario['cod_colecao']?>">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="button" id_user="<?=$usuario['id']?>" id="enviar" class="btn enviar btn-primary">Enviar</button>
                                  </div>
                              </div>
                            </div>
                          </div>
                         <?php else:?>
                         	<div class="modal fade modal_msg_<?=$usuario['id']?>" id="modal_msg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Efetue Login para entrar em contato!</h4>
                                  </div>
                                  <div class="modal-body">
										<form class="navbar-form navbar-right" method="post" action="<?=get_url()?>home/index/<?= $this->segments(1)?>/<?= $this->segments(2)?>" role="form">
							              <div class="form-group">
							                <input type="text" placeholder="Login" name="login" class="form-control">
							              </div>
							              <div class="form-group">
							                <input type="password" placeholder="Password" name="senha" class="form-control">
							              </div>
							              <button type="submit" class="btn btn-success">Login</button>
							            </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                          
                                  </div>
                              </div>
                            </div>
                          </div>

                         <?php endif;?>
                    </tr>
                  <?php  } ?>
                </table>
              <?php }else{
                        echo '<br><span class="alert alert-warning">Não foi encontrado nenhum úsuario para sua busca!</span>';
                } ?>
            </div>
          </div>

        
    </div>


      
</div><!--END DIV LATERAL-->
