<script>
$(document).ready(function(){
	<?php if (count($calendarioss) == 1) { ?>
	$(".botonOcultar").show();
	$(".botonMostrar").hide();
	$(".cal").show();
	<?php } else { ?>
	$(".botonOcultar").hide();
	$(".botonMostrar").show();
	$(".cal").hide();
	<?php } ?>
	$(".botonOcultar").click(function(){   
		var Id = $(this).attr("id");	
		var indice = Id.substring(1);
		
		$('#calendario_'+indice).hide(400);
		$('#O'+indice).hide(400);
		$('#M'+indice).show(400);
	});  

	$(".botonMostrar").click(function(){ 
		var Id = $(this).attr("id");	
		var indice = Id.substring(1);
		
		$('#calendario_'+indice).show(400);
		$('#O'+indice).show(400);
		$('#M'+indice).hide(400);
	});  		 
});
</script>    
<div id="column2">
	<br>
	<h1>Bienvenido</h1>
	<?php if($usuario) { ?>
        <table class="stats" width="100%">
        	<tr>
        		<td colspan="2">Se accedio con el e-mail: <b><?php echo $usuario; ?></td>
        	</tr>
        	<tr>
        		<td width="50%">Area asignada: <b><?php echo $darea.' <a style="color:#FFFFFF"> ('.$idarea.')</a>'; ?></b></td>
        		<td width="50%">Sede asignada: <b><?php echo $dsede.' <a style="color:#FFFFFF"> ('.$idsede.')</a>'; ?></b></td>
        	</tr>
		</table> <br>      	        		
	<?php } else {?>
		<p>ALCEC.</p><br>
	<?php } ?>

<br>
</div>
