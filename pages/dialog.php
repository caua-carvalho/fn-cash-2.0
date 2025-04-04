<?php  
	function Confirma($msg, $pagina){
		echo ' 
			<div class="modal fade" id="myModal" data-backdrop="static">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="font-weight-bolder text-success">Confirma</h4>
						</div>
						<div class="modal-body text-success">
							'.$msg.'
						</div>
						<div class="modal-footer text-center">
							<button class="btn btn-success" data-dismiss="modal" onclick="redirect()" style="width: 50%;">Ok</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				function redirect(){
					location.href = "'.$pagina.'";
				}
			</script>
		';
	}

	function Erro($msg){
		echo ' 
			<div class="modal fade" id="myModal" data-backdrop="static">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="font-weight-bolder text-danger">Erro</h4>
						</div>
						<div class="modal-body text-danger">
							'.$msg.'
						</div>
						<div class="modal-footer text-center">
							<button class="btn btn-danger" data-dismiss="modal" onclick="redirect()" style="width: 50%;">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				function redirect(){
					history.go(-1);
				}
			</script>
		';
	}
?>
