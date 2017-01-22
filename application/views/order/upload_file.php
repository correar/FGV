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
endforeach; 
//$this->session->unset_userdata('client_name');
//$this->session->sess_destroy();

?>
<?php foreach ($infos as $info): 

?>

<!-- Modal -->
<div class="modal fade" id="upload_file<?php echo $info['tipo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class='container'>
				
				<div class="row">
					<div class="col-md-6">
						<p>
							<?php echo $info['tipo']; ?>
							
						</p>
						<form id='data<?php echo $info['tipo']; ?>'  enctype="multipart/form-data">
						<p>
							Select File: <input type='file' name='userfile' id='_file'> <input type='submit' id='_submit' value='Upload!'>
						</p>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div id="result1"></div>
					</div>
				</div>
				<div class="row">	
					<div class="progress col-md-6">
						<div id='_progress' class='progress-bar progress-bar-success progress-bar-striped' role="progressbar" aria-voluenow="0" aria-voluemin="0" aria-voluemax="100" style="width:0%"></div>
					</div>
				</div>
			</div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
var frm = '<?php echo $info['tipo']; ?>';
$("form#data"+frm).submit(function(event){
		 event.preventDefault();
		 var cnt = '<?php echo $this->session->cnt; ?>';
		 		 
		 if (cnt == ''){
			 var i = 1;
		 }else{
			 var i = parseInt(cnt) + 1;
		 }
		
		var _progress = $('#_progress');
		var result1 = '<?php echo $info['tipo']; ?>';
		
		
		
		var file_name = new FormData($(this)[0]);
		file_name.append('tipo',result1);
		file_name.append('cnt',i);
		//file_name.append('id', j);

		$.ajax({
			type:'POST',
			data: file_name,
			url:'<?php echo site_url('order/upload_me'); ?>',
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){				
				_progress.animate({width:"30%"}, 100);
			},
			success: function(result){
				if (result == "erro")
				{
					_progress.animate({width:"0%"}, 100);
					
					$("#result1").html(result);
				}
				else{
					_progress.animate({width:"100%"}, 100);
					
					$("#"+result1).html(result);
				}
				
				
			}
		});
	
});
</script>

<?php  endforeach; ?>