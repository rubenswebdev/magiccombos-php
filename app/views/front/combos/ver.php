<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                   <p><a onclick="history.back()"  class="btn btn-warning" role="button">Voltar</a></p>
                  <div class="row " id="combo">
                  <?php 
                    if(count(@$combo['cartas']) > 0 ){
                    foreach ($combo['cartas'] as $id => $c){ ?>

                        <div class="col-sm-3 col-md-2">
                          <div class="">
                            
                             <a class="fc" rel="galeria" href="<?=get_img_carta($c)?>" title="<?=$c['nome'].' - '.$c['edicao'].' - '.$this->get_idioma($c['idioma'])?>"  >
                              <img class="tp" title="<?=$c['nome'].' - '.$c['edicao'].' - '.$this->get_idioma($c['idioma'])?>" alt="<?=$c['nome']?>" src="<?=get_img_carta($c)?>" style="height: 160px;" >
                            </a>
                            <div class="caption">
                              <br/>
                                  <a role="button" class="btn btn-primary btn-xs" href="<?=get_url('colecoes/carta/ver//'.$c['cod'])?>">Ver</a>
                              <br/>
                              <br/>
                            </div>
                          </div>
                        </div>
                       
                    <?php }}else{ echo ' <div class="col-sm-12 col-md-12"><span class="alert alert-warning">Nenhuma carta cadastrada neste combo</span></div>'; } ?>
                     
                  </div>
                  <?php $this->get_comments_fb(get_url('combos/ver/'.$this->segments(2))); ?>
          </div>


          
    </div><!--END DIV LATERAL-->