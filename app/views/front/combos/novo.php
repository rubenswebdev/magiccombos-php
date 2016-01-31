<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                   <div class="page-header">
                      <h3><?=@$title?></h3>
                    </div>
                   <p><a onclick="history.back()"  class="btn btn-warning" role="button">Voltar</a></p>
                
                    <div class="panel panel-default">
                      <div class="panel-heading">Novo Combo</div>
                        <div class="panel-body">    
                            <form class="">
                                <div class="form-group nome ">
                                  <label class="control-label" for="nome">Nome *</label>
                                  <input type="text" placeholder="Nome" value="" name="nome" id="nome" class="form-control">
                                </div>
                                 <div class="form-group">
                                  <label class="control-label" for="nome">Cartas </label>
                                  <input type="text" placeholder="Nome da Carta" value="" name="nome_carta" id="nome_carta" class="form-control">

                                </div>
                                <div class="form-group">
                                    <button type="button" id="buscar_cartas" class="btn btn-success">Buscar</button>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="alert alert-info">Resultado:</div>
                                        <div class="jumbotron ">
                                        
                                          <div class="row resultado">
                                          </div>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                       <div class="alert alert-info">Cartas que serão adicionadas ao combo:</div>
                                        <div class="jumbotron ">

                                          <div class="row add">
                                                <ul class="list-group" id="list_add">
                                                 
                                                </ul>

                                          </div>
                                        </div>
                                          <div class="form-group">
                                              <button type="button" id="cadastrar" class="btn btn-success">Cadastrar Combo</button>
                                          </div>
                                    </div>
                                </div>
                            </form>
                          </div>
                      </div>


                  
          </div>


          
    </div><!--END DIV LATERAL-->