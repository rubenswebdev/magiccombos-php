$(function(){
		$(".fc").fancybox();
    $(".tp").tooltipster({
      position: 'bottom'
    });


   
      
              $("#buscar_cartas").click(function(){
                    var nome = $("#nome_carta").val();
                    
                    $.post(base_url+'combos/buscar_carta',{nome:nome},function(ret){
                        $(".resultado").html(ret);
                        
                    });
                
              });



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




              $(document).on('click','.add_carta',function(){
                    var nome_carta = $(this).attr('nome_carta');
                    var edicao = $(this).attr('edicao');
                    var idioma = $(this).attr('idioma');
                    var id_carta = $(this).attr('id_carta');

                    

                    var texto = nome_carta+' - '+edicao+' - '+idioma;

                     var html = '<li class="list-group-item carta_to_add" id_carta="'+id_carta+'">'+texto+'</li>';
                     $("#list_add").append(html);

              });


              $("#cadastrar").click(function(){
                  var nome = $("#nome").val();
                  if(nome == ''){
                      alertify.error('O combo deve ter um nome!');
                      $(".nome").addClass('has-error').removeClass('has-success');
                  }else{
                      var sList = '';
                      $('.carta_to_add').each(function () {
                          sList += $(this).attr('id_carta')+'_';
                      });
                      if(sList == ''){
                        alertify.error('Escolha ao menos um motivo!');
                      }else{
                        $.post(base_url+'combos/add',{cartas:sList,nome:nome},function(ret){
                           if(ret == 1){
                            alertify.success('Combo Cadastrado com sucesso!');
                            $("#nome").val('');
                            $("#list_add").html('');
                            $(".resultado").html('');
                           }
                        });
                        
                      }
                  }
              });


    
    



});