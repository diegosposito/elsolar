<br>
<script>
$(document).ready(function(){    
	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirexamen'); ?>",
    	    { idmesaexamen: Id, idalumno: $('#idalumno').val() },
    	    function(data){
    	    	//$('#mensaje').html(data);
    	    	alert(data);	        	    
    	    	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriasaprobar?idalumno='); ?>"+<?php echo $alumno->getIdalumno(); ?>);
    	     	    	
        	}
		);
		return false;
	});

	$(".botonSolicitar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('alumnos/solicitarlibredeuda'); ?>",
    			{ id: Id, idalumno: <?php echo $alumno->getIdalumno(); ?>, tipo: 2 },
    	    function(data){
    			//$('#mensaje').html(data);
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
    			//$('#mensaje').html(data);
    			alert(data);	        	    
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriasaprobar?idalumno='); ?>"+<?php echo $alumno->getIdalumno(); ?>);
        	}
		);
		return false;
	});	
	
	$('#btnFilter').click(function() {
	    var filtro = $('#filtro').val();
	    
	    $('tr').show();
	    $('tr td.item').each(function() {
	        $(this).parent().hide();
	    });	

	    switch(filtro) {
	    case "libre":
		    $('tr td.libre').each(function() {
		        $(this).parent().show();
		    });		  
			break;
	    case "promocion":
		    $('tr td.promocion').each(function() {
		        $(this).parent().show();
		    });		
	        break;
	    case "regular":
		    $('tr td.regular').each(function() {
		        $(this).parent().show();
		    });		
	        break;	  
	    case "equivalencia":
		    $('tr td.equivalencia').each(function() {
		        $(this).parent().show();
		    });		
	        break;	  
	    case "todos":
		    $('tr td.item').each(function() {
		        $(this).parent().show();
		    });		
	        break;		                    
	} 	    	 	  

	});
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td class="hed">Alumno: <?php echo $alumno->getPersonas(); ?></td>
    <td > Filtrar por: 
    <select id="filtro">
    	<option value="todos">Todos</option>
  		<option value="libre">Libre</option>
  		<option value="promocion">Promoción</option>
  		<option value="equivalencia">Equivalencia</option>
  		<option value="regular">Regular</option>
	</select> 
	<button id='btnFilter'>Filtrar</button></td>
  </tr>    
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"></div></td>
  </tr>
  <?php if (!$estadodocumentacion) { ?>
  <tr>
    <td colspan="2" class="hed">El alumno debe presentar documentación pendiente.</td>
  </tr>  
  <?php } ?>
  <tr>
    <td colspan="2" class="hed">Mesas de Examenes disponibles:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="12%">Estado</td>
		      <td class="hed" align="center" width="5%">Fecha</td>
		      <td class="hed" align="center" width="10%">Condición</td>
		      <td class="hed" align="center" width="28%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody> 
		  	<?php if(count($mesasdisponibles)>0) { ?>
                    <?php $i=0;  ?>
		    <?php foreach ($mesasdisponibles as $mesadisponible): ?>
		    <tr class="fila_<?php echo $i%2 ; ?>">
		      <td align="center" class="item"><?php echo $mesadisponible->getIdmesaexamen(); ?></td>
		      <td class="<?php echo strtolower($mesadisponible->getCondicionesMesas()); ?>"><?php echo $mesadisponible->getCatedras()->getMateriasPlanes()." (".$mesadisponible->getIdcatedra().")"; ?></td>
		      <td align="center" class="item"><?php echo $mesadisponible->getEstadosMesasExamenes(); ?></td>
		      <td align="center">
		      <?php 
				$arr = explode('-', $mesadisponible->getFecha());
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
			  ?>	
		      <?php echo $fecha; ?>
		      </td>
		      <td align="center"><?php echo $mesadisponible->getCondicionesMesas(); ?></td>
		      <td align="center">	      
        		<form id="formInscribir" action="">  
        		<?php echo button_to('Ver', 'inscripciones/ver?idcatedra='.$mesadisponible->getIdcatedra().'&idalumno='.$alumno->getIdalumno(), array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?>
					<?php if($estadolibredeuda || $alumno->getIdplanestudio()==168){ ?>
					<?php if ($estadodocumentacion || $alumno->getIdplanestudio()==168) { ?>
					<input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
					<input type="submit" class="botonInscribir" id="<?php echo $mesadisponible->getIdmesaexamen(); ?>" value="Inscribir" title="Inscribir" >
					<?php } ?>
					<?php } else { ?>
					<input type="submit" class="botonSolicitar" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" id="<?php echo $mesadisponible->getIdmesaexamen(); ?>" >
					<?php }  ?>
				</form>		
		      </td>
		    </tr>
                    <?php $i++; ?>
		    <?php endforeach; ?>
		    <?php } else { ?>
			    <tr>
			      <td align="center" colspan="6">No existen registros.</td>
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
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="12%">Estado</td>
		      <td class="hed" align="center" width="5%">Fecha</td>
		      <td class="hed" align="center" width="10%">Condición</td>
		      <td class="hed" align="center" width="28%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($mesasinscriptas)>0) { ?>
			    <?php foreach ($mesasinscriptas as $mesa) { ?>
			    <tr>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getIdmesaexamen(); ?></td>
			      <td><?php echo $mesa->getMesasExamenes()->getCatedras()->getMateriasPlanes()." (".$mesa->getMesasExamenes()->getIdcatedra().")"; ?></td>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getEstadosMesasExamenes(); ?></td>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getFecha(); ?></td>
			      <td align="center"><?php echo $mesa->getMesasExamenes()->getCondicionesMesas(); ?></td>
			      <td align="center">
	        		<form id="formEliminar" action="">  
						<input type="hidden" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
						<input type="submit" class="botonEliminar" id="<?php echo $mesa->getIdmesaexamen(); ?>" value="Eliminar" title="Eliminar" >
					</form>		
			      </td>
			    </tr>
			    <?php } ?>
		    <?php } else { ?>
			    <tr>
			      <td align="center" colspan="6">No existen registros.</td>
			    </tr>
		    <?php } ?>		    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>
