<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('asignaciones/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idasignacion='.$form->getObject()->getIdasignacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('asignaciones/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'asignaciones/delete?idasignacion='.$form->getObject()->getIdasignacion(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['dia']->renderLabel() ?></th>
        <td>
          <?php echo $form['dia']->renderError() ?>
          <?php echo $form['dia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['inicio']->renderLabel() ?></th>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fin']->renderLabel() ?></th>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['horainicio']->renderLabel() ?></th>
        <td>
          <?php echo $form['horainicio']->renderError() ?>
          <?php echo $form['horainicio'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['horafin']->renderLabel() ?></th>
        <td>
          <?php echo $form['horafin']->renderError() ?>
          <?php echo $form['horafin'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['observaciones']->renderLabel() ?></th>
        <td>
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idaula']->renderLabel() ?></th>
        <td>
          <?php echo $form['idaula']->renderError() ?>
          <?php echo $form['idaula'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idtipoasignacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['idtipoasignacion']->renderError() ?>
          <?php echo $form['idtipoasignacion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
