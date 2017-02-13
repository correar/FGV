<?php $i=1;
foreach ($profiles as $profile):	
        $idperfil = $profile['idperfil']; 
		$nome = $profile['nome'];
		$acabamento = $profile['acabamento'];
		$sobre = $profile['sobre'];
		$imagem = $profile['imagem'];
		$infos[$i]['idtipo'] = $profile['idtipo'];
		$infos[$i]['tipo'] = str_replace(' ','_',$profile['tipo']);
		$infos[$i]['idgramatura'] = $profile['idgramatura'];
		$infos[$i]['gramatura'] = $profile['gramatura'];
		$infos[$i]['idcoloracao'] = $profile['idcoloracao'];
		$infos[$i]['coloracao'] = $profile['coloracao'];
		$infos[$i]['idformato'] = $profile['idformato'];
		$infos[$i]['formato'] = $profile['formato'];
		$infos[$i]['idlado'] = $profile['idlado'];
		$infos[$i]['lado'] = $profile['lado'];
		$total = $i;
		$i++;
endforeach; 
//$this->session->unset_userdata('client_name');

?>


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
				<?php echo  str_replace('_',' ',$info['tipo'])." | ".$info['gramatura']." | ".$info['coloracao']." | ".$info['formato']." | ".$info['lado']; ?>
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
				<?php echo str_replace('_',' ',$info['tipo']);
				echo "<br>";
				echo $info['gramatura']." | ".$info['coloracao']." | ".$info['formato']." | ".$info['lado']; ?>
			</div>
			<div class="col-md-3 col-md-offset-6">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#upload_file<?php echo $info['tipo']; ?>">
					Upload
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				
				<div id="<?php echo $idperfil.$info['tipo']; ?>"></div>
				
				<?php $client_name = 'client_name'.$idperfil.$info['tipo']; 
				$cnt = $this->session->cnt;
				for($k = 1; $k <= $cnt; $k++){
					$client = $client_name.$k;
					echo $this->session->$client."<br>";
				}
				?>
				
				<?php //echo "Total ".$total; ?>
				<?php //echo "cnt ".$cnt; ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

<div class="row">
	<div class="col-md-10 col-md-offset-1 well">
		<?php echo validation_errors(); ?>
		<?php echo form_open('order/form'); ?>
			<div class="form-group">
				<label for="observacao">Observação</label>
				<input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo set_value('observacao'); ?>" placeholder="Observação">
			</div>
			<div class="form-group">
				<label for="quantidade">Quantidade</label>
				<input type="text" class="form-control" id="quantidade" name="quantidade" value="<?php echo set_value('quantidade'); ?>" placeholder="Quantidade">
			</div>
			<div class="form-group">
				<label for="centroCusto">Centro de Custo</label>
				<input type="text" class="form-control" id="centroCusto" name="centroCusto" value="<?php echo set_value('CentroCusto'); ?>" placeholder="Centro de Custo">
			</div>
			<div class="form-group">
				<label for="endereco">Endereço de Entrega</label>
				
				<select class="form-control" name="endereco" id="endereco">
					<?php foreach ($enderecosEntrega as $enderecoEntrega):	
						$idEnderecoEntrega = $enderecoEntrega['idenderecoEntrega'];
						$local = $enderecoEntrega['local'];
						echo '<option value="'.$idEnderecoEntrega.'">'.$local.'</option>';
					?>
					
					<?php endforeach; ?>
				</select>
			</div>
			<?php echo form_hidden('profile', $nome); 
			echo form_hidden('idprofile', $idperfil); 
			$i = 1;
			foreach ($infos as $info):
				//echo "i ".$i;
				$dataInfo = array(
					"idtipo" => $info['idtipo'],
					"tipo" => $info['tipo'],
					"idgramatura" => $info['idgramatura'],
					"gramatura" => $info['gramatura'],
					"idcoloracao" => $info['idcoloracao'],
					"coloracao" => $info['coloracao'],
					"idformato" => $info['idformato'],
					"formato" => $info['formato'],
					"idlado" => $info['idlado'],
					"lado" => $info['lado']
				);
				
				$client_name = 'client_name'.$idperfil.$info['tipo']; 
				$cnt = $this->session->cnt;
				for($k = 1; $k <= $cnt; $k++){
					$client = $client_name.$k;
					if($this->session->$client){
						$dataInfo['arquivo'.$idperfil.$info['tipo'].$k] = $this->session->$client;
						//echo "Arquivo ".$idperfil.$info['tipo'].$k." = ".$dataInfo['arquivo'.$idperfil.$info['tipo'].$k]."<br>";
					}
					
				}
				
				
				echo form_hidden('dataInfo'.$i,$dataInfo);
				$i++;
			endforeach;
			echo form_hidden('cnt', $cnt);
			echo form_hidden('total', $total);
			?>
			<button type="submit" class="btn btn-default">Enviar</button>
		</form>
	</div>
</div>