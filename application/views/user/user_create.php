<div class="container">
	<div class="row col-md-10 col-md-offset-1">
		<?php echo validation_errors(); ?>

		<?php echo form_open('user/user_create'); ?>
			<div class="form-group">
				<label for="nome">*Nome</label>
				<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
			</div>
			<div class="form-group">
				<label for="sobrenome">Sobrenome</label>
				<input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
			</div>
			<div class="form-group">
				<label for="email">*E-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
			</div>
			<div class="form-group">
				<label for="senha">*Senha</label>
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
			</div>
			<div class="form-group">
				<label for="telefone">Telefone</label>
				<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
			</div>
			<div class="form-group">
				<label for="departamento">Departamento</label>
				<input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento">
			</div>
			<div class="form-group">
				<label for="unidade">Unidade</label>
				<select class="form-control" name="unidade" id="unidade">
				<?php foreach($unidades as $unidade){ ?>
					<option value="<?php echo $unidade["idunidade"]; ?>"><?php echo $unidade["nome"]; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="permissao">Permissão</label>
				<select class="form-control" name="permissao" id="permissao">
					<option value="1">Super Usuário</option>
					<option value="2">Adminstrativo</option>
					<option value="3">Usuário</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Adicionar Usuário</button>
		</form>
	</div>
</div>