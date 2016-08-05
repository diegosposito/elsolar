<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('detallenota/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?iddetallenota='.$form->getObject()->getIddetallenota() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'detallenota/delete?iddetallenota='.$form->getObject()->getIddetallenota(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['descripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['resultado']->renderLabel() ?></th>
        <td>
          <?php echo $form['resultado']->renderError() ?>
          <?php echo $form['resultado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['activo']->renderLabel() ?></th>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['valorinferior']->renderLabel() ?></th>
        <td>
          <?php echo $form['valorinferior']->renderError() ?>
          <?php echo $form['valorinferior'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['valorsuperior']->renderLabel() ?></th>
        <td>
          <?php echo $form['valorsuperior']->renderError() ?>
          <?php echo $form['valorsuperior'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('detallenota/index?idescalanota='.$idescalanota) ?>'"></p>
<br>