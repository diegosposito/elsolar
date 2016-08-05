<script>
$(document).ready(function(){  	
<?php if($idestado == 4) { ?>
	alert("La mesa de examen se encuentra cerrada.");     	
	$(".nota").attr("disabled", "disabled");
	$(".botonGuardar").attr("disabled", "disabled");
	$(".botonCerrar").attr("disabled", "disabled");
<?php } ?>
	$(".botonCerrar").click(function(){
		$(".botonCerrar").attr("disabled", "disabled");
		if(validarNotas()) {		
			//registrarLibroMatriz();
			// Registra las notas en el Libro Matriz	
			//$.post("<?php echo url_for('mesasexamenes/registrarlibromatriz'); ?>", 
			//	$('#formConsultar').serialize(),
	   		//	function(data){
	       	//		alert(data);
			//	}		
			//);		
			// Registra las notas en el Libro Matriz	
	    	$.post("<?php echo url_for('mesasexamenes/cerrartodo'); ?>",
	    		//{ idmesaexamen: <?php echo $idmesaexamen; ?> },	    	    	
	   			$('#formConsultar').serialize(),
				function(data) {
	    			var obj = jQuery.parseJSON(data);
    				$(".nota").attr("disabled", "disabled");
	     			alert(obj.mensaje);     		
	    	    	if (obj.guardado==1){
	    	    		$(".botonCerrar").attr("disabled", "disabled");
		    	    }
		   		}       			 	
			);		
		} else {
			alert("Existen notas inválidas.");		
			$(".botonCerrar").removeAttr("disabled");	
		}		
		return false;
	});

	$(".botonAusenteConCertificado").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");		
		// Registra la tenencia de certificado de ausente	
    	$.post("<?php echo url_for('mesasexamenes/registrarausente'); ?>",
   			{idexamen: Id, estado: "UC"},
			function(data) {
     			alert(data);  
     			$(location).attr('href',"<?php echo url_for('mesasexamenes/ingresarnotas?idmesaexamen='.$idmesaexamen); ?>"); 
	   		}       			 	
		);		
		return false;
	});		
});

function validarNotas (){
	var regexpentero = /^([0-9]+\,+\d{1,2}|\d{1}|10|AD|AM|A|D|U|UC)$/;
	
	var resultado = true;
	var notas = $('.nota');
	$.each(notas, function(){
		if (!regexpentero.test($(this).val())) {
			resultado = false;
			$(this).removeClass("resaltar_verde");
			$(this).addClass("resaltar_rojo");
		}else {
			$(this).removeClass("resaltar_rojo");
			$(this).addClass("resaltar_verde");
		}	    
	});
	return resultado;
} 
</script>
<h1>Ingresar Notas de Acta Volante</h1>
<br>
<div align="center">
<form action="" id="formConsultar" method="post">
<input type="hidden" value="<?php echo $idlibro; ?>" name="libro" id="libro">
<input type="hidden" value="<?php echo $folio; ?>" name="folio" id="folio">
<input type="hidden" value="<?php echo $idmesaexamen; ?>" name="idmesaexamen" id="idmesaexamen">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2"><b>Carrera: <?php echo $carrera; ?></b></td>
  </tr>
  <tr>
    <td colspan="2"><b>Asignatura: <?php echo $materia; ?></b></td>
  </tr>
  <tr>
    <td>Condición: <?php echo $condicion; ?></td>
    <td>Fecha: <?php echo $mesa; ?></td>
  </tr>
    <tr>
    <td>Libro: <?php echo $libro; ?></td>
    <td>Folio: <?php echo $folio; ?></td>
  </tr>  
  <tr>
    <td colspan="2" class="hed"></td>
  </tr>
  <tr>
    <td colspan="2">
<div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><strong>Nota:</strong> <br>
Si las <strong>notas</strong> son <strong>númericas</strong>, solo se pueden ingresar  entre los valores <strong>0</strong> y <strong>10</strong>.<br>
    </font><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#000000"> Si las <strong>notas</strong> son <strong>alfanumericas</strong> solo se pueden ingresar <strong>AD</strong> (Aprobado Distinguido), <strong>AM</strong> (Aprobado Muy Bien), <strong>A </strong>(Aprobado) y <strong>D</strong> (Desaprobado). <br>
En el caso de que el <strong>alumno</strong> ha estado <strong>ausente</strong> en dicha mesa, debe ingresar el valor <strong>U</strong>.<br>
En el caso de que el <strong>alumno</strong> ha estado <strong>ausente</strong> en dicha mesa pero cuente con un <strong>certificado</strong>, debe ingresar el valor <strong>UC</strong>. </font></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="hed"></td>
  </tr>  
    <tr>
    <td colspan="2" align="center" ><input type="submit" class="botonCerrar" value="Cerrar" /></td>
  </tr>  
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Legajo</td>
		      <td class="hed" align="center" width="30%">Alumno</td>
		      <td class="hed" align="center" width="15%">Nro. de Documento</td>
		      <td class="hed" align="center" width="15%">Nota escrito</td>
		      <td class="hed" align="center" width="15%">Nota oral</td>
		      <td class="hed" align="center" width="20%">Promedio</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php foreach ($alumnos as $alumno): 
		    $expediente = $alumno->obtenerExpediente();
		    $egresado = false;
		    $habilitado = '';
		    if($expediente) {
		    	if ($expediente->getRegistrocertificadome()!="" or $expediente->getRegistrodiplomame()!="") {
		    		$habilitado = 'readonly="readonly"';
		    		$egresado = true;
		    	}
		    }
		    ?>
		    <tr>
		      <td align="center" <?php echo $egresado ? 'bgcolor="yellow"' : ''; ?>>
		      	<?php echo $alumno->getLegajo(); ?>
		      	<input type="hidden" value="<?php echo $alumno->getIdAlumno(); ?>" name="alumnos[<?php echo $alumno->getIdAlumno(); ?>]" />
		      </td>
		      <td><?php echo $alumno->getPersonas(); ?> </td>
		      <td align="center"><?php echo $alumno->getPersonas()->getTiposDocumentos()." ".$alumno->getPersonas()->getNrodoc(); ?></td>
		      <td align="center">
		      	<input type="text" size="4" value="<?php echo $notaEscrita[$alumno->getIdAlumno()]; ?>" name="notaEscrita[<?php echo $alumno->getIdAlumno(); ?>]" <?php echo $habilitado; ?>>
		      </td>
		      <td align="center">
		      	<input type="text" size="4" value="<?php echo $notaOral[$alumno->getIdAlumno()]; ?>" name="notaOral[<?php echo $alumno->getIdAlumno(); ?>]" <?php echo $habilitado; ?>>
		      </td>
		      <td align="center">
		      	<input type="text" size="4" value="<?php echo $notaPromedio[$alumno->getIdAlumno()]; ?>" name="notaPromedio[<?php echo $alumno->getIdAlumno(); ?>]" class="nota" <?php echo $habilitado; ?>>
				<?php //if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
		      	<?php if ($notaPromedio[$alumno->getIdAlumno()]=="U") { ?>
			      	<input class="botonAusenteConCertificado" id="<?php echo $examen[$alumno->getIdAlumno()]; ?>" type="submit" value="Con Certificado">
		      	<?php } ?>
				<?php //} ?>
		      </td>
		    </tr>
		    <?php endforeach; ?>		  
		  </tbody>	  
		</table>
    </td>
  </tr>
</table>
</form>
</div>
<br><b>ACLARACIÓN:</b><br>
El color en le primera columna indica:<br>
<font color="yellow"><b>AMARILLO:</b></font> El alumno se encuentra registrado como EGRESADO.<br>
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/index?&idplanestudio='.$materiaplan->getIdplanestudio().'&idestado='.$idestado.'&idsede='.$idsede) ?>'"></p>
<br>
