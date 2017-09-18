<div class="posts">
	
	<?php 
	if (isset($_GET['cd_token'])){
		$token = $_GET['cd_token'];
	} elseif (isset($_POST['cd_token'])){
		$token = $_POST['cd_token'];
	}
	if (isset($token)){
		foreach($posts as $post) 
		{ ?>
		  	<div class="post">
			  	<div class="row titulo">
			  		<div class="foto">
			  			<?php echo '<img src=\'assets/img/' . $post->nm_foto . '\'/>'; ?>
			  		</div>
			  		<div class="nome">
				    	<b><?php echo $post->nm_nome; ?></b>
			  		</div>
			  	</div>
			  	<div class='row img'>
			  		<?php echo '<img src=\'assets/img/' . $post->nm_img . '\'/>'; ?>
			  	</div>
			  	<div class="curtir">
			  		
			  	</div>
			  	<div class="curtidas">
				    <b><?php echo $post->qtd_curtidas; ?> curtidas	</b>
			  	</div>
		  	</div>
		<?php } 
		} else {
			echo '<div><br><br><br><br><br><br><h1>Usuario não autenticado<br><br><br>Para visualizar os posts é necessário fazer login!</h1></div>';
		}
		?>
</div>