<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('sedes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idsede='.$form->getObject()->getIdsede() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'sedes/delete?idsede='.$form->getObject()->getIdsede(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="15%"><?php echo $form['nombre']->renderLabel() ?></td>
        <td>
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['direccion']->renderLabel() ?></td>
        <td>
          <?php echo $form['direccion']->renderError() ?>
          <?php echo $form['direccion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['telefonos']->renderLabel() ?></td>
        <td>
          <?php echo $form['telefonos']->renderError() ?>
          <?php echo $form['telefonos'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['email']->renderLabel() ?></td>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['imgencabezado']->renderLabel() ?></td>
        <td>
          <?php echo $form['imgencabezado']->renderError() ?>
          <?php echo $form['imgencabezado'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['imgpie']->renderLabel() ?></td>
        <td>
          <?php echo $form['imgpie']->renderError() ?>
          <?php echo $form['imgpie'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtiposede']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtiposede']->renderError() ?>
          <?php echo $form['idtiposede'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('sedes/index') ?>'"></p>
<br>