<script>
$(document).ready(function(){
    $('#botonGuardar').click(function() {
    	var content = tinyMCE.activeEditor.getContent();
    	// guardar la solicitud
		$.post("<?php echo url_for('solicitudes/guardar'); ?>",
  		   	{idcarrera: $("#solicitudes_idcarrera").val(), descripcion: content },
   			function(data){
   				alert(data);
   				$(location).attr('href',"<?php echo url_for('solicitudes/index'); ?>");
   			}
   		);
		return false;
   	});
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post" id="formSolicitud">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table width="100%" class="stats" cellspacing="0">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input id="botonGuardar" type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
     </tbody>
  </table>
</form>
