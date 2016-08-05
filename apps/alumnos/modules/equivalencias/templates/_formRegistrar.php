<script>
$(document).ready(function(){
	$("#botonImprimir").attr("disabled", "disabled");
	$("#selectall").attr("checked", "checked");
	$(".case").attr("checked", "checked");
    // Agrega multiple select / deselect funcionalidad
    $("#selectall").click(function () {
          $(".case").attr("checked", this.checked);
    });
 
    // Si todas son seleccionadas
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
            $("#estados_alumno_historial_tipobaja").val("P");
        }
    }); 

	$("#equivalencias_alumnos_fecharesolucion").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});

    $("#botonGuardar").click(function(){
    	$('#botonGuardar').attr("disabled", "disabled");
    	var validado = validarForm();
    	if(validado == true) {
	        // Guarda la baja del alumno
	   		$.post("<?php echo url_for('equivalencias/guardarregistro'); ?>",
				$("#formGuardar").serialize(),
				function(data){
		    		alert(data);
		    		$(location).attr('href','<?php echo url_for('equivalencias/indexacademica'); ?>');
				}    	
			);
		} else {
			$('#botonGuardar').removeAttr('disabled');
			alert(validado);
		}	       	
    	return false;
   	});	  	
}); 

//Valida el formulario
function validarForm(){
	var regexpfecha = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;
		
	if($("#equivalencias_alumnos_nroresolucion").val()=="") {
		resultado = "Debe ingresar un Número de resolución.";
	} 

	if (!regexpfecha.test($("#equivalencias_alumnos_fecharesolucion").val())) {
		resultado = "Debe ingresar una Fecha de resolución válida.";
	}	

	return resultado;
} 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div align="center">
<form action="" id="formGuardar" method="post">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td width="18%"><b>Alumnos:</b></td>
    <td colspan="3"><?php echo $equivalencia->getAlumnos()->getPersonas(); ?>(<?php echo $equivalencia->getAlumnos()->getIdalumno(); ?>)</td>
  </tr>
  <tr>
    <td><b>Nro. documento:</b></td>
    <td colspan="3"><?php echo $equivalencia->getAlumnos()->getPersonas()->getTiposDocumentos().": ".$equivalencia->getAlumnos()->getPersonas()->getNrodoc(); ?></td>
  </tr>  
  <tr>
    <td><b>Plan de estudios:</b></td>
    <td colspan="3"><?php echo $equivalencia->getAlumnos()->getPlanesEstudios(); ?></td>
  </tr>  
  <tr>	
	<td><b><?php echo $form['fecharesolucion']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['fecharesolucion']->renderError() ?>
		<?php echo $form['fecharesolucion'] ?>
	</td>
	
  </tr>  
  <tr>
	<td><b><?php echo $form['nroresolucion']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['nroresolucion']->renderError() ?>
		<?php echo $form['nroresolucion'] ?>
	</td>
	<td colspan="2"></td>
  </tr>     
  <tr>
    <td  colspan="4" class="hed">Materias:</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
		<table width="100%" cellspacing="0" class="stats">
			<tr>
				<td align="center" colspan="6">
					<?php echo $form->renderHiddenFields(false) ?>
					<input type="submit" id="botonGuardar" class="botonGuardar" value="Guardar" >
				</td>
			</tr>
		    <tr>
      		  <td align="center" width="8%" class="hed"><input type="checkbox" id="selectall" /></td>		    
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="80%">Materia</td>
		      <td class="hed" align="center" width="7%">Curso</td>
		    </tr>
		    <?php 
		    if (count($materias) > 0) { 
		    	$materias_equiv = $equivalencia->getAlumnos()->obtenerMateriasHabilitadas('R','L');
		    	foreach($materias_equiv as $materia) {
		    		$materias_equivalencias[$materia['idmateriaplan']] = $materia['idmateriaplan'];
		    	}    	
		    	foreach ($materias as $materia_plan) {
		    		if (array_key_exists((int)$materia_plan->getIdmateriaplan(), $materias_equivalencias)) {
						$color = "";
					} else {
						$color = "bgcolor='red'";
					}
		    ?>
		    <tr class="fila_" <?php echo $color ?>>
		      <td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $materia_plan->getMateriasPlanes()->getIdmateriaplan() ?>" /></td>
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia_plan->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getAnodecursada(); ?></td>
		    </tr>
		    <?php 
				} 
			} else { 
			?>
		     <tr>
		      <td align="center" colspan="4">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		</table>
    </td>
  </tr>
</table>
</form>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('equivalencias/indexacademica') ?>'"></p>
<br>