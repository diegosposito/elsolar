<script>
$(document).ready(function(){
	$('#inicio').datepicker({
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
	$('#inicio').datepicker("setDate", "01-01-2000");
	$('#fin').datepicker({
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
	$('#fin').datepicker("setDate", new Date());
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('estadosalumno/obteneralumnos'); ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="16%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>               
      <tr>
        <td><b><?php echo $form['idestado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idestado']->renderError() ?>
          <?php echo $form['idestado'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['inicio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['fin']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>       
    </tbody>
  </table>
</form>
</div><br>