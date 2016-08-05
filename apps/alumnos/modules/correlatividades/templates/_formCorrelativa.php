<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formAgregarCorrelativa">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" class="botonAgregarCorrelativa" value="Agregar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="20%"><b><?php echo $form['idmateriaplan']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idmateriaplan']->renderError() ?>
          <?php echo $form['idmateriaplan'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['situacion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['situacion']->renderError() ?>
          <?php echo $form['situacion'] ?>
        </td>
      </tr>      
      <tr>
        <td><b><?php echo $form['condicion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['condicion']->renderError() ?>
          <?php echo $form['condicion'] ?>
        </td>
      </tr>      
      <tr>
        <td><b><?php echo $form['idmateriaplanc']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idmateriaplanc']->renderError() ?>
          <?php echo $form['idmateriaplanc'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
