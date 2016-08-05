<h1>Correlatividades</h1>
<br>
<script>
$(document).ready(function(){	
	<?php if($estado != 1 and $sf_user->getGuardUser()->getIsSuperAdmin()==0 ){ ?>
		$('.botonAgregarCorrelativa').attr('disabled',true);
		$('.botonEliminarCorrelativa').attr('disabled',true);
	<?php } ?>
	$.post("<?php echo url_for('correlatividades/obtenermateriascorrelativas'); ?>",
		{ idplanestudio: <?php echo $idplanestudio; ?> },
		function(data){
			$('#materiasCorrelativas').html(data);
		}
	);

    $('.botonAgregarCorrelativa').click(function() {
		// guardar la informacion de documentacion del aspirante ingresada
   	    $.post("<?php echo url_for('correlatividades/agregar'); ?>",
   	    	$('#formAgregarCorrelativa').serialize(),
   			function(data){
	   	     	$.post("<?php echo url_for('correlatividades/obtenermateriascorrelativas'); ?>",
	   	     		{ idplanestudio: <?php echo $idplanestudio; ?> },
	   	     		function(data){
	   	     			$('#materiasCorrelativas').html(data);
	   	     		}
	   	     	);   
   			}
   	   	);
		return false;
   	}); 
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
<?php if($estado != 1 && !$sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
	<tr>
	<td>
		<font color="red">NOTA: El plan de estudios se encuentra activo.</font>
	</td>
	</tr>
<?php } ?>	
	<tr>
	<td>
		<?php include_partial('formCorrelativa', array('form' => $form)) ?>
	</td>
	</tr>
	<tr>
	<td>
		<div id="materiasCorrelativas" align="center"></div>
	</td>
	</tr>
</table>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('correlatividades/buscar') ?>'"></p>
<br>
