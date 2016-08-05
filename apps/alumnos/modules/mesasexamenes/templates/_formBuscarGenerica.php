<script>
$(document).ready(function(){
    $('#botonBuscar').click(function() {
		// guardar la informacion personal del aspirante ingresada
   	    $.post("<?php echo url_for('mesasexamenes/obtenermateriasgenericas'); ?>",
   			{ idplanestudio: $('#idplanestudio').val() },
   			function(data){
   				$('#materiasgenericas').html(data);
   			}
   		); 	    
		return false;
   	});                
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post" >
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
    </tbody>
  </table>
</form>
</div><br>
<div id="materiasgenericas" align="center"></div>
<br>