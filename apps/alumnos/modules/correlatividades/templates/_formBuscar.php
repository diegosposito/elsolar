<script>
$(document).ready(function(){
	cantidad = parseInt($("#idcarrera").length);
	if(cantidad==1){
		$('#idplanestudio').attr('disabled',false);
        // cargar los planes de estudios de la carrera al combo
   	    $.post("<?php echo url_for('carreras/obtenerplanes'); ?>",
			{ idcarrera:$('#idcarrera').val(), version: 0 },
			function(data){
				$('#idplanestudio').html(data);
			}
		);		
	} else {
		$('#idplanestudio').attr('disabled',true);
	}

    $('#idcarrera').change(function(){    	
        // cargar los planes de estudios de la carrera al combo
   	    $.post("<?php echo url_for('carreras/obtenerplanes'); ?>",
			{ idcarrera:$('#idcarrera').val(), version: 0 },
			function(data){
				$('#idplanestudio').html(data);
			}
		);
    });
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('correlatividades/index'); ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Buscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
        <tr>
        <td width="20%"><b><?php echo $form['idcarrera']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcarrera']->renderError() ?>
          <?php echo $form['idcarrera'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
</div><br>