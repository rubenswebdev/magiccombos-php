<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                 

                  <div class="row " id="colecao">
                  <?php 
                    if(count(@$cartas) > 0 ){
                    foreach ($cartas as $id => $c){ ?>

                        <div class="col-sm-3 col-md-2">
                          <div class="">
                            
                            <a class="fc" rel="galeria" href="<?=get_img_carta($c)?>" title="<?=$c['nome'].' - '.$c['edicao'].' - '.$this->get_idioma($c['idioma'])?>"  >
                              <img class="tp" title="<?=$c['nome'].' - '.$c['edicao'].' - '.$this->get_idioma($c['idioma'])?>" alt="<?=$c['nome']?>" src="<?=get_img_carta($c)?>" style="height: 160px;" >
                            </a>
                            <div class="caption">
                              <br/>
                                  <a role="button" class="btn btn-primary btn-xs" href="<?=get_url('colecoes/carta/ver/'.$this->segments(2).'/'.$c['cod'])?>">Ver</a>
                  
                              <br/>
                              <br/>
                            </div>
                          </div>

                        </div>
                       
                    <?php }}else{ echo ' <div class="col-sm-12 col-md-12"><span class="alert alert-warning">Nenhuma carta cadastrada nesta coleção</span></div>'; } ?>
                     
                  </div>
                  <?php $this->get_comments_fb(get_url('colecoes/ver/'.$this->segments(4))); ?>
          </div>


          
    </div><!--END DIV LATERAL-->
