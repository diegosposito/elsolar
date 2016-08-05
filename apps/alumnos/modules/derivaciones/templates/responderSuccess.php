<script>
$(document).ready(function(){
	$("#oculto").attr('value', '1');
    $('#botonVer').click(function() {
		var oculto = $("#oculto").val();
        if(oculto ==1){
        	$.post("<?php echo url_for('derivaciones/ver'); ?>",
        			{ idexpediente:<?php echo $expediente->getIdexpediente(); ?> },
        			function(data){
        				$('#derivaciones').html(data);
        			}
        		);	 
        	$("#botonVer").attr('value', 'Ocultar');
        	$("#oculto").attr('value', '0');
        } else {
        	$('#derivaciones').html("");
        	$("#botonVer").attr('value', 'Ver Derivaciones');
        	$("#oculto").attr('value', '1');
		}
   	});  	
  
});
</script>
<h1>Derivar Expediente</h1>

<table cellspacing="0" class="stats" width="100%">
      <tr>
        <td width="25%"><b>Expediente:</b></td>
        <td><?php echo $expediente->getIdexpediente() ?></td>        
      </tr>
      <tr>
        <td><b>Fecha de solicitud:</b></td>
        <td><?php echo $expediente->getFechasolicitud() ?></td>        
      </tr>      
      <tr>
        <td><b>Alumno:</b></td>
        <td><?php echo $expediente->getAlumnos()->getPersonas() ?></td>        
      </tr>      
      <tr>
        <td><b>Diploma que solicita:</b></td>
        <td>
        <?php 
        if ($expediente->getAlumnos()->getPersonas()->getIdsexo()==1) {
        	echo $expediente->getTitulos()->getNombre();	
        } else {
        	echo $expediente->getTitulos()->getNombrefemenino();
        }
        ?>        
		</td>        
      </tr>   
      <tr>
        <td colspan="2" align="center">
        	<input type="hidden" name="oculto" value="" id="oculto">
        	<input type="button" value="Ver Derivaciones" id="botonVer">
		</td>
      </tr>   
      <tr>
        <td colspan="2" align="center"><div id="derivaciones" align="center"></div></td>
      </tr>                     
</table>
<br>
<?php if ($usuario=="biblioteca") { ?>
	<?php include_partial('formBiblio', array('form' => $form)) ?>
<?php } elseif ($usuario=="administracion") { ?>
	<?php include_partial('formAdmin', array('form' => $form)) ?>
<?php } ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('derivaciones/index') ?>'"></p>
<br>