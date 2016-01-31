$(function(){
        //importador
            $(document).on("click","#importar",function(){
            
                var url = $("#url").val();
                $("#resultado").html('');
                $.post(base_url+'importador/listarEdicoes',{url:url},function(ret){
                    var retorno = JSON.parse(ret);

                    for (i in retorno){
                        $("#resultado").append('<li url="'+ retorno[i]['link'] +'" class="list-group-item list-group-item-warning idioma" >'+retorno[i]['nome']+'</li>');
                    }
                    
                    $.each($('.idioma'),function(){
                        var url = $(this).attr('url');
                        var idioma = $(this);
                        $.post(base_url+'importador/pegaEdicao',{url:url},function(retorno){
                            if(retorno){
                                idioma.addClass('list-group-item-success').removeClass('list-group-item-warning');
                                idioma.append(retorno); 
                            }
                        });
                        
                    
                    });
                
                });
            });
//FIM IMPORTADOR
})