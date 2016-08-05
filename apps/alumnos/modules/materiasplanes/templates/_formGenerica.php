<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post" id="formAgregarOptativa">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" class="botonAgregarOptativa" value="Agregar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td><?php echo $form['idmateriaplan']->renderLabel() ?></td>
        <td>
          <?php echo $form['idmateriaplan']->renderError() ?>
          <?php echo $form['idmateriaplan'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['valormateria']->renderLabel() ?></td>
        <td>
          <?php echo $form['valormateria']->renderError() ?>
          <?php echo $form['valormateria'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
