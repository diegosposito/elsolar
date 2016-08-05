<script>
$(document).ready(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });   
    tinyMCE.init({
        mode : "specific_textareas",
        editor_selector : /(mceEditor|mceRichText)/   ,
        theme : "advanced",
        plugins : "spellchecker,advhr,preview,table", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,code,preview,|,forecolor,backcolor,|,spellchecker,advhr,,removeformat,|,charmap",
        theme_advanced_buttons2 : "tablecontrols",
        theme_advanced_buttons3 : "",           
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
             
    });
});

</script>
<h1>Analítico</h1>
<?php
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,'es_ES');
$contadortilde=0;
?>
<form name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('alumnos/imprimiranaliticofinal' ) ?>">  
<table width="100%" class="stats" cellspacing="0">
    <tr>
      <td align="center" class="hed">Id</td>
      <td align="center" class="hed">Carrera</td>
      <td align="center" class="hed">Sede</td>
      <td align="center" class="hed">Acciones</td>
    </tr>    
    <?php if (count($datosanalitico) > 0) { ?>
   	<tr>
   	  <td><?php echo $alumno->getPlanesEstudios()->getIdcarrera() ?></td>
      <td><?php echo $alumno->getPlanesEstudios() ?></td>
      <td align="center"><?php echo $alumno->getSedes() ?></td>
      <td align="center">
		<input type="hidden" name="ida" value="<?php echo $alumno['idalumno']; ?>">
	   <select name="accion_boton">    
	       <option value="imprimir" selected="selected">Imprimir</option>
	       <option value="guardar">Guardar e Imprimir</option>
	       <option value="borrar">Borrar e Imprimir</option>
	   </select>
		<input type="submit" value="Aceptar" title="Imprimir Analítico" id="imprimir" class="form_consulta_enviar" name="Imprimir">
	   
	  </td>
    </tr>     
    <?php } else { ?>
   	<tr>
   	  <td colspan="4" align="center">No existen datos para mostrar en el Analítico Final. Corrobore que este cargado los estudios Previos en el modulo de Modificar datos de Alumnos.</td>
    </tr>     
    <?php } ?>    
</table>
<br />
<div align="center">
<table class="stats" width="100%" border="1px">
<?php foreach($datosanalitico as $datosanalit) { ?>   
    <tr>
    	<td colspan="12">
    		<table width="100%" class="stats" cellspacing="0">
    			<tr>
    				<td width="10%" class="hed">Lugar:</td>
    				<td width="40%" ><INPUT type="text" name="lugar" size="66" value="<?php echo  $datosanalit['ciudadsede']  ?>"></td>
    				<td width="10%" class="hed">Fecha:</td>
    				<td width="40%" ><INPUT type="text" name="fecha" size="8" value="<?php echo date('d/m/Y'); ?>"></td>
    			</tr>
    		</table>	    
		</td>
    </tr>
    <tr>
      <td align="center" colspan="12" class="hed">Encabezado</td>
    </tr> 
    <tr bgcolor="FFD700">
    <td align="center" colspan="12">
 		<TEXTAREA cols="107" rows="6" name="encabezado"><?php echo $encabezado; ?></TEXTAREA>
	</td>
    </tr>
    <tr>
      <td align="center" class="hed"><input type="checkbox" id="selectall" checked /></td>
      <td align="center" class="hed">Id</td>
      <td align="center" class="hed">Nombre</td>
      <td align="center" class="hed">Nota</td>
      <td align="center" class="hed">Libro</td>
      <td align="center" class="hed">Folio</td>
      <td align="center" class="hed">Fecha</td>
      <td align="center" class="hed">Condicion</td>
      <td align="center" class="hed">Tipo Ex.</td>
      <td align="center" class="hed">Tipo Mat.</td>
      <td align="center" class="hed">Sale</td>
      <td align="center" class="hed">Obs.</td>
    </tr>
<?php 
$arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");
$anioactual = 0; $promedio = 0; $cantidad = 0; $canti = 0;
     
	if (count($materias) > 0) {
		foreach($materias as $analit) { 
			if ($anioactual != $analit['anodecursada']) { 
				$anioactual = $analit['anodecursada']; 
?>
	<tr bgcolor="#666666">
		<td align="center"></td>
		<td colspan="11"><b><?php echo $arrYears[$anioactual] ?></b></td>
	</tr>
<?php 
			}
			if ($analit['idtipomateria']!=5) {
?>    	 
	<tr>
		<td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $analit['idmp'] ?>" <?php echo ($analit['saleanalitico'])?"checked":""; ?> /></td>
		<td align="center"><?php echo $analit['idmp'] ?></td>
		<td><?php echo $analit['nombre'] ?></td>
		<td align="center">
			<?php if ($analit['nota']==null or $analit['nota']=="") {
				if ($analit['idcondicion']==5 ) {
					$nota = "";
				} else {
					$nota = number_format($analit['calificacion'],2, ",", ".");	
				}
			} else {
				if(is_numeric($analit['nota'])) {
					$nota = number_format(str_replace(",",".",$analit['nota']),2, ",", "");
				} else {			
					$nota = $analit['nota'];
				}
			}
			echo $nota; ?>
		</td>
		<td align="center"><?php echo ($analit['libro']==null or $analit['libro']=="")?$analit['libroacta']:$analit['libro'] ?></td>
		<td align="center"><?php echo $analit['folio'] ?></td>
		<td align="center">
			<?php $arr = explode('-', $analit['fecha']);
			echo $arr[2]."-".$arr[1]."-".$arr[0] ?>
		</td>
		<td align="center"><?php echo $analit['condicion'] ?></td>
		<td align="center"><?php echo $analit['tipoexamen'] ?></td>
		<td align="center"><?php echo $analit['tipomateria'] ?></td>
		<td align="center"><?php echo ($analit['enanalitico']==1)?"Si":"No" ?></td>
<?php


$tilde_optativa='';
if ($analit['tipomateria']=='Optativa') {
	$contadortilde++;
	$tilde_optativa=$contadortilde;
}
?>
		<td align="center"><input type="text" size="2" name="obs[<?php echo $analit['idmp'] ?>]" value="<?php echo $tilde_optativa; ?>"/></td>
	</tr>
<?php 
				if ($analit['calif']!="" || $analit['calif']!=0) {
					$valor=str_replace(",",".",$analit['calif']);
					$promedio+=$valor; 
					$canti++;
				}    
				$cantidad++;
			}
		} 
	} else { 
?>
<?php
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL,'es_ES');
?>
	<tr>
		<td align="center" colspan="12">No existen resultados.</td>
	</tr>   
<?php 
	} 
?>
    <tr>
		<td colspan="12">
    		<table width="100%" class="stats" cellspacing="0">
    			<tr>
    				<td width="25%" class="hed">Cant. Materias por Hoja:</td>
    				<td width="15%" ><INPUT type="text" name="cantmaterias" size="2" value="48"></td>
    				<td width="15%" class="hed">Promedio:</td>
    				<td width="15%" ><?php echo ($canti!=0)?number_format($promedio/$canti, 2):"0" ?></td>
    				<td width="15%" class="hed">Cant. Materias:</td>
    				<td width="15%" ><?php echo $cantidad ?></td>
    			</tr>
    		</table>		
		</td>    
    </tr>
    <?php if (count($extracurriculares) > 0) { ?>
    <tr>
      <td align="center" colspan="12" class="hed">Texto Extracurriculares</td>
    </tr>     
    <tr>
		<td align="center" colspan="12">
			<TEXTAREA cols="107" rows="2" name="textoextracurriculares">Asimismo se deja constancia de que se han cumplido las exigencias extracurriculares previstas en el Plan de Estudios de la siguiente manera.</TEXTAREA>
		</td>
    </tr>     
    <tr>
      <td align="center" class="hed"></td>
      <td align="center" class="hed">Id</td>
      <td align="center" class="hed">Nombre</td>
      <td align="center" class="hed">Nota</td>
      <td align="center" class="hed">Libro</td>
      <td align="center" class="hed">Folio</td>
      <td align="center" class="hed">Fecha</td>
      <td align="center" class="hed">Condicion</td>
      <td align="center" class="hed">Tipo Ex.</td>
      <td align="center" class="hed">Tipo Mat.</td>
      <td align="center" class="hed">Sale</td>
      <td align="center" class="hed">Obs.</td>
    </tr>
<?php 
	foreach($extracurriculares as $extra) { 
?>    	 
	<tr>
		<td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $extra['idmp'] ?>" <?php echo ($extra['saleanalitico'])?"checked":""; ?> /></td>
		<td align="center"><?php echo $extra['idmp'] ?></td>
		<td><?php echo $extra['nombre'] ?></td>
		<td align="center">
			<?php if ($extra['nota']==null or $extra['nota']=="") {
				if ($extra['idcondicion']==5 ) {
					$nota = "";
				} else {
					$nota = number_format($extra['calificacion'],2, ",", ".");	
				}
			} else {
				if(is_numeric($extra['nota'])) {
					$nota = number_format(str_replace(",",".",$extra['nota']),2, ",", "");
				} else {			
					$nota = $extra['nota'];
				}
			}
			echo $nota; ?>
		</td>
		<td align="center"><?php echo ($extra['libro']==null or $extra['libro']=="")?$extra['libroacta']:$extra['libro'] ?></td>
		<td align="center"><?php echo $extra['folio'] ?></td>
		<td align="center">
			<?php $arr = explode('-', $extra['fecha']);
			echo $arr[2]."-".$arr[1]."-".$arr[0] ?>
		</td>
		<td align="center"><?php echo $extra['condicion'] ?></td>
		<td align="center"><?php echo $extra['tipoexamen'] ?></td>
		<td align="center"><?php echo $extra['tipomateria'] ?></td>
		<td align="center"><?php echo ($extra['enanalitico']==1)?"Si":"No" ?></td>
		<td align="center"><input type="text" size="2" name="obs[<?php echo $extra['idmp'] ?>]" /></td>
	</tr>
	<?php } ?>    
    <?php } ?>
    <tr>
      <td align="center" colspan="12" class="hed">Observaciones</td>
    </tr>     
    <tr>
		<td align="center" colspan="12" bgcolor="FFD700">
			<TEXTAREA cols="107" rows="4" name="observaciones" class="mceEditor">
			<?php 
			$ruta="/var/www/svnacademico/web/analiticos/";

			if (file_exists($ruta.$alumno->getIdalumno()."_observaciones.txt")) { 

				$file = fopen($ruta.$alumno->getIdalumno()."_observaciones.txt", "r") or exit("Unable to open file!");
				//Output a line of the file until the end is reached
				$observaciones="\n";
				while(!feof($file)) {
		    		$observaciones=$observaciones.fgets($file);
				}
				fclose($file);

				echo $observaciones;
			}
			?>
			</TEXTAREA>
		</td>
    </tr>
    <tr>
		<td align="center" colspan="12" class="hed">Texto Pie 1</td>
    </tr>
    <tr>
		<td align="center" colspan="12">		
			<TEXTAREA cols="107" rows="4" name="textopie1">En fe de lo cual se le extiende el presente certificado, sin raspaduras ni enmiendas, en Concepción del Uruguay, Provincia de Entre Ríos, a los <?php echo strftime("%d días del mes de %B de %Y"); ?>, para ser presentado ante las autoridades que lo soliciten.<?php echo "\n" ?></TEXTAREA>
		</td>
    </tr>
    <tr>
		<td align="center" colspan="12" class="hed">Autoridades de la Facultad</td>
    </tr>
    <tr>
    	<td colspan="12">
    		<table width="100%" class="stats" cellspacing="0">
    			<tr>
    				<td width="33%" align="center">
						<TEXTAREA cols="30" rows="4" cols="30" name="secacademico">
<?php 
if($secacademico) {
	$identificacion_sec=$secacademico['titulo']." ".$secacademico->Empleados->Personas->getNombre()." ".$secacademico->Empleados->Personas->getApellido()."\n";
	if($secacademico->Empleados->Personas->getIdsexo()==1) {
		$cargo_sec=$secacademico->TiposCargos->getDescripcion();
		$cargo_sec1='al '.$secacademico->TiposCargos->getDescripcion();
	} else {
		$cargo_sec=$secacademico->TiposCargos->getDescripcionfemenina();
		$cargo_sec1='la '.$secacademico->TiposCargos->getDescripcionfemenina();
	}
	echo $identificacion_sec.$cargo_sec;
}
?>
					</TEXTAREA>    				
    				</td>
    				<td width="34%" align="center">
    					<TEXTAREA cols="30" rows="4" cols="30" name="director">
<?php 
if($director) {
	$identificacion_dir=$director['titulo']." ".$director->Empleados->Personas->getNombre()." ".$director->Empleados->Personas->getApellido()."\n";
	if($director->Empleados->Personas->getIdsexo()==1) {
		$cargo_dir=$director->TiposCargos->getDescripcion().' '.$datosanalit['ciudadsede'];
		$cargo_dir1='al '.$director->TiposCargos->getDescripcion().' '.$datosanalit['ciudadsede'];
	} else {
		$cargo_dir=$director->TiposCargos->getDescripcionfemenina().' '.$datosanalit['ciudadsede'];
		$cargo_dir1='la '.$director->TiposCargos->getDescripcionfemenina().' '.$datosanalit['ciudadsede'];
	}
	echo $identificacion_dir.$cargo_dir;
}
?>
						</TEXTAREA>
    				</td>
    				<td width="33%" align="center">
						<TEXTAREA cols="30" rows="4" cols="30" name="decano">
<?php 
if($decano){
	$identificacion_dec=$decano['titulo']." ".$decano->Empleados->Personas->getNombre()." ".$decano->Empleados->Personas->getApellido()."\n";
	if($decano->Empleados->Personas->getIdsexo()==1){
		$cargo_dec=$decano->TiposCargos->getDescripcion();
		$cargo_dec1=' al '.$decano->TiposCargos->getDescripcion();
	} else{
		$cargo_dec=$decano->TiposCargos->getDescripcionfemenina();
		$cargo_dec1=' la '.$decano->TiposCargos->getDescripcionfemenina();
	}
	echo $identificacion_dec.$cargo_dec;
}
?>
						</TEXTAREA>    				
    				</td>
    			</tr>
    		</table>
    	</td>
    </tr>
    <tr>
		<td align="center" colspan="12" class="hed">Texto Pie 2</td>
    </tr>
    <tr>
		<td align="center" colspan="12">
			<TEXTAREA cols="107" rows="4"  name="textopie2">Certifico que las firmas que anteceden son auténticas y pertenecen a <?php echo ($director)?$cargo_dir1." ".$director['titulo']." ".$director->Empleados->Personas->getNombre()." ".$director->Empleados->Personas->getApellido().", ":"" ?><?php echo ($secacademico)?$cargo_sec1." ".$secacademico['titulo']." ".$secacademico->Empleados->Personas->getNombre()." ".$secacademico->Empleados->Personas->getApellido()." y":"" ?><?php echo ($decano)?$cargo_dec1:"" ?> de la <?php echo $facultad ?>, <?php echo ($decano)?$decano['titulo']." ".$decano->Empleados->Personas->getNombre()." ".$decano->Empleados->Personas->getApellido():"" ?>, de la Universidad de Concepción del Uruguay.<?php echo "\n" ?></TEXTAREA>
		</td>
    </tr>
    <tr>
		<td align="center" colspan="12" class="hed">Autoridades de la Universidad</td>
    </tr>
    <tr>
		<td colspan="12">
    		<table width="100%" class="stats" cellspacing="0">
    			<tr>
    				<td width="50%" align="center">
						<TEXTAREA align="center" cols="44" rows="4" cols="30" name="secgeneral">
<?php 
if($secgeneral){
	$identificacion_sg=$secgeneral['titulo']." ".$secgeneral->Empleados->Personas->getNombre()." ".$secgeneral->Empleados->Personas->getApellido()."\n";
	if($secgeneral->Empleados->Personas->getIdsexo()==1){
		$cargo_sg=$secgeneral->TiposCargos->getDescripcion();
	} else{
		$cargo_sg=$secgeneral->TiposCargos->getDescripcionfemenina();
	}
	echo $identificacion_sg.$cargo_sg;
}
?>						
						</TEXTAREA>		
    				</td>
    				<td width="50%" align="center">
						<TEXTAREA align="center" cols="44" rows="4" cols="30" name="rector"><?php echo ($rector)?$rector['titulo']." ".$rector->Empleados->Personas->getNombre()." ".$rector->Empleados->Personas->getApellido()."\n".$rector->TiposCargos->getDescripcion():"" ?></TEXTAREA>
					</td>
    			</tr>
    		</table>		
		</td>
	</tr>
   <?php } ?>    	
</table>
<br />
</div>
</form>
