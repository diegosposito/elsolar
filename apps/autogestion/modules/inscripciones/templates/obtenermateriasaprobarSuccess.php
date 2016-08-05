<script> 
$(document).ready(function(){    
	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirexamen'); ?>",
    	    { idmesaexamen: Id, idalumno: $('#idalumno').val() },
    	    function(data){
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriasaprobar?idalumno='); ?>"+<?php echo $alumno->getIdalumno(); ?>);	    	     	    	
        	}
		);
		return false;
	});

	$(".botonEliminar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Elimina el profesor a dicha mesa de examen
    	$.post("<?php echo url_for('inscripciones/eliminarinscripcionexamen'); ?>",
    		{ idmesaexamen: Id, idalumno: $('#idalumno').val() },
    	    function(data){
    			alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriasaprobar?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});	

	$(".botonSolicitar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('inscripciones/solicitarlibredeuda'); ?>",
    			{ id: Id, idalumno: <?php echo $alumno->getIdalumno(); ?>, tipo: 2 },
    	    function(data){
    			$('#mensaje').html(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriasaprobar?idalumno='.$alumno->getIdalumno()); ?>");   	    	
        	}
		);
		return false;
	});	
});
</script>
<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Inscripción para rendir a Mesas de Exámenes</h1>
	</td>
	</tr>
</table>
<blockquote>
<p style="font-size:12px">
	Alumno: <?php echo $alumno->getPersonas()->getApellido().", ".$alumno->getPersonas()->getNombre() ?><br>
	Id alumno: <?php echo $alumno->getIdalumno() ?><br>
	Nro. documento: <?php echo $alumno->getPersonas()->getNrodoc() ?><br>
</p>
</blockquote>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<?php if (!$estadolibredeuda) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Debe consultar en Administración por su Libre Deuda.</font></b></div></td>
  </tr>  	
  	<?php } ?>
	<?php if (!$activo) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Se debe inscribir al Ciclo Lectivo previamente.</font></b></div></td>
  </tr>  	
  	<?php } ?>  	
	<?php if (!$documentacionhabilitada) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Debe consultar en Secretaría porque existe documentación pendiente.</font></b></div></td>
  </tr>  	
  	<?php } ?>  
  	<?php if (!$estadodocumentacion) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>El alumno debe presentar documentación pendiente.</font></b></div></td>
  </tr>  
  	<?php } ?>
	<?php if (!$periodohabilitado) { ?>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"><b><font color=red>Se debe inscribir en un periodo habilitado.</font></b></div></td>
  </tr>  
  	<?php } ?>    	
  <tr>
    <td colspan="2" class="hed">Mesas de Examenes Publicadas:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="70%">Materia</td>
		      <td class="hed" align="center" width="15%">Fecha</td>
		      <td class="hed" align="center" width="15%">Condición</td>
		      <td class="hed" align="center" width="10%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($mesasdisponibles)>0) { ?>
		    <?php foreach ($mesasdisponibles as $mesadisponible): ?>
		    <tr bgcolor="<?php echo '#A9D322'; ?>">
		      <td align="center"><?php echo $mesadisponible->getIdmesaexamen(); ?></td>
		      <td><?php echo $mesadisponible->getCatedras()->getMateriasPlanes()." (".$mesadisponible->getIdcatedra().")"; ?></td>
		      <td align="center"><?php echo $mesadisponible->getFecha(); ?></td>
		      <td align="center"><?php echo $mesadisponible->getCondicionesMesas(); ?></td>
		      <td align="center">
        		<form id="formInscribir" action="">  
				<?php if($estadolibredeuda && $periodohabilitado && $activo && $documentacionhabilitada && $estadodocumentacion) { ?>
					<input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
					<input type="submit" class="botonInscribir" id="<?php echo $mesadisponible->getIdmesaexamen(); ?>" value="Inscribir" title="Inscribir" >
				<?php } else { ?>
				<?php if (!$estadolibredeuda && $solicitudpermitida) { ?>
				<input type="submit" class="botonSolicitar" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" id="<?php echo $mesadisponible->getIdmesaexamen(); ?>" >
				<?php } ?>		
				<?php } ?>
				</form>		
		      </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else { ?>
			    <tr>
			      <td align="center" colspan="5">No existen registros.</td>
			    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Mesas de Examenes inscriptas:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="70%">Materia</td>
		      <td class="hed" align="center" width="15%">Fecha</td>
		      <td class="hed" align="center" width="15%">Condición</td>
		      <td class="hed" align="center" width="10%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($mesasinscriptas)>0) { 
		  			$calendario = Doctrine_Core::getTable('Calendarios')->obtenerCalendario($alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $alumno->getIdsede());
		  	?>
			    <?php foreach ($mesasinscriptas as $mesa) { 
			    ?>
			    <tr>
			      <td align="center"><?php echo $mesa->getIdexamen(); //echo $mesa->getMesasExamenes()->getIdmesaexamen(); ?></td>
			      <td><?php echo $mesa->getMesasExamenes()->getCatedras()->getMateriasPlanes()." (".$mesa->getMesasExamenes()->getIdcatedra().")"; ?></td>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getFecha(); ?></td>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getCondicionesMesas(); ?></td>
			      <td align="center">
	        		<form id="formEliminar" action="">  
	        		<?php 
					if(($mesa->getMesasExamenes()->getIdestadomesaexamen()==2) or ($mesa->getMesasExamenes()->getIdestadomesaexamen()==1)){ 
						if ($fechaactual < $mesa->getMesasExamenes()->obtenerFechaCierre($plazoborrado, $calendario)) {
					?>	 
						<input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
						<input type="submit" class="botonEliminar" id="<?php echo $mesa->getIdmesaexamen(); ?>" value="Eliminar" title="Eliminar" >
					<?php 
						} 
					}
					?>
					</form>		
			      </td>
			    </tr>
			    <?php } ?>
		    <?php } else { ?>
			    <tr>
			      <td align="center" colspan="5">No existen registros.</td>
			    </tr>
		    <?php } ?>		    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>
