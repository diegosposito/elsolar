<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('titulosplanes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idtituloplan='.$form->getObject()->getIdtituloplan() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'titulosplanes/delete?idtituloplan='.$form->getObject()->getIdtituloplan(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idtitulo']->renderLabel() ?></th>
        <td>
          <?php echo $form['idtitulo']->renderError() ?>
          <?php echo $form['idtitulo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tieneorientacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['tieneorientacion']->renderError() ?>
          <?php echo $form['tieneorientacion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idmodoegreso']->renderLabel() ?></th>
        <td>
          <?php echo $form['idmodoegreso']->renderError() ?>
          <?php echo $form['idmodoegreso'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('titulosplanes/index?idplanestudio='.$idplanestudio) ?>'"></p>
<br>