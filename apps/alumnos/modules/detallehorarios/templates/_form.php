<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('detallehorarios/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="idlista" value="<?php echo $idlistahorario; ?>">
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<input type="hidden" id="idlistahorario" name="idlistahorario" value="<?php echo $idlistahorario; ?>">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('detallehorarios/index?idlistahorario='.$idlistahorario) ?>">Volver al listado</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'detallehorarios/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Seguro deseas borrar este registro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
