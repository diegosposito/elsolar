<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('aulas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idaula='.$form->getObject()->getIdaula() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'aulas/delete?idaula='.$form->getObject()->getIdaula(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
        <td><?php echo $form['ubicacion']->renderLabel() ?></td>
        <td>
          <?php echo $form['ubicacion']->renderError() ?>
          <?php echo $form['ubicacion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['piso']->renderLabel() ?></td>
        <td>
          <?php echo $form['piso']->renderError() ?>
          <?php echo $form['piso'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['capacidad']->renderLabel() ?></td>
        <td>
          <?php echo $form['capacidad']->renderError() ?>
          <?php echo $form['capacidad'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['descripcion']->renderLabel() ?></td>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipoaula']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipoaula']->renderError() ?>
          <?php echo $form['idtipoaula'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('aulas/index?idedificio='.$idedificio) ?>'"></p>
<br>