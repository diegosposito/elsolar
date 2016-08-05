<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('solicitudeslibredeuda/guardar?id='.$form->getObject()->getId()) ?>" method="post" >
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
        <td width="20%"><b><?php echo $form['observaciones']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr> 
    </tbody>
  </table>
</form>