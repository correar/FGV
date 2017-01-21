<?php echo $this->session->nome; ?>
<div class="container">
	<div class="row" style="padding-top:150px;">
		<div class="col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><span class="col-md-offset-3"><img src="<?php echo base_url("assets/image/fgv.png"); ?>"></span></div>
				<div class="panel-body">
					<?php echo validation_errors(); ?>
					<?php echo form_open(); ?>
						<div class="form-group">
							<label for="Email1">Email:</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="Password1">Senha:</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Senha">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Login</button>
						<p>
						<span><a href="#">Esqueci a Senha</a></span>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
