<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('facultades/guardarparametros') ?>" method="post">
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
      <?php echo $form ?>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('facultades/index') ?>'"></p>
<br>