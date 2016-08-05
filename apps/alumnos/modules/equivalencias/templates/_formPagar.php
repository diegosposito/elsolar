<script>
$(document).ready(function(){
    $("#botonGuardar").click(function(){
    	$('#botonGuardar').attr("disabled", "disabled");
    	var validado = validarForm();
    	if(validado == true) {
	        // Guarda la baja del alumno
	   		$.post("<?php echo url_for('equivalencias/guardarpago'); ?>",
				$("#formGuardar").serialize(),
				function(data){
		    		alert(data);
		    		$(location).attr('href','<?php echo url_for('equivalencias/indexadministracion'); ?>');
				}    	
			);
		} else {
			$('#botonGuardar').removeAttr('disabled');
			alert(validado);
		}	       	
    	return false;
   	});	  	
}); 
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
	<td><b><?php echo $form['tipopago']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['tipopago']->renderError() ?>
		<?php echo $form['tipopago'] ?>
	</td>
	
  </tr>  
  <tr>
	<td><b><?php echo $form['nrorecibo1']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['nrorecibo1']->renderError() ?>
		<?php echo $form['nrorecibo1'] ?>
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
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia_plan->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getAnodecursada(); ?></td>
		    </tr>
		    <?php 
				} 
			} else { 
			?>
		     <tr>
		      <td align="center" colspan="3">No existen registros.</td>
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