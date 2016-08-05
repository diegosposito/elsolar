<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('contactos/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idcontacto='.$form->getObject()->getIdcontacto() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('contactos/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'contactos/delete?idcontacto='.$form->getObject()->getIdcontacto(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idpersona']->renderLabel() ?></th>
        <td>
          <?php echo $form['idpersona']->renderError() ?>
          <?php echo $form['idpersona'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idciudade']->renderLabel() ?></th>
        <td>
          <?php echo $form['idciudade']->renderError() ?>
          <?php echo $form['idciudade'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['callee']->renderLabel() ?></th>
        <td>
          <?php echo $form['callee']->renderError() ?>
          <?php echo $form['callee'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['numeroe']->renderLabel() ?></th>
        <td>
          <?php echo $form['numeroe']->renderError() ?>
          <?php echo $form['numeroe'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['barrioe']->renderLabel() ?></th>
        <td>
          <?php echo $form['barrioe']->renderError() ?>
          <?php echo $form['barrioe'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['edificioe']->renderLabel() ?></th>
        <td>
          <?php echo $form['edificioe']->renderError() ?>
          <?php echo $form['edificioe'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['pisoe']->renderLabel() ?></th>
        <td>
          <?php echo $form['pisoe']->renderError() ?>
          <?php echo $form['pisoe'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deptoe']->renderLabel() ?></th>
        <td>
          <?php echo $form['deptoe']->renderError() ?>
          <?php echo $form['deptoe'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idciudadt']->renderLabel() ?></th>
        <td>
          <?php echo $form['idciudadt']->renderError() ?>
          <?php echo $form['idciudadt'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['callet']->renderLabel() ?></th>
        <td>
          <?php echo $form['callet']->renderError() ?>
          <?php echo $form['callet'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['numerot']->renderLabel() ?></th>
        <td>
          <?php echo $form['numerot']->renderError() ?>
          <?php echo $form['numerot'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['barriot']->renderLabel() ?></th>
        <td>
          <?php echo $form['barriot']->renderError() ?>
          <?php echo $form['barriot'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['edificiot']->renderLabel() ?></th>
        <td>
          <?php echo $form['edificiot']->renderError() ?>
          <?php echo $form['edificiot'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['pisot']->renderLabel() ?></th>
        <td>
          <?php echo $form['pisot']->renderError() ?>
          <?php echo $form['pisot'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deptot']->renderLabel() ?></th>
        <td>
          <?php echo $form['deptot']->renderError() ?>
          <?php echo $form['deptot'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['telefonofijocar']->renderLabel() ?></th>
        <td>
          <?php echo $form['telefonofijocar']->renderError() ?>
          <?php echo $form['telefonofijocar'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['telefonofijonum']->renderLabel() ?></th>
        <td>
          <?php echo $form['telefonofijonum']->renderError() ?>
          <?php echo $form['telefonofijonum'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['celularcar']->renderLabel() ?></th>
        <td>
          <?php echo $form['celularcar']->renderError() ?>
          <?php echo $form['celularcar'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['celularnum']->renderLabel() ?></th>
        <td>
          <?php echo $form['celularnum']->renderError() ?>
          <?php echo $form['celularnum'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
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
