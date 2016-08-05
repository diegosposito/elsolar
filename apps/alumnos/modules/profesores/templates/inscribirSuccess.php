<h1>Inscripción de Profesor a Facultad</h1>

<script>
$(document).ready(function(){
	$('#tabs').tabs();
	$('#tabs').tabs('select', 0);	  
	$('#tipodocumento').attr('readonly',true);
	$('#nrodocumento').attr('readonly',true);	
	$('#provinciaestablecimiento').attr('disabled',true);
	$('#ciudadestablecimiento').attr('disabled',true);	
	<?php if($sf_user->hasCredential('inscripciones')) { ?>
	$('#tabs').tabs("option", "disabled", 4);	
	<?php } ?>
	$('#fechanacimiento').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	}); 
	$('#fechaemision').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	}); 
	<?php if ($activo==0){ ?>
	$('#nombre').attr('readonly',true);
	$('#apellido').attr('readonly',true);
	<?php } ?>
	<?php if ($idprofesor==0) { ?>
		$('#tabs').tabs("option", "disabled", [1,2,3,4,5]);	
	<?php } else { ?>
		$('#tabs').tabs("option", "disabled", []);
	<?php } ?>
	<?php if ($idciudadnac==0){ ?>
		$('#paisnacimiento').append("<option value='0' selected='selected' >----Seleccione----</option>");
		$('#provincianacimiento').attr('disabled',true);
		$('#ciudadnacimiento').attr('disabled',true);
	<?php }else{ ?>
    	$('#paisnacimiento').val(<?php echo $idpaisnac ?>);
		// cargar las provincias de la carrera al combo
		cargarComboProvincias('#provincianacimiento', <?php echo $idpaisnac ?>, <?php echo $idprovincianac ?>);
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadnacimiento', <?php echo $idprovincianac ?>, <?php echo $idciudadnac ?>);
	<?php } ?>
	<?php if ($idciudadres==0){ ?>
		$('#paisresidencia').append("<option value='0' selected='selected' >----Seleccione----</option>");
		$('#provinciaresidencia').attr('disabled',true);
		$('#ciudadresidencia').attr('disabled',true);
	<?php }else{ ?>
		$('#paisresidencia').val(<?php echo $idpaisres ?>);
		// cargar las provincias de la carrera al combo
		cargarComboProvincias('#provinciaresidencia', <?php echo $idpaisres ?>, <?php echo $idprovinciares ?>);
	    // cargar las ciudades de la carrera al combo
	    cargarComboCiudades('#ciudadresidencia', <?php echo $idprovinciares ?>, <?php echo $idciudadres ?>);
	<?php } ?>
	$('#paisnacimiento').change(function(){
    	$('#ciudadnacimiento').attr('disabled',true);
    	if($('#paisnacimiento').val()!=0){
	        // cargar las provincias de la carrera al combo
			cargarComboProvincias('#provincianacimiento', $(this).val(), 0);
        }
    });
   $('#provincianacimiento').focusin(function() {
   		// cargar las ciudades de la carrera al combo
       	cargarComboCiudades('#ciudadnacimiento', $(this).val(), 0);
    });  
    $('#provincianacimiento').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadnacimiento', $(this).val(), 0);
    });	
    $('#paisresidencia').change(function(){
    	$('#ciudadresidencia').attr('disabled',true);
    	if($('#paisresidencia').val()!=0){
	        // cargar las provincias de la carrera al combo
	        cargarComboProvincias('#provinciaresidencia', $(this).val(), 0);
        }
    });	
    $('#provinciaresidencia').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadresidencia', $(this).val(), 0);
    });	      
	// obtener la lista de estudios previos de la persona
	cargarEstudiosPrevios($('#idpersona').val());
    $('#paisestablecimiento').change(function(){
    	$('#ciudadestablecimiento').attr('disabled',true);
    	if($('#paisestablecimiento').val()!=0){
	        // cargar las provincias de la carrera al combo
	        cargarComboProvincias('#provinciaestablecimiento', $(this).val(), 0);
        }
    });	

    $('#provinciaestablecimiento').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadestablecimiento', $(this).val(), 0);
    });		
    $('#botonGuardarInfoPersonal').click(function() {
    	var validado = validarFormInfoPersonal();
    	//var validado = true;
    	$('#botonGuardarInfoPersonal').attr("disabled","disabled").delay(5000);

    	if(validado == true) {
            // guardar la informacion personal del profesor ingresada
    	    $.post("<?php echo url_for('profesores/guardarinformacionpersonal'); ?>",
    	    	$('#formGuardarInfoPersonal').serialize(),
    			function(data){
    	    		var obj = jQuery.parseJSON(data);
    				$('#mensajeInfoPersonal').html(obj.mensaje);
					if (obj.idpersona!=0){
	    				$('#idpersona').val(obj.idpersona);
	    				$('#formGuardarInfoPersonal #idprofesor').val(obj.idprofesor);
	    				$('#formGuardarContacto #idpersona').val(obj.idpersona);	    					    				
					}
    				$('#tabs').tabs("option", "disabled", []);
    			}
    	   	);
    	    
		} else {
			alert(validado);
		}	
    	window.setTimeout( function(){ $('#botonGuardarInfoPersonal').removeAttr("disabled") }, 5000 );

		return false;
   	});   
    $('#botonGuardarContacto').click(function() {
    	var validado = validarFormContacto();
    	
    	if(validado == true) {
	    	// guardar la informacion de contacto del profesor ingresada
			$.post("<?php echo url_for('profesores/guardarcontacto'); ?>",
    		   	$('#formGuardarContacto').serialize(),
    			function(data){
    				$('#mensajeContacto').html(data);
    			}
    		);
		} else {
			alert(validado);
		}	    		
		return false;
   	});
 	
    $('.botonAgregarEstudio').click(function() {
    	var validado = validarEstudioPrevio();
    	if(validado == true) {
	    	// guardar la informacion de estudios previos de la persona
	   	    $.post("<?php echo url_for('profesores/guardarestudioprevio'); ?>",
	   	    	$('#formAgregarEstudio').serialize(),
	   			function(data){
	   	    		$('#mensajeEstudio').html("El estudio previo ha sido guardado correctamente.");
					// obtener la lista de estudios previos de la persona
					cargarEstudiosPrevios($('#idpersona').val());							
	   			}
	   	   	);
		} else {
			alert(validado);
		}	   	   	
		return false;
   	}); 
});

// Valida el formulario
function validarFormInfoPersonal(){
	var regexpfecha = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;
		
	if (!regexpfecha.test($('#fechanacimiento').val())) {
		resultado = "Debe ingresar una Fecha de Nacimiento válida.";
	}	
		
	if($("#ciudadnacimiento").attr('disabled')) {
		resultado = "Debe seleccionar una Ciudad.";
	} 
 
	if($("#nombre").val()=="") {
		resultado = "Debe ingresar un Nombre.";
	} 

	if($("#apellido").val()=="") {
		resultado = "Debe ingresar un Apellido.";
	} 
		
	return resultado;
} 
function validarFormContacto(){
	var resultado = true;
	if($("#ciudadresidencia").attr('disabled')) {
		resultado = "Debe seleccionar una Ciudad.";
	} 

	return resultado;
} 
//Cargar combo de ciudades
function cargarComboCiudades(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('provincias/obtenerciudades'); ?>",
		{ idprovincia: id },
		function(data){
			if (data){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);	    	    	
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
} 
// Cargar combo de provincias
function cargarComboProvincias(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('paises/obtenerprovincias'); ?>",
    	    { idpais: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
    	    }
	); 	
} 
//Cargar estudios previos
function cargarEstudiosPrevios(id){
	// obtener la lista de estudios previos de la persona
	$.post("<?php echo url_for('personas/obtenerestudiosprevios'); ?>",
	    { idpersona: $('#idpersona').val() },
		function(data){
			$('#estudiosPrevios').html(data);
		}
	);   	
} 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Datos personales</a></li>
		<li><a href="#tabs-2">Contacto</a></li>
		<li><a href="#tabs-3">Estudios previos</a></li> 				
	</ul>
	<div id="tabs-1">
	<form action="" id="formGuardarInfoPersonal" method="post">
	  <table cellspacing="0" class="stats" width="100%">
	    <tfoot>
	      <tr>
	        <td colspan="6" align="center">
	        	<?php echo $form['idprofesor']->render() ?>
				<?php echo $form['idtipodocumento']->render() ?>		          
				<?php echo $form['idpersona']->render() ?>
				<?php echo $form['idfacultad']->render() ?>         				
         				
	          <input type="submit" value="Guardar" id="botonGuardarInfoPersonal"/>
	        </td>
	      </tr>
	    </tfoot>
	    <tbody>
	    	<tr>
	        <td colspan="4">
	        	<b><font color="red"><div id="mensajeInfoPersonal"></div></font></b>
	        </td>
	      </tr> 	
	      <tr>
	        <td width="17%">
	        	Facultad:
	        </td>
	        <td colspan="3">
	        	<?php echo $facultad ?>
	        </td>
	      </tr>	             
	      <tr>
	        <td>
	        	<?php echo $form['apellido']->renderLabel() ?>
	        </td>
	        <td width="15%">
	        	<?php echo $form['apellido']->render() ?>
	        </td>
	        <td width="15%">
	        	<?php echo $form['nombre']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nombre']->render() ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['tipodocumento']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['tipodocumento']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrodocumento']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrodocumento']->render() ?>
	        </td>
	      </tr>	  	      
	      <tr>
	        <td>
	        	<?php echo $form['idsexo']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['idsexo']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['estadocivil']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['estadocivil']->render() ?>
	        </td>
	      </tr>	      	      
	      <tr>
	        <td colspan="4">Lugar de Nacimiento:</td>
	      </tr>	 
		  <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['paisnacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['paisnacimiento']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['provincianacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['provincianacimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['ciudadnacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['ciudadnacimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td><?php echo $form['fechanacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['fechanacimiento']->render() ?> Ej: 22-08-1997
	        </td>
	      </tr>		
	      <tr>
	        <td><?php echo $form['legajo']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['legajo']->render() ?>
	        </td>
	      </tr>		            
	    </tbody>
	  </table>	
	  </form>
	</div>
	<div id="tabs-2">
	 <form action="" id="formGuardarContacto" method="post">
	  <table cellspacing="0" class="stats" width="100%">
	    <tfoot>
	      <tr>
	        <td colspan="6" align="center">
	          <?php echo $form['idpersona']->render() ?>
	          
	          <input type="submit" value="Guardar" id="botonGuardarContacto"/>
	        </td>
	      </tr>
	    </tfoot>	  
	    <tbody>
	      <tr>
	        <td colspan="6">
	        	<b><font color="red"><div id="mensajeContacto"></div></font></b>
	        </td>
	      </tr>
	      <tr>
	        <td width="7%">
	        	<?php echo $form['nombrecalle']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nombrecalle']->render() ?>
	        </td>
	        <td width="10%">
	        	<?php echo $form['nrocalle']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrocalle']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['barrio']->renderLabel() ?>
	        </td>
	        <td width="3%">
	        	<?php echo $form['barrio']->render() ?>
	        </td>       
	      </tr>  
	      <tr>
	        <td>
	        	<?php echo $form['edificio']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['edificio']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['piso']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['piso']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['depto']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['depto']->render() ?>
	        </td>
	      </tr>	      
	      <tr>
	        <td colspan="6"><b>Lugar de Residencia:</b></td>
	      </tr>	 	      
		  <tr>
	        <td></td>  
	        <td>
	        	<?php echo $form['paisresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['paisresidencia']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
		    <td></td>
	        <td>
	        	<?php echo $form['provinciaresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['provinciaresidencia']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['ciudadresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['ciudadresidencia']->render() ?>
	        </td>
	      </tr>		
		  <tr>
	        <td>
	        	<?php echo $form['nrotelefonofijo']->renderLabel() ?>
	        </td>
	        <td colspan="6">
	        	<?php echo $form['areatelefonofijo']->render() ?> - <?php echo $form['nrotelefonofijo']->render() ?>
	        </td>
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['nrotelefonomovil']->renderLabel() ?>
	        </td>
	        <td colspan="6">
	        	<?php echo $form['areatelefonomovil']->render() ?> - <?php echo $form['nrotelefonomovil']->render() ?>
	        </td>
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['email']->renderLabel() ?>
	        </td>
	        <td colspan="6">
	        	<?php echo $form['email']->render() ?>
	        </td>
	      </tr>		
		</tbody>
	  </table>
	  </form>
	</div>
	<div id="tabs-3">
	<form action="" id="formAgregarEstudio" method="post">
	  <table cellspacing="0" class="stats" width="100%">  
	    <tbody>
	      <tr>
	        <td colspan="4">
	        	<b><font color="red"><div id="mensajeEstudio"></div></font></b>
	        </td>
	      </tr>	 
	      <tr>
	        <td width="17%">
	        	<?php echo $form['titulo']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['titulo']->render() ?>
	        </td>
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['nivel']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['nivel']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['categoria']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['categoria']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['establecimiento']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['establecimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td colspan="4"><b>Lugar del Establecimiento:</b></td>
	      </tr>	 	      
		  <tr>
		  	<td></td>
	        <td width="13%">
	        	<?php echo $form['paisestablecimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['paisestablecimiento']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
		    <td></td>
	        <td>
	        	<?php echo $form['provinciaestablecimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['provinciaestablecimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['ciudadestablecimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['ciudadestablecimiento']->render() ?>
	        </td>
	      </tr>			      
	      <tr>
	        <td>
	        	<?php echo $form['fechaemision']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['fechaemision']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['duracion']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['duracion']->render() ?> <?php echo $form['unidadtiempo']->render() ?>
	        </td>
	      </tr>		      
	      <tr>
	        <td>
	        	<?php echo $form['concluyo']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['concluyo']->render() ?>
	        </td>
	        <td width="25%">
	        	<?php echo $form['continua']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['continua']->render() ?>
	        </td>	        
	      </tr>		
	      <tr>
	        <td colspan="4" align="center">
	          <?php echo $form['idestudio']->render() ?>        
	          <?php echo $form['idpersona']->render() ?>            
	          <input type="submit" name="botonAgregarEstudio" class="botonAgregarEstudio" value="Guardar" id="botonAgregarEstudio"/>
	        </td>
	      </tr>	            	      	      	      	      	      
	      <tr>
	        <td colspan="4" align="center"><div id="estudiosPrevios"></div></td>
	      </tr>
	     </tbody>
	  </table>	
	  </form>
	</div>	
</div>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('profesores/index') ?>'"></p>
<br>