<?php $i=1;
foreach ($profiles as $profile):	
        $idperfil = $profile['idperfil']; 
		$nome = $profile['nome'];
		$acabamento = $profile['acabamento'];
		$sobre = $profile['sobre'];
		$imagem = $profile['imagem'];
		$infos[$i]['tipo'] = $profile['tipo'];
		$infos[$i]['gramatura'] = $profile['gramatura'];
		$infos[$i]['coloracao'] = $profile['coloracao'];
		$infos[$i]['formato'] = $profile['formato'];
		$infos[$i]['lado'] = $profile['lado'];
		$i++;
endforeach; ?>


<div class="row">
	<div class="col-md-2 col-md-offset-1">
		<img src="<?php echo base_url('assets/image/'.$imagem); ?>">
	</div>
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-11 col-md-offset-1">
				<?php echo $nome; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1">
				<?php echo $sobre; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1">
				<?php echo "Acabamento: ".$acabamento; ?>
			</div>
		</div>
		<?php foreach ($infos as $info): ?>
		<div class="row">
			<div class="col-md-11 col-md-offset-1">
				<?php echo $info['tipo']." | ".$info['gramatura']." | ".$info['coloracao']." | ".$info['formato']." | ".$info['lado']; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<p></p>
<?php foreach ($infos as $info): ?>
<div class="row">
	<div class="col-md-10 col-md-offset-1 well">
		<div class="row">
			<div class="col-md-3">
				<?php echo $info['tipo'];
				echo "<br>";
				echo $info['gramatura']." | ".$info['coloracao']." | ".$info['formato']." | ".$info['lado']; ?>
			</div>
			<div class="col-md-3 col-md-offset-6">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#upload_file">
  Launch demo modal
</button>



				
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
