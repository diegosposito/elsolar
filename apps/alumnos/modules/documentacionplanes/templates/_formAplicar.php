0<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
$(document).ready(function(){	
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
        if ($(this).attr('checked')==true) {
			//$('.case').attr('checked', this.checked);
			$(".case").each(function(){
				if ($(this).attr('disabled')==true) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked", "cehcked");
				}
			});  
        }else{
        	$('.case').attr('checked', this.checked);
		}	                 
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
});

function validarFormulario(){
	var resultado = true;

	if(!$('input:checkbox:checked').val()) {
		resultado = "Debe seleccionar al menos un plan de estudios.";
	} 
 
	return resultado;
} 
</script>
<div align="center" >
<form action="<?php echo url_for('documentacionplanes/guardar') ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">

      <tr>
        <td><b><?php echo $form['idtipodocumentacion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idtipodocumentacion']->renderError() ?>
          <?php echo $form['idtipodocumentacion'] ?>
        </td>
      </tr>  
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" id="botonGuardar"/>
        </td>
      </tr>            
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td align="center" class="hed" width="3%"><input type="checkbox" id="selectall" /></td>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="92%">Carrera</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($planes_estudios) > 0){ ?>
            <?php $i=0; ?>
		    <?php foreach ($planes_estudios as $planestudio) { ?>
		    <tr class="fila_<?php echo $i%2 ; ?>">
		      <td align="center">
					<input type="checkbox" class="case" name="planes[<?php echo $planestudio->getIdplanestudio(); ?>]" value="<?php echo $planestudio->getIdplanestudio(); ?>" >
		      </td>
		      <td align="center"><?php echo $planestudio->getIdplanestudio(); ?></td>
		      <td><?php echo $planestudio; ?></td>
		    </tr>
            <?php $i++; ?>	
		    <?php } ?>
		    <?php } else { ?>
		    <tr>
		      <td colspan="3" align="center">No existen registros.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>      
    </tbody>
  </table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('documentacionesplanes/index') ?>'"></p>
<br>