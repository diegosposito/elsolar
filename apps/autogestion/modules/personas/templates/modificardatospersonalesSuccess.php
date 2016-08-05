<h1>Inscripción de Aspirante a Carrera</h1>

<script>
$(document).ready(function(){
	$('#mensajeInfoPersonal').html("Para finalizar la habilitación de tu usuario, por favor confirma tus datos personales.");
	$('#tabs').tabs();
	$('#tabs').tabs("select", 0);	
	$('#idsexo_1').attr("disabled", "disabled");
	$('#idsexo_2').attr("disabled", "disabled");
	// obtener la lista de documentaciones laborales de la persona	
	cargarDocumentacionesLaborales($('#idpersona').val());
	<?php if ($idciudadresE==0){ ?>
		$('#paisresidenciaE').append("<option value='0' selected='selected' >----Seleccione----</option>");
		$('#provinciaresidenciaE').attr('disabled', 'disabled');
		$('#ciudadresidenciaE').attr('disabled', 'disabled');
	<?php }else{ ?>
		$('#paisresidenciaE').val(<?php echo $idpaisresE ?>);
		// cargar las provincias de la carrera al combo
		cargarComboProvincias('#provinciaresidenciaE', <?php echo $idpaisresE ?>, <?php echo $idprovinciaresE ?>);
	    // cargar las ciudades de la carrera al combo
	    cargarComboCiudades('#ciudadresidenciaE', <?php echo $idprovinciaresE ?>, <?php echo $idciudadresE ?>);
	<?php } ?>
	<?php if ($idciudadresT==0){ ?>
		$('#paisresidenciaT').append("<option value='0' selected='selected' >----Seleccione----</option>");
		$('#provinciaresidenciaT').attr('disabled', 'disabled');
		$('#ciudadresidenciaT').attr('disabled', 'disabled');
	<?php }else{ ?>
		$('#paisresidenciaT').val(<?php echo $idpaisresT ?>);
		// cargar las provincias de la carrera al combo
		cargarComboProvincias('#provinciaresidenciaT', <?php echo $idpaisresT ?>, <?php echo $idprovinciaresT ?>);
	    // cargar las ciudades de la carrera al combo
    	cargarComboCiudades('#ciudadresidenciaT', <?php echo $idprovinciaresT ?>, <?php echo $idciudadresT ?>);
	<?php } ?>	   
    $('#paisresidenciaE').change(function(){
    	$('#ciudadresidenciaE').attr('disabled', 'disabled');
    	if($('#paisresidenciaE').val()!=0){
	        // cargar las provincias de la carrera al combo
	        cargarComboProvincias('#provinciaresidenciaE', $(this).val(), 0);
        }
    });	
    $('#provinciaresidenciaE').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadresidenciaE', $(this).val(), 0);
    });	 
    $('#paisresidenciaT').change(function(){
    	$('#ciudadresidenciaT').attr('disabled', 'disabled');
    	if($('#paisresidenciaT').val()!=0){
	        // cargar las provincias de la carrera al combo
	        cargarComboProvincias('#provinciaresidenciaT', $(this).val(), 0);
        }
    });	
    $('#provinciaresidenciaT').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#ciudadresidenciaT', $(this).val(), 0);
    });	    
    
    $('.botonAgregarProfesion').click(function() {
		// guardar la informacion laboral de la persona
   	    $.post("<?php echo url_for('personas/guardardocumentacionlaboral'); ?>",
   	    	$('#formAgregarProfesion').serialize(),
   			function(data){				
   	    		$('#mensajeProfesion').html("La documentación laboral ha sido guardada correctamente.");
				$('#trabaja_1').attr("checked", "checked");					
				// obtener la lista de documentaciones laborales de la persona
				cargarDocumentacionesLaborales($('#idpersona').val());	  
				// deshabilitar el formulario 
				deshabilitarFormulario(true);
   	    	}
   	   	);
		return false;
   	});       
    $('#botonGuardarInfoPersonal').click(function() {
		// guardar la informacion personal del aspirante ingresada
    	$.post("<?php echo url_for('personas/guardarinformacionpersonal'); ?>",
			$('#formGuardarInfoPersonal').serialize(),
    		function(data){
    			$('#mensajeInfoPersonal').html("El Estado civil ha sido guardado correctamente.");
    			$('#idpersona').val(data);
    			$('#formGuardarContacto #idpersona').val(data);
    		}
		);
		return false;
   	});   	
    $('#botonGuardarContacto').click(function() {
    	var validado = validarContactos();
	    if(validado == true) {        
			// guardar la informacion de contacto del aspirante ingresada
			$.post("<?php echo url_for('personas/guardarcontacto'); ?>",
	    	   	$('#formGuardarContacto').serialize(),
	    		function(data){
					$('#mensajeContacto').html("El información de contacto ha sido guardado correctamente.");
	    		}
	    	);
		} else {
			alert(validado);
		}	       	
		return false;
   	});     		
});
//Cargar combo de ciudades
function cargarComboCiudades(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('provincia/obtenerciudades'); ?>",
    	    { idprovincia: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
    	    }
	); 	
} 
// Cargar combo de provincias
function cargarComboProvincias(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('pais/obtenerprovincias'); ?>",
    	    { idpais: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
    	    }
	); 	
}

//Cargar documentaciones laborales
function cargarDocumentacionesLaborales(id){
	// obtener la lista de estudios previos de la persona
	$.get("<?php echo url_for('personas/obtenerdocumentacioneslaborales'); ?>",
	    { idpersona: $('#idpersona').val() },
		function(data){
			$('#documentacionesLaborales').html(data);
		}
	);   	
} 
//Valida el formulario
function validarContactos(){
	var resultado = true;

	$("#email").validator({
		format: 'email',
		required: true, 
		invalidEmpty: true
	});	
	
	if(!$("#email").validator('validate')) {
		resultado = "Debe ingresar un E-mail.";	
	}	
	return resultado;
} 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Datos personales</a></li>
		<li><a href="#tabs-2">Residencia del aspirante</a></li>
		<li><a href="#tabs-3">Datos ocupacionales</a></li>
	</ul>
	<div id="tabs-1">
	<form action="" id="formGuardarInfoPersonal" method="post">
	  <table cellspacing="0" class="stats" width="100%">
	    <tfoot>
	      <tr>
	        <td colspan="6" align="center">	          
				<?php echo $form['idpersona']->render() ?>		
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
	        <td width="19%">
	        	<?php echo $form['apellido']->renderLabel() ?>
	        </td>
	        <td width="19%">
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
	        	<?php echo $form['fechanacimiento']->render() ?>
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
	          <input type="submit" name="botonGuardarContacto" value="Guardar" id="botonGuardarContacto"/>
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
	        <td colspan="6" align="center">
	        	<b>Residencia Estable</b>
	        </td>
	      </tr>	      
	      <tr>
	        <td width="7%">
	        	<?php echo $form['nombrecalleE']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nombrecalleE']->render() ?>
	        </td>
	        <td width="10%">
	        	<?php echo $form['nrocalleE']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrocalleE']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['barrioE']->renderLabel() ?>
	        </td>
	        <td width="7%">
	        	<?php echo $form['barrioE']->render() ?>
	        </td>     	        
	      </tr>  
	      <tr>
	        <td>
	        	<?php echo $form['edificioE']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['edificioE']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['pisoE']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['pisoE']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['deptoE']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['deptoE']->render() ?>
	        </td>
	      </tr>	      
	      <tr>
	        <td colspan="6"><b>Lugar de Residencia Estable:</b></td>
	      </tr>	 	      
		  <tr>
		  	<td></td>
	        <td>
	        	<?php echo $form['paisresidenciaE']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['paisresidenciaE']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
		    <td></td>
	        <td>
	        	<?php echo $form['provinciaresidenciaE']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['provinciaresidenciaE']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['ciudadresidenciaE']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['ciudadresidenciaE']->render() ?>
	        </td>
	      </tr>		
	      <tr>
	        <td colspan="6" align="center">
	        	<b>Residencia Transitoria</b>
	        </td>
	      </tr>	     	
	      <tr>
	        <td width="7%">
	        	<?php echo $form['nombrecalleT']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nombrecalleT']->render() ?>
	        </td>
	        <td width="10%">
	        	<?php echo $form['nrocalleT']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrocalleT']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['barrioT']->renderLabel() ?>
	        </td>
	        <td width="7%">
	        	<?php echo $form['barrioT']->render() ?>
	        </td>	        
	      </tr>  
	      <tr>
	        <td>
	        	<?php echo $form['edificioT']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['edificioT']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['pisoT']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['pisoT']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['deptoT']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['deptoT']->render() ?>
	        </td>
	      </tr>	      
	      <tr>
	        <td colspan="6"><b>Lugar de Residencia Transitoria:</b></td>
	      </tr>	 	      
		  <tr>
		  	<td></td>
	        <td>
	        	<?php echo $form['paisresidenciaT']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['paisresidenciaT']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
		    <td></td>
	        <td>
	        	<?php echo $form['provinciaresidenciaT']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['provinciaresidenciaT']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td></td>
	        <td>
	        	<?php echo $form['ciudadresidenciaT']->renderLabel() ?>
	        </td>
	        <td colspan="5">
	        	<?php echo $form['ciudadresidenciaT']->render() ?>
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
	<form action="" id="formAgregarProfesion" method="post">
	  <table cellspacing="0" class="stats" width="100%">  
	    <tbody>
	      <tr>
	        <td colspan="2">
	        	<b><font color="red"><div id="mensajeProfesion"></div></font></b>
	        </td>
	      </tr>	 
	      <tr>
	        <td width="20%">
	        	<?php echo $form['trabaja']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['trabaja']->render() ?>
	        </td>
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['profesion']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['profesion']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['dedicacion']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['dedicacion']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['lugar']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['lugar']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['certificado']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['certificado']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td colspan="2" align="center">
	          <?php echo $form['idpersona']->render() ?>            
	          <?php echo $form['iddoclaboral']->render() ?>            	          
	          <input type="submit" name="botonAgregarProfesion" value="Guardar" class="botonAgregarProfesion" />
	        </td>
	      </tr>	      
   	      <tr>
	        <td colspan="5" align="center"><div id="documentacionesLaborales"></div></td>
	      </tr>
	     </tbody>
	  </table>	
	  </form>
	</div>	
</div>
</form>