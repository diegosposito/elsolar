<script>
$(document).ready(function(){
    $('#idfacultad').change(function(){  
        if ($('#idfacultad').val()!=0){
	    	$.post("<?php echo url_for('facultades/obtenercarreras'); ?>",
	    	    { idfacultad:$('#idfacultad').val() },
	    	    function(data){
	    	    	$('#idplanestudio').html(data);
	        	}
	        );
        } else {
        	$('#idplanestudio').html("<option value='0' selected='selected'>----TODOS----</option>");
		}
    });               
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('egresados/index') ?>" method="post" enctype="multipart/form-data">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot> 
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Aceptar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php if ($mensaje) {?>
      <tr>
        <td colspan="2" align="center">
          <b><font color="red"><div id="mensaje"><?php echo $mensaje; ?></div></font></b>
        </td>
      </tr>    
     <?php } ?>
	  <tr>
        <td width="20%"><b><?php echo $form['idfacultad']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idfacultad'] ?>
        </td>
      </tr>
      <tr>
        <td width="20%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr> 
	  <tr>
        <td width="20%"><b><?php echo $form['idsede']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idsede'] ?>
        </td>
      </tr>
	  <tr>
        <td width="20%"><b><?php echo $form['idestado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idestado'] ?>
        </td>
      </tr>      
      <tr>
        <td width="20%"><b><?php echo $form['ordencampo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['ordencampo']->renderError() ?>
          <?php echo $form['ordencampo'] ?>
          <?php echo $form['ordenmetodo']->renderError() ?>
          <?php echo $form['ordenmetodo'] ?>          
        </td>
      </tr>     
    </tbody>
  </table>
</form>
</div>