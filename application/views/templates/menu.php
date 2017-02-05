<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-2 col-md-offset-1">
						<img src="<?php echo base_url('assets/image/fgv_br.png'); ?>">
					</div>
					<div class="col-md-2 col-md-offset-2">
						<div id="datahora"></div>
						<script language="javascript" type="text/javascript">
							function atualizarDataHora(){
								//cria um objeto do tipo date
								var data = new Date();
							   
								// obtem o dia, mes e ano
								dia = data.getDate();
								mes = data.getMonth() + 1;
								ano = data.getFullYear();
							   
								//obtem as horas, minutos e segundos
								horas = data.getHours();
								minutos = data.getMinutes();
								segundos = data.getSeconds();
							   
								//converte as horas, minutos e segundos para string
								str_horas = new String(horas);
								str_minutos = new String(minutos);
								str_segundos = new String(segundos);
							   
								//se tiver menos que 2 digitos, acrescenta o 0
								if (str_horas.length < 2)
									str_horas = 0 + str_horas;
								if (str_minutos.length < 2)
									str_minutos = 0 + str_minutos;
								if (str_segundos.length < 2)
									str_segundos = 0 + str_segundos;
							   
								//converte o dia e o mes para string
								str_dia = new String(dia);
								str_mes = new String(mes);
							   
								//se tiver menos que 2 digitos, acrescenta o 0
								if (str_dia.length < 2) 
									str_dia = 0 + str_dia;
								if (str_mes.length < 2) 
									str_mes = 0 + str_mes;
							   
								//cria a string que sera exibida na div
								retorno = str_dia + '/' + str_mes + '/' + ano + ' | ' + str_horas + ':' + str_minutos + ':' + str_segundos;
   
								document.getElementById("datahora").innerHTML = retorno;
								setTimeout('atualizarDataHora()',1000);
							}
						</script>
					</div>
					<div class="col-md-3">
						<!--<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Sua Lista de pedidos está vazia -->
					</div>
					<div class="col-md-2">
						<?php echo $this->session->nome; ?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li><a href="<?php echo site_url(''); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início <span class="sr-only">(current)</span></a></li>
				<?php 
				if($this->session->categoria == 1){
				?>
				<li><a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Pedidos</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Relatório</a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Relatórios <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Por Pedido</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Por item</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Gráficos</a></li>
				  </ul>
				</li>
				<li><a href="<?php echo site_url('user/user'); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuários</a></li>
				<?php
				}
				?>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Suporte</a></li>
				<li><a href="<?php echo site_url('authentication/logout'); ?>" id="sair"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</div>
