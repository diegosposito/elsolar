<br>
<script>
$(document).ready(function(){    
	$(".botonAgregar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Controla y agrega el profesor a dicha mesa de examen
    	$.post("<?php echo url_for('designacionesmesas/agregarprofesor'); ?>",
    	    	{ idmesaexamen: $('#idmesaexamen'+Id).val(), idtipodesignacionmesa: $('#idtipodesignacionmesa'+Id).val() , idprofesor: $('#idprofesor'+Id).val() },
    	    	function(data){
        	    	$('#formBuscar').submit(); 
        	    	alert(data);
        	    }
		);
		return false;
	});
	$(".botonEliminar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Elimina el profesor a dicha mesa de examen
    	$.post("<?php echo url_for('designacionesmesas/eliminarprofesor'); ?>",
    	    	{ iddesignacionmesa: $('#iddesignacionmesa'+Id).val() },
    	    	function(data){
        	    	$('#formBuscar').submit(); 
        	    	alert(data);
        	    }
		);
		return false;
	});	
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Materia: <?php echo $mesaexamen->getCatedras()->getMateriasPlanes(); ?></td>
  </tr>
  <tr>
    <td><b>Mesa de examen: <?php echo $mesaexamen; ?></b></td>
    <td><b>Carácter: <?php echo $caracter; ?></b></td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Profesores designados:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center">Profesor</td>
		      <td class="hed" align="center" width="20%">Nro. de Documento</td>
		      <td class="hed" align="center" width="15%">Carácter</td>
		      <td class="hed" align="center" >Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($designacionesmesas) > 0){ ?>
		    <?php foreach ($designacionesmesas as $designacion): ?>
		    <tr>
		      <td align="center"><?php echo $designacion->getProfesores()->getIdpersona(); ?></td>
		      <td><?php echo $designacion->getProfesores()->getPersonas(); ?></td>
		      <td align="center"><?php echo $designacion->getProfesores()->getPersonas()->getTiposDocumentos()." ".$designacion->getProfesores()->getPersonas()->getNrodoc(); ?></td>
		      <td align="center"><?php echo $designacion->getTiposDesignacionesMesas(); ?></td>
		      <td align="center">
        		<form id="formEliminarProfesor" action="">  
					<input type="hidden" id="iddesignacionmesa<?php echo $designacion->getId(); ?>" name="iddesignacionmesa" value="<?php echo $designacion->getId(); ?>">
					<input type="submit" class="botonEliminar" id="<?php echo $designacion->getId(); ?>" value="Eliminar" title="Eliminar" >
				</form>		
		      </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="6" align="center">No existen designaciones.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Profesores habilitados:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center">Profesor</td>
		      <td class="hed" align="center" width="20%">Nro. de Documento</td>
		      <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($designacionesmaterias) > 0){ ?>
		    <?php foreach ($designacionesmaterias as $designacion): ?>
		    <tr>
		      <td align="center"><?php echo $designacion->getProfesores()->getIdpersona(); ?></td>
		      <td><?php echo $designacion->getProfesores()->getPersonas(); ?></td>
		      <td align="center"><?php echo $designacion->getProfesores()->getPersonas()->getTiposDocumentos()." ".$designacion->getProfesores()->getPersonas()->getNrodoc(); ?></td>
		      <td align="center">
    			<form id="formAgregarProfesor" action="">  
					<input type="hidden" id="idtipodesignacionmesa<?php echo $designacion->getProfesores()->getIdpersona(); ?>" name="idtipodesignacionmesa" value="<?php echo $caracter->getIdtipodesignacionmesa(); ?>">
					<input type="hidden" id="idmesaexamen<?php echo $designacion->getProfesores()->getIdpersona(); ?>" name="idmesaexamen" value="<?php echo $mesaexamen->getIdmesaexamen(); ?>">
					<input type="hidden" id="idprofesor<?php echo $designacion->getProfesores()->getIdpersona(); ?>" name="idprofesor" value="<?php echo $designacion->getIdprofesor(); ?>">
					<input type="submit" class="botonAgregar" id="<?php echo $designacion->getProfesores()->getIdpersona(); ?>" value="Agregar" title="Agregar" >
				</form>		
		      </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="6" align="center">No hay profesores en condición de designar.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>