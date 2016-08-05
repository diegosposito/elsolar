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
});

</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('noticias/guardar') ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form['idusuario']->render() ?>
          <?php echo $form['idnoticia']->render() ?>
          <input type="submit" value="Guardar" id="botonGuardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
	  <tr>
	   <td colspan="2">
	   	<b><font color="red"><div id="mensaje"></div></font></b>
	   </td>
	  </tr>	     
      <tr>
        <td width="15%"><?php echo $form['titulo']->renderLabel() ?></td>
        <td >
          <?php echo $form['titulo']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['intro']->renderLabel() ?></td>
        <td>
          <?php echo $form['intro']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['leer_mas']->renderLabel() ?></td>
        <td>
          <?php echo $form['leer_mas']->render() ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['descripcion']->renderLabel() ?></td>
        <td>
          <?php echo $form['descripcion']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['carrera']->renderLabel() ?></td>
        <td>
          <?php echo $form['carrera']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['inicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['inicio']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['fin']->renderLabel() ?></td>
        <td>
          <?php echo $form['fin']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['is_active']->renderLabel() ?></td>
        <td>
          <?php echo $form['is_active']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['orden']->renderLabel() ?></td>
        <td>
          <?php echo $form['orden']->render() ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['privada']->renderLabel() ?></td>
        <td>
          <?php echo $form['privada']->render() ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
