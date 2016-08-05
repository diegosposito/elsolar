<h1>Modificar de Datos Personales de Personas</h1>

<script>
$(document).ready(function(){
	var date = new Date();
	var mes = date.getMonth()+1;
	var dia = date.getDate();
	var fecha = (dia<10 ? '0' : '') + dia + '-' + (mes<10 ? '0' : '') + mes + '-' +date.getFullYear();	

	$('#tabs').tabs();
	$('#tabs').tabs("select", 0);	  
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
		
	<?php if ($idpersona==0) { ?>
		$('#tabs').tabs("option", "disabled", [1,2,3]);	
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
    	$('#botonGuardarInfoPersonal').attr("disabled","disabled").delay(5000);
    	if(validado == true) {
            // guardar la informacion personal del alumnos ingresada
    	    $.post("<?php echo url_for('personas/guardarinformacionpersonal'); ?>",
    	    	$('#formGuardarInfoPersonal').serialize(),
    			function(data){
    	    		var obj = jQuery.parseJSON(data);
    				$('#mensajeInfoPersonal').html(obj.mensaje);
					if (obj.idpersona!=0){
	    				$('#idpersona').val(obj.idpersona);
	    				$('#formGuardarInfoPersonal #idpersona').val(obj.idpersona);
	    				$('#formGuardarContacto #idpersona').val(obj.idpersona);
	    				//$('#formGuardarDocumentacion #idpersona').val(obj.idpersona);
	    				//$('#formGuardarDocumentacionAdicional #idpersona').val(obj.idpersona);
	    				//$('#formGuardarDocumentacion #idpersona').val(obj.idpersona);
	    				//$('#formGuardarDocumentacionAdicional #idpersona').val(obj.idpersona);	 
	    				$('#formOtraInformacionRelevante #idpersona').val(obj.idpersona);
	    				$('#formAgregarEstudio #idpersona').val(obj.idpersona);   				
					}
    				$('#tabs').tabs("option", "disabled", []);
    			}
    	   	);
    	    
		} else {
			alert(validado);
		}	
    	window.setTimeout( function(){ $('#botonGuardarInfoPersonal').removeAttr("disabled") }, 5000 );
    	//$('#botonGuardarInfoPersonal').removeAttr("disabled");
		return false;
   	});   
    $('#botonGuardarContacto').click(function() {
    	var validado = validarFormContacto();
		//validado = true;
    	if(validado == true) {
	    	// guardar la informacion de contacto del alumnos ingresada
			$.post("<?php echo url_for('alumnos/guardarcontacto'); ?>",
    		   	$('#formGuardarContacto').serialize(),
    			function(data){
    				$('#mensajeContacto').html('El Registro ha sido guardado correctamente');
					$('#botonGenerar').attr("disabled",false);
    			}
    		);
		} else {
			alert(validado);
		}	    		
		return false;
   	});

   	$('#botonOtraInformacion').click(function() {
    	var validado = $('#informacionrelevante').val()!='' ? true : false;
		//validado = true;
    	if(validado == true) {
	    	// guardar la informacion de contacto del alumnos ingresada
			$.post("<?php echo url_for('personas/guardarinformacionrelevante'); ?>",
    		   	$('#formOtraInformacionRelevante').serialize(),
    			function(data){
    				$('#mensajeInformacionelevante').html('El Registro ha sido guardado correctamente');
				//	$('#botonGenerar').attr("disabled",false);
    			}
    		);
		} else {
			alert(validado);
		}	    		
		return false;
   	});
      
    $('.botonAgregarEstudio').click(function() {
    	var validado = validarEstudioPrevio();
    	var anios = validarAnios();
    	if(validado == true && anios ==true) {
	    	// guardar la informacion de estudios previos de la persona
	   	    $.post("<?php echo url_for('personas/guardarestudioprevio'); ?>",
	   	    	$('#formAgregarEstudio').serialize(),
	   			function(data){
	   	    		$('#mensajeEstudio').html(data);
					// obtener la lista de estudios previos de la persona
					cargarEstudiosPrevios($('#idpersona').val());							
	   			}
	   	   	);
		} else {
			//alert(string.concat(validado,' ',anios));
			alert(validado);
			if(validado==true) alert(anios);
		}	   	   	
		return false;
   	});  

   	$('#formaciondocente').click(function(){
	    cargarNivelesEstudios('#nivel', $("#formaciondocente").is(':checked'), 0);
    });	

    $('#concluyo').click(function(){

    	if($("#concluyo").is(':checked')) {  
	    	$('#idanioingreso').hide();
	    	$('#idanioegreso').show();
        } else {
	        $('#idanioingreso').show();
	        $('#idanioegreso').hide();
        }

    });	  

    $('#nivel').change(function(){
    	if($('#nivel').val()==14){
	         $('#idOtros').show();
        } else {
	         $('#idOtros').hide();
        }
    }); 
});

// Valida el formulario
function validarFormInfoPersonal(){
	//var regexp = /^\d{1,2}\-\d{1,2}\-\d{4}$/;
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

function validarAnios(){
	    var year='';
	    var resultado = true;

	    if ($("#anioingreso").is(":visible")){
            year = $("#anioingreso").val();
	    }else {
            year = $("#anioegreso").val();
	    }

	    if (isNaN(year)){
           resultado = "El año seleccionado debe ser de 4 dígitos y no puede superar el año actual";
        }

	    var currdate = new Date();
        if (year < 1000 || year > currdate.getFullYear()){
           resultado = "El año seleccionado debe ser de 4 dígitos y no puede superar el año actual";
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
	$.post("<?php echo url_for('personas/getallestudiosprevios'); ?>",
	    { idpersona: $('#idpersona').val() },
		function(data){
			$('#estudiosPrevios').html(data);
		}
	);   	
} 

// Cargar combo de provincias
function cargarNivelesEstudios(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('nivelesestudios/obtenerniveles'); ?>",
    	    { formaciondocente: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
    	    }
	); 	
} 

// Cargar combo de provincias
function cargarAnios( seleccion){
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('nivelesestudios/obtenerniveles'); ?>",
    	    { formaciondocente: id },
    	    function(data){
	    	    $(combo).html(data);
	    	    $(combo).attr('disabled',false);
	    	    $(combo).val(idseleccionado);
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
		<li><a href="#tabs-4">Otra información relevante</a></li> 
	</ul>
	<div id="tabs-1">
	<form action="" id="formGuardarInfoPersonal" method="post">
	  <table cellspacing="0" class="stats" width="100%">
	    <tfoot>
	      <tr>
	        <td colspan="6" align="center">
	        	<?php echo $form['idtipodocumento']->render() ?>		          
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
	        <td width="11%">
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
	      <tr>
	        <td>
	        	<?php echo $form['email1']->renderLabel() ?>
	        </td>
	        <td colspan="6">
	        	<?php echo $form['email1']->render() ?> (Para uso de SAO Autogestion)
	        </td>
	      </tr>	
		</tbody>
	  </table>
	  </form>
	</div>
	<div id="tabs-3">
	<form action="" id="formAgregarEstudio" method="post">

	  <input type="hidden" name="categoria" id="categoria" value="1">
	 
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
	         <td colspan="4">
	        	<?php echo "* Se entiende por formación docente a las carreras terciaras y universitarias de profesorado como así también a Postítulos y Diplomaturas con reconocimiento por parte de la CGE." ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['formaciondocente']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['formaciondocente']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['nivel']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['nivel']->render() ?> 
	        </td>
	        <td colspan="1">
	        	<div id="idOtros" style="display: none;"><?php echo $form['otros']->renderLabel().' '.$form['otros']->render() ?></div>
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
	        <td colspan="2">
	        	<?php echo $form['concluyo']->renderLabel() ?><?php echo $form['concluyo']->render() ?>
	        </td>
	        <td colspan="1">
	        	<div id="idanioingreso"><?php echo $form['anioingreso']->renderLabel().' '.$form['anioingreso']->render() ?></div>
	        	<div id="idanioegreso" style="display: none;"><?php echo $form['anioegreso']->renderLabel().' '.$form['anioegreso']->render() ?></div>
	        </td>
	        <td width="25%">
	        	<?php echo $form['continua']->renderLabel() ?><?php echo $form['continua']->render() ?>
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
	<div id="tabs-4">
	<form action="" id="formOtraInformacionRelevante" method="post">

	  <table cellspacing="0" class="stats" width="100%">  
	    <tbody>
	      <tr>
	        <td colspan="4">
	        	<b><font color="red"><div id="mensajeInformacionelevante"></div></font></b>
	        </td>
	      </tr>	 
	      <tr>
	        <td width="17%">
	        	<?php echo $form['informacionrelevante']->renderLabel() ?>
	        </td>
	        <td colspan="3">
	        	<?php echo $form['informacionrelevante']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td colspan="4" align="center">
	           <?php echo $form['idpersona']->render() ?>            
	          <input type="submit" name="botonOtraInformacion" class="botonOtraInformacion" value="Guardar" id="botonOtraInformacion"/>
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
