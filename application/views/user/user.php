<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary" href="<?php echo site_url('user/user_create'); ?>" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Adicionar Usuário</span></a>
		</div>
	</div><p></p>
	<div class="row">
		<div class="col-md-12">
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						
						<th>Nome</th>
						<th>E-mail</th>
						<th>Telefone</th>
						<th>Departamento</th>
						<th>Unidade</th>
						<th>Permissão</th>
						<th>Status</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>
					<?php foreach($users as $user){ ?> 
					<tr>
						<td><?php echo $user["nome"]." ".$user["sobrenome"]; ?></td>
						<td><?php echo $user["email"]; ?></td>
						<td><?php echo $user["telefone"]; ?></td>
						<td><?php echo $user["departamento"]; ?></td>
						<td><?php echo $user["unidade"]; ?></td>
						<td><?php echo $user["permissao"]; ?></td>
						<td><?php if($user["status"] == 1){ echo "Ativo"; }else{ echo "Desativado"; } ?></td>
						<td><a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
						<td><a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
					</tr>
					<?php } ?>
				</table>
			</div>	
			
		</div>
	</div>
</div>