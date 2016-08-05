<script>
$(document).ready(function(){
  $('#designaciones_idcarrera').append("<option value='0' selected='selected' >----Seleccione----</option>"); 
  $('#designaciones_idcatedra').attr('disabled',true);
  $('#designaciones_idcarrera').change(function(){
     // $('#materia').attr('disabled',false);
      if($('#designaciones_idcarrera').val()!=0){
          // cargar las materias de la carrera al combo
          $('#designaciones_idcatedra').attr('disabled',false);
          $.post("<?php echo url_for('designaciones/obtenermaterias'); ?>",{ idplanestudio:$(this).val() },function(data){$("#designaciones_idcatedra").html(data);})
      }else{
          $('#designaciones_idcatedra').attr('disabled',true);
        }
    });
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('designaciones/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?iddesignacion='.$form->getObject()->getIddesignacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('designaciones/index') ?>">Volver al listado</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'designaciones/delete?iddesignacion='.$form->getObject()->getIddesignacion(), array('method' => 'delete', 'confirm' => 'Seguro que desea eliminar esta designacion?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
