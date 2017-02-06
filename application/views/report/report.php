<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						
						<th># pedido</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Endereço de Entrega</th>
						<th>Observação</th>
						<th>Usuário</th>
						<th># Item</th>
						<th>Perfil</th>
						<th>Centro de Custo</th>
						<th>Quantidade</th>
						<th>Tipo</th>
						<th>Formato</th>
						<th>Gramatura</th>
						<th>Coloração</th>
						<th>Lado</th>
						<th>Arquivo</th>
					</tr>
					<?php foreach($reports as $report){ ?>
					<tr>
						<td><?php echo $report["idpedido"]; ?></td>
						<td><?php echo $report["dataPedido"]; ?></td>
						<td><?php echo $report["horaPedido"]; ?></td>
						<td><?php echo $report["logradouro"].", ".$report["numero"].", ".$report["bairro"]; ?></td>
						<td><?php echo $report["observacao"]; ?></td>
						<td><?php echo $report["nome"]; ?></td>
						<td><?php echo $report["iditem"]; ?></td>
						<td><?php echo $report["perfil"]; ?></td>
						<td><?php echo $report["centrocusto"]; ?></td>
						<td><?php echo $report["quantidade"]; ?></td>
						<td><?php echo $report["tipo"]; ?></td>
						<td><?php echo $report["formato"]; ?></td>
						<td><?php echo $report["gramatura"]; ?></td>
						<td><?php echo $report["coloracao"]; ?></td>
						<td><?php echo $report["lado"]; ?></td>
						<td><a href="<?php echo base_url("/assets/uploads/").$report["fkUser"]."/".str_replace(" ","_",$report["arquivo"]); ?>"><?php echo $report["arquivo"];?></a></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>