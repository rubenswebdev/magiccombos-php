$(function(){

	$(document).on('click','.enviar',function(){
  		var id_usuario = $(this).attr('id_user');
  		var msg = $(".msg_"+id_usuario).val();
  		$(".msg_"+id_usuario).val('');
  		var cod_carta = $(".cod_carta_"+id_usuario).val();
  		var cod_colecao = $(".cod_colecao_"+id_usuario).val();

  		$.post(base_url+"mensagens/enviar_msg",{msg:msg,id_usuario:id_usuario,cod_carta: cod_carta,cod_colecao:cod_colecao},function(ret){
  			if(ret != null){
  					alertify.success('Sua Mensagem foi enviada! Aguarde contato!');
  					$('.modal_msg').modal('hide');
  			}
  		});
	});


  $(document).on('click','.enviar_denuncia',function(){
      id_denunciado = $(this).attr('id_denunciado');
      cod_carta = $(".cod_carta_"+id_denunciado).val();
    
      var sList = '';
      $('.tipo_denuncia_'+id_denunciado+'[type=checkbox]').each(function () {
          sList += (this.checked ? $(this).val()+"_" : "");
      });
      if(sList == ''){
        alertify.error('Escolha ao menos um motivo!');
      }else{


        $.post(base_url+"denuncias/denunciar",{lista:sList,id_denunciado:id_denunciado,cod_carta:cod_carta},function(ret){
         
          if(ret==1){
             alertify.success('Denuncia enviada com sucesso!');
             $('.model_denuncia').modal('hide');
          }else{
            alertify.error('Você já efetuou uma denuncia contra este usuário, Aguarde contato!');
            $('.model_denuncia').modal('hide');
          }
        });
       
      }

  });

});