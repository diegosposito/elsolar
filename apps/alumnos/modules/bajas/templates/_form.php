<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('bajas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idbaja='.$form->getObject()->getIdbaja() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('bajas/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'bajas/delete?idbaja='.$form->getObject()->getIdbaja(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idalumno']->renderLabel() ?></th>
        <td>
          <?php echo $form['idalumno']->renderError() ?>
          <?php echo $form['idalumno'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tipobaja']->renderLabel() ?></th>
        <td>
          <?php echo $form['tipobaja']->renderError() ?>
          <?php echo $form['tipobaja'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['otromotivo']->renderLabel() ?></th>
        <td>
          <?php echo $form['otromotivo']->renderError() ?>
          <?php echo $form['otromotivo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_by']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_by']->renderError() ?>
          <?php echo $form['created_by'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_by']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_by']->renderError() ?>
          <?php echo $form['updated_by'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
