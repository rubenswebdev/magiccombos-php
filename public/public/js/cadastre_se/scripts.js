$(function(){
	$(document).on('click','#cadastrar',function(e){
		e.preventDefault();
		var email = $("#email").val();
		var documento = $("#documento").val();
		var nome = $("#nome").val();
		var login = $("#login").val();
		var dtnascimento = $("#dtnascimento").val();
		var ver_login;



		if(VerificaCPF() && login != '' && email != ''  && nome != ''){
			$( "#cadastro" ).submit();
		}else{
			
			if(nome == ''){
				$(".nome").addClass("has-error").removeClass("has-success");

			}
			if(dtnascimento != '' &&  validaDataNasc()==false){
				$(".dtnascimento").addClass("has-error").removeClass("has-success");
				
			}
			if(login == '' || validaLogin() ){
				$(".login").addClass("has-error").removeClass("has-success");

			}
			if(email == '' || validaEmail()){
				$(".email").addClass("has-error").removeClass("has-success");
			}
			if(senha == '' || senhac == ''  || validaSenha() == false){
				$(".senha").addClass("has-error").removeClass("has-success");
				$(".senhac").addClass("has-error").removeClass("has-success");

			}
			if(documento != '' ){
				if(VerificaCPF())
					$(".documento").addClass("has-error").removeClass("has-success");

			}
			alertify.error("Preencha corretamente os campos!");
			
		}

	});
		
	$(document).on('blur','#documento',function(){
		VerificaCPF();
	});	

	$(document).on('blur','#nome',function(){
		if($(this).val() != ''){
			$(".nome").addClass("has-success").removeClass("has-error");
		}else{
			$(".nome").addClass("has-error").removeClass("has-success");
		}
	});	

	$(document).on('blur','#dtnascimento',function(){
		validaDataNasc();
	});	

	$(document).on('blur','#login',function(){
		validaLogin();
	});	

	$(document).on('blur','#email',function(){
		validaEmail();
	});

	$(document).on('blur','#senha',function(){
		validaSenha();
	});

	$(document).on('blur','#senhac',function(){
		validaSenha();
	});

});


function validaDataNasc(){
	var dtnascimento = $("#dtnascimento").val();
	var ok = false;

	if(dtnascimento != ''){
		if(validaDat(dtnascimento)){
			ok = true;
			$(".dtnascimento").addClass("has-success").removeClass("has-error");
		}else{
			ok = false;
			$(".dtnascimento").addClass("has-error").removeClass("has-success");
			alertify.error("A data de nascimento "+dtnascimento+" não está em um formato válido ex: 31/12/2014");
		}
	}else{
		ok = false;
		$(".dtnascimento").addClass("has-error").removeClass("has-success");
	}

	if(ok == true){
		return true;
	}

	return false;
}

function validaEmail(){
	var email = $("#email").val();
	var ok = false;
	$.post(base_url+"ajax/verificar_email",{email:email},function(ret){
				if(ret == 'true'){
					alertify.error("Desculpa, este email já está sendo utilizado!");
					$(".email").addClass("has-error").removeClass("has-success");
					ok = true;
				}else{
					ok = false;
					if(IsEmail(email)){
						$(".email").addClass("has-success").removeClass("has-error");
						ok = true;
					}else{
						$(".email").addClass("has-error").removeClass("has-success");
						ok = false;
					}
				}
	});

	if(ok == true){
		return true;
	}

	return false;
}

function validaLogin(){
	var login = $("#login").val();
	$.post(base_url+"ajax/verificar_login",{login:login},function(ret){
				if(ret == 'true'){
					alertify.error("Desculpa, este login já está sendo utilizado!");
					$(".login").addClass("has-error").removeClass("has-success");
				}else{
					if(login != ''){
						$(".login").addClass("has-success").removeClass("has-error");

					}else{
						$(".login").addClass("has-error").removeClass("has-success");
					}
				}
	});
}

function validaSenha(){
	var senha = $("#senha").val();
	var senhac = $("#senhac").val();



	if(senha.length < 6){
		alertify.error('A senha deve conter no minimo 6 caracteres.');
		$(".senha").addClass("has-error").removeClass("has-success");
		return false;
	}else{
		$(".senha").addClass("has-success").removeClass("has-error");
		if(senhac != '')
		if(senha != senhac){
			alertify.error('A senhas são diferentes.');
			$(".senha").addClass("has-error").removeClass("has-success");
			$(".senhac").addClass("has-error").removeClass("has-success");
			return false;
		}else{
			$(".senha").addClass("has-success").removeClass("has-error");
			$(".senhac").addClass("has-success").removeClass("has-error");
			return true;
		}
	}
	return false;
}

function IsEmail(email){
	var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check=/@[\w\-]+\./;
	var checkend=/\.[a-zA-Z]{2,3}$/;
	if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
	else {return true;}
} 


function VerificaCPF() {
	if(document.cadastro.documento.value != ''){

		if (vercpf(document.cadastro.documento.value)){
				$(".documento").addClass("has-success").removeClass("has-error");
				return true;
		}else{
			alertify.error('Peencha com um CPF válido.');
			$(".documento").addClass("has-error").removeClass("has-success");
			return false;
		}
	}else{
		return true;
	}
}


function vercpf (cpf){
	cpf = cpf.replace('.','');
	cpf = cpf.replace('.','');
	cpf = cpf.replace('.','');
	cpf = cpf.replace('-','');
	if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
		return false;
		add = 0;
	for (i=0; i < 9; i ++)
	add += parseInt(cpf.charAt(i)) * (10 - i);
		rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(9)))
		return false;
	add = 0;
	for (i = 0; i < 10; i ++)
		add += parseInt(cpf.charAt(i)) * (11 - i);
	
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(10)))
		return false;
	return true;
}


function validaDat(valor) {
	var date=valor;
	var ardt=new Array;
	var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt=date.split("/");
	erro=false;
	if ( date.search(ExpReg)==-1){
		erro = true;
	}
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if ( ardt[1]==2) {
			if ((ardt[0]>28)&&((ardt[2]%4)!=0))
				erro = true;
			if ((ardt[0]>29)&&((ardt[2]%4)==0))
				erro = true;
	}
	if (erro) {
		return false;
	}
	return true;
}


