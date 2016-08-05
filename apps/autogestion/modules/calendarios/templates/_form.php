<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('calendarios/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idcalendario='.$form->getObject()->getIdcalendario() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('calendarios/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'calendarios/delete?idcalendario='.$form->getObject()->getIdcalendario(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idfacultad']->renderLabel() ?></th>
        <td>
          <?php echo $form['idfacultad']->renderError() ?>
          <?php echo $form['idfacultad'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['descripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['anio']->renderLabel() ?></th>
        <td>
          <?php echo $form['anio']->renderError() ?>
          <?php echo $form['anio'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['resolucion']->renderLabel() ?></th>
        <td>
          <?php echo $form['resolucion']->renderError() ?>
          <?php echo $form['resolucion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['activo']->renderLabel() ?></th>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
