	
$('#faca-login').off('click').on('click',function(){
    $('#form-login').removeClass('hide');
    $('#form-cadastro').addClass('hide');
    console.log('faca-cadastro...');
});

$('#faca-cadastro').off('click').on('click',function(){
    $('#form-login').addClass('hide');
    $('#form-cadastro').removeClass('hide');
    console.log('faca-cadastro...');
});

$('.cadastre-se').off('click').on('click',function(){

	let dados = {
		nm_email: $('#nm_email').val(),
		nm_nome: $('#nm_nome').val(),
		nm_usuario: $('#nm_usuario').val(),
		nm_senha: $.md5($('#nm_senha').val())
	};

	$.post('?controller=usuario&action=cadastrar&type=rest', dados, function(data){
		data = JSON.parse(data);
		if (data.result){
			alert(data.msg);
		}else {
			alert(data.msg);
		}
	});

});

$('.login').off('click').on('click',function(){

	let dados = {
		nm_usuario: $('#nm_usuario2').val(),
		nm_senha: $.md5($('#nm_senha2').val())
	};

	console.log('dados',dados);

	$.post('?controller=usuario&action=login&type=rest', dados, function(data){
		console.log('data:: ',data);
		data = JSON.parse(data);
		if (data.result){
			let url = '?controller=posts&action=show&cd_token='+data.usuario.cd_token+'&nm_foto='+data.usuario.nm_foto;
			//window.location.href = ;
			$(location).attr("href", url);
		}else {
			alert(data.msg);
		}
	});

});

$('.btn-facebook').off('click').on('click', function(){
	alert('Função indisponivel...');
});
