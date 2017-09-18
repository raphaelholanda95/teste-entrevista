

	$('#nm_foto').off('change').on('change',function(){
		let token = $('#cd_token').val();

		if (token != null){
			let formData = new FormData();

			formData.append("cd_token", token);
			formData.append("nm_foto", document.getElementById("nm_foto").files[0]);
			let oReq = new XMLHttpRequest();
			oReq.open("POST", "?controller=posts&action=upload_foto&type=rest", true);
			oReq.onload = function(oEvent) {
				console.log('oEvent',oEvent);
			    if (oReq.status == 200) {
			      	console.log("Uploaded!",this.response);
			      	let data = JSON.parse(this.response);
			      	if(data.result){
			      		$('.icone4 img').attr('src','assets/img/'+data.img);
			      	} else {
			      		alert(data.msg);
			      	}
			    } else {
			      	console.log("Error " + oReq.status + " occurred when trying to upload your file.<br \/>");
			    }
			};

	  		oReq.send(formData);
		} else {
			alert('Usuario não autenticado, para inserir uma foto é necessario fazer o login!');
		}

	});

	setInterval(function(){


		let dados = {
			token: $('#cd_token').val(),
		};

		console.log('dados',dados);

		$.post('?controller=usuario&action=status&type=rest', dados, function(data){
			console.log('status:: ',data);
			data = JSON.parse(data);
			if (!data.result){
				alert(data.msg);
				$(location).attr('href', './');
			}

		});

	}, 10000);