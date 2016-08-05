<script>
$(document).ready(function(){
    $('.botonGenerar').click(function() {
    	var elemento = $(this);
		var Id = elemento.attr("id");
		// guardar la informacion de documentacion adicional del aspirante ingresada
   	    $.post("<?php echo url_for('aspirante/generarusuario'); ?>",
   	    	{idpersona: Id},
   			function(data){
				$('#formGenerar').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});
$(document).ready(function(){
    $('.botonAutoGenerarEmail').click(function() {
    	var elemento = $(this);
		var Id = elemento.attr("id");
		// se genera un email institucional apra el alumno
   	    $.post("<?php echo url_for('aspirante/generaremail'); ?>",
   	    	{idpersona: Id},
   			function(data){
				$('#formAutoGenerarEmail').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});




$(document).ready(function(){
    $('.botonNotificarEmail').click(function() {
    	var elemento = $(this);
		var Id = elemento.attr("id");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('aspirante/notificaremail'); ?>",
   	    	{idpersona: Id},
   			function(data){
				$('#formNotificarEmail').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	

});

$(document).ready(function(){
    $('.botonConfirmarCsv').click(function() {
    		var elemento = $(this);
		var Idciclo = elemento.attr("id");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('informes/confirmarcsv'); ?>",
   	    	{ idciclo: Idciclo },
   			function(data){
				$('#formConfirmarCsv').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});


$(document).ready(function(){
    $('.botonGenerarUsuariosCampus').click(function() {
    		var elemento = $(this);
		var Idciclo = elemento.attr("id");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('informes/generarusuarioscampus'); ?>",
   	    	{ idciclo: Idciclo },
   			function(data){
				$('#formGenerarUsuariosCampus').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});
$(document).ready(function(){
    $('.botonGenerarEmailMasivo').click(function() {
    		var elemento = $(this);
		//var Id = elemento.attr("id");
		var Idciclo = elemento.attr("id");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('informes/generaremailmasivo'); ?>",
   	    	{ idciclo: Idciclo},
   			function(data){
				$('#formGenerarEmailMasivo').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});


$(document).ready(function(){
    $('.botonNotificarEmailMasivo').click(function() {
    		var elemento = $(this);
		//var Id = elemento.attr("id");
		var Idciclo = elemento.attr("id");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('informes/notificaremailmasivo'); ?>",
   	    	{ idciclo: Idciclo},
   			function(data){
				$('#formNotificarEmailMasivo').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});


$(document).ready(function(){
    $('.botonPreuniversitario').click(function() {
    		var elemento = $(this);
		var Id = elemento.attr("id");
		var Idpersona = elemento.attr("idpersona");
		var Idciclo = elemento.attr("idciclo");
		// envia email al alumno con datos de acceso
   	    $.post("<?php echo url_for('informes/generarpreuniversitario'); ?>",
   	    	{idpersona: Id, idp: Idpersona, idciclo: Idciclo},
   			function(data){
				$('#formGenerarPreuniversitario').submit();
				alert(data);
   			}
   	   	);
		return false;		
   	});       	  	
});
</script>
<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Ciclo Lectivo: <?php echo $ciclo; ?></td>
  </tr>
  <tr>
	<td colspan="2">
		<b><font color="red"><div id="mensaje"></div></font></b>
	</td>
  </tr>	 
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="30%">Nombre</td>
		      <td class="hed" align="center" width="15%">Nro. Documento</td>
		      <td class="hed" align="center" width="10%">Fecha Nacimiento</td>
		      <td class="hed" align="center" width="10%">Fecha Ingreso</td>
		      <td class="hed" align="center" width="7%">Usuario</td>
 		      <td class="hed" align="center" width="7%">PRE</td>
		      <td class="hed" align="center" width="10%">E-mail</td>
		      <td class="hed" align="center" width="10%">E-mail-UCU</td>
		      <td class="hed"></td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
		    <?php foreach ($alumnos as $alumno): 
		    $oPersona = Doctrine_Core::getTable('Personas')->find($alumno['idpersona']);
		    ?>
		    <tr>
		      <td align="left"><?php echo $alumno['ape'].", ".$alumno['nom']; ?></td>
		      <td><?php echo $alumno['tipodoc']." ".$alumno['documento']; ?></td>
		      <td align="center">
		      <?php 
				$arr = explode('-', $alumno['fechanac']);
		        echo $arr[2]."-".$arr[1]."-".$arr[0]; 
		      ?>
		      </td>
		      <td align="center">
		      <?php 
				$arr = explode('-', $alumno['fechaingreso']);
		        echo $arr[2]."-".$arr[1]."-".$arr[0]; 
		      ?>
		      </td>
		      <td align="center">
		      <?php if ($oPersona->existeUsuario()) {
		      	if ($oPersona->existeUsuario()->getUser()->getLastLogin()) {
		      		echo $oPersona->existeUsuario()->getUser()->getLastLogin();
		      	} else {
		      		echo "X";
		      	}
		      } else {
		      	echo "";
		      } ?>
		      </td>
<td align="center">
		      <?php 

			//echo $oPersona->getCarrerasPersona();
			/*foreach($oPersona as $planes){
				var_dump($planes); die;
			};*/
			if ($oPersona->existeEnPreuniversitario()) {
		      		echo "SI";
		        }; 
		      ?>
		      </td>
 


		      <td align="center"><?php echo ($oPersona->getContacto()) ? $oPersona->getContacto()->email : ""; ?></td>
		      <td align="center"><?php echo ($oPersona->getContacto()) ? $oPersona->getContacto()->email1 : ""; ?></td>
		      <td align="center">
		      <form action="" id="formAutoGenerarEmail" method="post">
				<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $oPersona->getIdpersona(); ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonAutoGenerarEmail" id="<?php echo $oPersona->getIdpersona(); ?>"  value="Generar Email UCU" <?php if ($oPersona->getContacto()->email1){ ?>type="hidden"<?php } else {?> type="submit" <?php }; ?>>
	          </form> 
		      <form action="" id="formNotificarEmail" method="post">
				<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $oPersona->getIdpersona(); ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonNotificarEmail" id="<?php echo $oPersona->getIdpersona(); ?>"  value="Notificar Email" <?php if (!$oPersona->getContacto()->email1){ ?>type="hidden"<?php } else {?> type="submit" <?php }; ?>>
	          </form> 
		      <form action="" id="formGenerar" method="post">
				<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $oPersona->getIdpersona(); ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonGenerar" id="<?php echo $oPersona->getIdpersona(); ?>" value="Generar Usuario" <?php if (!$oPersona->getContacto()->email1){ ?>type="hidden"<?php } else {?> type="submit" <?php }; ?>>
	          </form>    
        		<form action="" id="formGenerarPreuniversitario" method="post">
				<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $oPersona->getIdpersona(); ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonPreuniversitario" id="<?php echo $oPersona->getIdpersona(); ?>"  value="Preuniversitario" type="submit" >
	          </form> 		
		      </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="7" align="center">No existen aspirantes.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
		      <form action="" id="formConfirmarCsv" method="post">
				<input type="hidden" id="idsede" name="idsede" value="<?php echo $alumno['idsede']; ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonConfirmarCsv" id="<?php echo $idciclo; ?>" value="Confirmar Archivo CSV"  type="submit" >
	          </form> 

		    
		      <form action="<?php echo url_for('informes/generarusuarioscampus'); ?>" id="formGenerarUsuariosCampus" method="post">
				<input type="hidden" id="sede" name="idsede" value="<?php echo $alumno['idsede']; ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonGenerarUsuariosCampus" id="<?php echo $oPersona->getIdpersona(); ?>" value="Generar Usuarios Campus"  type="submit" >
	          </form> 

		      <form action="<?php echo url_for('informes/generarcsv'); ?>" id="formGenerarCsv" method="post">
				<input type="hidden" id="sede" name="idsede" value="<?php echo $alumno['idsede']; ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonGenerarCsv" id="<?php echo $oPersona->getIdpersona(); ?>" value="Generar Archivo Gmail"  type="submit" >
	          </form>   
		      <form action="" id="formGenerarEmailMasivo" method="post">
				<input type="hidden" id="sede" name="idsede" value="<?php echo $alumno['idsede']; ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonGenerarEmailMasivo" id="<?php echo $idciclo; ?>" value="Generar Email Masivo"  type="submit" >
	          </form> 
 	          </form>   
		      <form action="" id="formNotificarEmailMasivo" method="post">
				<input type="hidden" id="sede" name="idsede" value="<?php echo $alumno['idsede']; ?>">
				<input type="hidden" id="idciclo" name="idciclo" value="<?php echo $idciclo; ?>">
				<input class="botonNotificarEmailMasivo" id="<?php echo $idciclo; ?>" value="Notificar Email Masivo"  type="submit" >
	          </form> 
    </td>
  </tr> 
</table>
</div>
