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
		<p>Bienvenido al Sistema de Alumnos de la Universidad de Concepción del Uruguay.</p><br>
	<?php } ?>

    <?php if (count($solicitudess) > 0) { ?>
		<img src="/images/info.gif" width="30px" height="30px" align="left" /><a href='solicitudes' style="color:#4C94FA"><b>Existen Consultas de Alumnos pendientes de responder.</b></a><br>
	<?php } ?>

	<?php foreach ($noticias as $noticia): ?>
        <table class="stats" width="100%">
        	<tr>
        		<td bgcolor="#7b76b6">
					<?php if ($noticia['leer_mas']) { ?>
            			<h1><a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>"><font color="#000"><?php echo $noticia['titulo'] ?></font></a></h1>
            		<?php }else{ ?>
            			<h1><?php echo $noticia['titulo'] ?></h1>
					<?php } ?>	        		
        		</td>
        	</tr>
        	<tr>
        		<td bgcolor="#F4F2F3">
		            <?php echo htmlspecialchars_decode($noticia['intro']); ?>
            		<?php if ($noticia['leer_mas']) { ?>
            			<a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>">Leer más...</a>
            		<?php } ?>	        		
        		</td>
        	</tr>
        </table>
	<?php endforeach; ?>   
<br>
<table class="stats" width="100%">
    <tr>
      <td class="hed" align="center" colspan="4">CALENDARIO ACADEMICO</td>
    </tr>
    <?php if (count($calendarioss) > 0) { ?>
    <?php foreach ($calendarioss as $calendario) { ?>
	<tr>
		<td class="hed" align="center" colspan="3" width="95%"><?php echo $calendario->getFacultades(); ?></td>
		<td class="hed" align="center" width="5%">
			<input class="botonOcultar" id="O<?php echo $calendario->getIdcalendario(); ?>" type="submit" value="-">
			<input class="botonMostrar" id="M<?php echo $calendario->getIdcalendario(); ?>" type="submit" value="+">
		</td>
	</tr>
	<tr id="calendario_<?php echo $calendario->getIdcalendario(); ?>" class="cal">
		<td colspan="4">
		<table class="stats" width="100%">
		    <tr>
		      <td class="hed" align="center" width="40%">Descripción</td>
		      <td class="hed" align="center" width="35%">Tipo</td>
		      <td class="hed" align="center" width="10%">Inicio</td>
		      <td class="hed" align="center" width="10%">Fin</td>
		    </tr>	
				<?php 	
				    $fechass = Doctrine_Core::getTable('FechasCalendario')
						->createQuery('a')
						->where('idcalendario='.$calendario->idcalendario)
						->execute();
				?>
			 	<?php if (count($fechass) > 0) { ?>    
				    <?php foreach ($fechass as $fecha) { ?>
					<?php
						$date = new DateTime($fecha->getFin());
						$fin=$date->format('d-m-Y');
						$date1 = new DateTime($fecha->getInicio());
						$inicio=$date1->format('d-m-Y');
						if (($fecha->getFin() >= date("Y-m-d")) or (($fecha->getFin() < date("Y-m-d")) and (!in_array($fecha->getIdtipo(), array(4,5,6,12))))) {
					?>
				    <tr bgcolor='<?php if ($fecha->getFin() < date("Y-m-d")) {echo "#e6e4e9";} else {echo "#F9D32D";};?>'>
				      <td><?php echo $fecha->getDescripcion() ?></td>
				      <td align="center"><?php echo $fecha->getTiposFechasCalendario() ?></td>
				      <td align="center"><?php echo $inicio ?></td>
				      <td align="center"><?php echo $fin ?></td>     
				    </tr>
				    <?php }
					} ?>
				<?php } else { ?>
					<tr>
				      <td colspan="4" align="center">No existen fechas.</td>
					</tr>		
				<?php } ?>
		</table>
		</td>
	</tr>	
	<?php } ?>	
	<?php } else { ?>
		<tr>
	      <td colspan="4" align="center">No existen calendarios.</td>
		</tr>		
	<?php } ?>      
</table>
</div>
