$(function(){
	$(document).on('click','.enviar',function(){
		var id_usuario = $(this).attr('id_user');
		var id_msg = $(this).attr('id_msg');

		var msg = $(".msg_"+id_usuario+id_msg).val();
		$(".msg_"+id_usuario+id_msg).val('');
		var cod_carta = $(".cod_carta_"+id_usuario+id_msg).val();
		var cod_colecao = $(".cod_colecao_"+id_usuario+id_msg).val();

		$.post(base_url+"mensagens/enviar_msg",{msg:msg,id_usuario:id_usuario,cod_carta: cod_carta,cod_colecao:cod_colecao},function(ret){
				
				if(ret != null){
					alertify.success('Sua Mensagem foi enviada! Aguarde contato!');
					$('.modal_msg').modal('hide');
				}
		});
		
	});
});