<div class="row">
	<div class="col-md-2 col-md-offset-1">
		<strong>Emissão:</strong> <?php echo date('d/m/Y'); ?>
	</div>
	<div class="col-md-2 col-md-offset-1">
		<strong>Pedido:</strong> <?php echo $info['lastpedido']; ?>
	</div>
	<div class="col-md-2 col-md-offset-1">
		<strong>Prazo:</strong>
	</div>
	<div class="col-md-2">
		36 horas
	</div>
</div>
<p>
</p>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Usuário:
	</div>
	<div class="col-md-8">
		<?php
		foreach($user as $key){
			echo $key['nome']." ".$key['sobrenome']." | ".$key['telefone']." | ".$key['email'];
		}
		
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Identificação do Pedido:
	</div>
	<div class="col-md-8">
		<?php echo $info['observacao']; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Data Entrega:
	</div>
	<div class="col-md-8">
		<?php echo date('d/m/Y',strtotime("+ 36 hours")); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Observações:
	</div>
	<div class="col-md-8">
		
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Endereço pra entrega:
	</div>
	<div class="col-md-8">
		<?php
		foreach($enderecoEntrega as $key){
			echo $key['logradouro'].", ".$key['numero'].", ".$key['bairro'];
		}
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Quantidade:
	</div>
	<div class="col-md-8">
		<?php echo $info['quantidade']; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Centro de Custo:
	</div>
	<div class="col-md-8">
		<?php echo $info['centroCusto']; ?>
	</div>
</div>
<?php
$total = $info['total'];
$cnt = $info['cnt'];
for($i=1;$i<=$total;$i++){
	$tipo = $info['tipo'.$i];
	$profile = $info['idProfile'];
for($j=1;$j<=$cnt;$j++){
	if($info['arquivo'.$profile.$tipo.$j.$i]<>""){
?>

<div class="row">
	<div class="col-md-3 col-md-offset-1">
		Item
	</div>
	<div class="col-md-8">
		<?php echo $info['tipo'.$i]." | ".$info['coloracao'.$i]." | ".$info['gramatura'.$i]." | ".$info['formato'.$i]." | ".$info['lado'.$i]." | ".$info['arquivo'.$profile.$tipo.$j.$i]; ?>
	</div>
</div>

<?php
	}
}
}
?>

<p>
</p>

