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

	$("#equivalencias_alumnos_fecha").datepicker({
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
  
        // Guarda la baja del alumno
   		$.post("<?php echo url_for('equivalencias/guardarsolicitud'); ?>",
       		    $("#formGuardar").serialize(),
           	    function(data){
	    		alert(data);
	    		$(location).attr('href','<?php echo url_for('equivalencias/index'); ?>');
				}    	
           	);
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
    <td width="15%"><b>Alumno:</b></td>
    <td colspan="3"><?php echo $alumno->getPersonas(); ?>(<?php echo $alumno->getIdalumno(); ?>)</td>
  </tr>
  <tr>
    <td><b>Nro. documento:</b></td>
    <td colspan="3"><?php echo $alumno->getPersonas()->getTiposDocumentos().": ".$alumno->getPersonas()->getNrodoc(); ?></td>
  </tr>  
  <tr>
    <td><b>Domicilio:</b></td>
    <td colspan="3">
	    <?php 
	    $oContacto = $alumno->getPersonas()->getContacto();
	    echo $oContacto->getCallee()." ".$oContacto->getNumeroe(); 
	    ?>
    </td>
  </tr>  
  <tr>    
    <td><b>Telefono:</b></td>
    <td>
	    <?php 
	    echo $oContacto->getTelefonoFijo(); 
	    ?>
	</td>
    <td><b>Celular:</b></td>
    <td>
	    <?php 
	    echo $oContacto->getTelefonoMovil(); 
	    ?>
	</td>
  </tr>      
  <tr>
    <td><b>Plan de estudios:</b></td>
    <td colspan="3"><?php echo $alumno->getPlanesEstudios(); ?></td>
  </tr>  
  <tr>	
	<td><b><?php echo $form['fecha']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['fecha']->renderError() ?>
		<?php echo $form['fecha'] ?>
	</td>
	<td width="23%"><b><?php echo $form['cantidadprogramas']->renderLabel() ?></b></td>
	<td>
		<?php echo $form['cantidadprogramas']->renderError() ?>
		<?php echo $form['cantidadprogramas'] ?>
	</td>
  </tr>    
  <tr>
	<td><b><?php echo $form['observaciones']->renderLabel() ?></b></td>
	<td colspan="3">
		<?php echo $form['observaciones']->renderError() ?>
		<?php echo $form['observaciones'] ?>
	</td>
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
		    	$materias_equiv = $alumno->obtenerMateriasHabilitadas('R','L');

		    	foreach($materias_equiv as $materia) {
		    		$materias_equivalencias[$materia['idmateriaplan']] = $materia['idmateriaplan'];
		    	}    	
		    	foreach ($materias as $materia_plan) {

		    		if (array_key_exists((int)$materia_plan->getIdmateriaplan(), $materias_equivalencias)) {
						$color = "";
					} else {
						$color = "bgcolor='red'";
					}
					$oAluMat = Doctrine::getTable('AluMat')->tieneAprobado($alumno->getIdalumno(), $materia_plan->getIdmateriaplan());
					
					if (!$oAluMat and $materia_plan->getAnodecursada()!=0) {
		    ?>
		    <tr class="fila_" <?php echo $color ?>>
		      <td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $materia_plan->getIdmateriaplan() ?>" /></td>
		      <td align="center">
		      <?php echo $materia_plan->getIdmateriaplan(); ?>
		      </td>
		      <td><?php echo $materia_plan; ?></td>
		      <td align="center"><?php echo $materia_plan->getAnodecursada(); ?></td>
		    </tr>
		    <?php 
		    		}
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
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('equivalencias/index') ?>'"></p>
<br>