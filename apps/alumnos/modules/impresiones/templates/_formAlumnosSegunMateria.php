<script>
$(document).ready(function(){
	$('#botonBuscar').attr('disabled',true);
	cantidad = parseInt($('#idplanestudio').length);
	if(cantidad==1) {
        // cargar las catedras del plan de plan y de la sede al combo
   	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
			{ idplanestudio: $('#idplanestudio').val(), idsede: $('#idsede').val() },
			function(data){
				if (data!=""){
					$('#idcatedra').html(data);
				}else{
					$('#idcatedra').attr('disabled',true);
					$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
				}
			}
		);	
   	 	$('#botonBuscar').attr('disabled',false);	
	} else {
		$('#idcatedra').attr('disabled',true);
	}
	
    $('#idplanestudio').change(function(){
    	$('#idcatedra').attr('disabled',false);
    	if($('#idplanestudio').val()!=0){
	        // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
				{ idplanestudio: $('#idplanestudio').val(), idsede: $('#idsede').val() },
				function(data){
					if (data!=""){
						$('#idcatedra').html(data);
					}else{
						$('#idcatedra').attr('disabled',true);
						$('#idcatedra').html("<option value='0' selected='selected' >----NINGUNA----</option>");
					}
				}
			);
        	$('#botonBuscar').attr('disabled',false);
    	}else{
        	$('#idcatedra').attr('disabled',true);
        }
    }); 

    $('#fecha').datepicker({
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

});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Visualizar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>  
    <tbody>
	  <?php if ($mensaje) { ?>
	  <tr>
		<td colspan="2"><b><font color="red"><?php echo $mensaje; ?></font></b></td>
	  </tr>
  	  <?php } ?>    
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="10%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['idcatedra']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcatedra']->renderError() ?>
          <?php echo $form['idcatedra'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['fecha']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?> para considerar correlativas aprobadas
        </td>
      </tr>  
    </tbody>  
  </table>
</form>
</div>
<br>