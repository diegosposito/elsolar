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
<h1>Modificar Expediente</h1>

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
		<td><b>Sede:</b></td>
		<td><?php echo $expediente->getSedes() ?></td>		
	</tr>      
      <tr>
        <td><b>Alumno:</b></td>
        <td><?php echo $expediente->getAlumnos()->getPersonas() ?></td>        
      </tr>
      <tr>
        <td><b>Nro. documento:</b></td>
        <td><?php echo $expediente->getAlumnos()->getPersonas()->getTiposDocumentos()." ".$expediente->getAlumnos()->getPersonas()->getNrodoc() ?></td>        
      </tr>  
      <tr>
        <td><b>Fecha de egreso:</b></td>
        <td><?php echo $expediente->getFechaegreso() ?></td>        
      </tr>                   
      <tr>
        <td><b>Diploma que solicita:</b></td>
        <td><?php echo $expediente->getAlumnos()->getPlanesEstudios()->getCarreras()->getTitulo() ?></td>        
      </tr>  
      <tr>
        <td colspan="2"><b>Estudios previos:</b></td>
      </tr> 
      <?php if (count($estudios)>0) { ?>
      <?php foreach ($estudios as $estudio) { ?>
      <tr>
        <td><b>Título:</b></td>
        <td><?php echo $estudio['descripcion'] ?></td>        
      </tr>    
      <tr>
        <td><b>Establecimiento:</b></td>
        <td><?php echo $estudio['establecimiento'] ?></td>        
      </tr>   
      <tr>
        <td><b>Ciudad:</b></td>
        <td><?php 
        $oCiudad = Doctrine_Core::getTable('Ciudades')->find($estudio->getIdciudad());
        echo $oCiudad->getDescripcion(); 
        ?></td>        
      </tr>                  
      <?php } ?>   
      <?php } else { ?> 
      <tr>
        <td colspan="2">No existen estudios previos cargados.</td>
      </tr>       
      <?php } ?>     
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
<?php include_partial('form', array('form' => $form)) ?>
