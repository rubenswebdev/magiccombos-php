
        //amigos
         $(function(){
              $("#buscar").click(function(){
                    var nome_email = $("#nome_email").val();
                   
                    $.post(base_url+'amigos/buscar_amigos',{nome_email:nome_email},function(ret){
                        $(".resultado").html(ret);
                    });
                
              });

              $(".fc").fancybox();
              $(".tp").tooltipster({
                position: 'bottom'
              });

              

          });
        //FIM amigos