$(function(){
          $(".fc").fancybox();
              $(".tp").tooltipster({
                position: 'bottom'
              });
        //colecoes
         $(function(){
              $("#buscar_cartas").click(function(){
                    var nome = $("#nome_carta").val();
                    var id_colecao = $("#id_colecao").val();
                    $.post(base_url+'colecoes/buscar_carta',{nome:nome,id_colecao:id_colecao},function(ret){
                        $(".resultado").html(ret);
                        
                    });
                
              });

              $(document).on('click','.add_carta',function(){
                    var id_carta = $(this).attr('id_carta');
                    var id_colecao = $("#id_colecao").val(); 

                    $.post(base_url+'colecoes/carta/add/',{id_carta:id_carta,id_colecao:id_colecao},function(ret){
                      if(ret == 4){
                          alertify.error("Já atingiu o limite de cartas!");
                        }else{
                          if(ret != 'erro'){
                              alertify.success("Carta Adicionada com Sucesso!");
                              $("#colecao").prepend(ret);
                          }
                        }

                    });

                    
              });

          });
        //FIM Colecoes


        $( "#nome_carta" ).keypress(function() {             
          $(function() {
            $( "#nome_carta" ).autocomplete({
              source: function(request, response) {
                $.ajax({ url: base_url+"ajax/buscar_cartas",
                data: { term: $("#nome_carta").val()},
                dataType: "json",
                type: "POST",
                success: function(data){
                  response(data);
                }

              });
            },
             select: function( event, ui ) {
                    $("#nome_carta").val(ui.item.value);
                    $("#buscar_cartas").click();
              },
            minLength: 2
            });
          });
        });



        $(document).on('click','.salvar',function(){
          var id_colecao =  $(this).attr('id_colecao');
          var nome = $("#novo_nome_"+id_colecao).val();
          var tipo = $("#tipo_"+id_colecao).val();
          var publico = $("#publico_"+id_colecao).val();


          $.post(base_url+'colecoes/renomear',{id_colecao:id_colecao,nome:nome,tipo:tipo,publico:publico},function(ret){
              if(ret == 1){
                alertify.success('Coleção alterada com sucesso!');


                window.setInterval(function(){
                  window.location.href = window.location.href;
                }, 500);


                $('.modal').modal('hide');
              }else{
                alertify.error('Erro ao editar Coleção');
              }
          });

        

        });
})