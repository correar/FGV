<!-- Modal -->
<div class="modal fade" id="upload_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class='container'>
				
				 <form id="data" />
				<!--<input type="file" name="userfile" size="20" />
				<input type="submit" value="upload" />
				</form>-->
				<p><span id="result1"></span></p>
				 <p>
				Select File: <input type='file' name='userfile' id='_file'> <input type='submit' id='_submit' value='Upload!'>
				</p>
				</form>
				<div class="progress col-md-6">
					<div id='_progress' class='progress-bar progress-bar-success progress-bar-striped' role="progressbar" aria-voluenow="0" aria-voluemin="0" aria-voluemax="100" style="width:0%"></div>
				</div>
				
			</div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
/*$(document).ready(function(){
	$('#_submit').click(function(){*/
$("form#data").submit(function(event){
		 event.preventDefault();
		/*var _file = $('#_file'),
		lg = _file[0].files.length,
		files_n = _file[0].files[0],*/
		var _progress = $('#_progress');
		/*if (lg == 0){
			return;
		}*/
		
		//alert(files_n.name);
		var file_name = new FormData($(this)[0]);
		//alert(file_name);
			/*
		file_name.append('SelectedFile', files_n);
		*/
		//file_name = files_n;
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
				$("#result1").html(result);
				_progress.animate({width:"100%"}, 100);
			}
		});
	//});
});
</script>