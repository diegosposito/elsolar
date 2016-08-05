<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
  
<form action="<?php echo url_for('derivaciones/guardarderivacion?url='.$url) ?>" method="post" >
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form ?></th>
      </tr>
    </tbody>    
  </table>
</form>