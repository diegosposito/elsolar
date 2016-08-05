<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="center">
<form action="<?php echo url_for('mesasexamenes/ingresarnotas'); ?>" method="post">
  <table cellspacing="0" class="stats" width="40%">
    <tfoot>
      <tr>
        <td colspan="2" align="center" >
          <input type="submit" value="Buscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php if ($error){ ?>
      <tr>
        <td colspan="2" align="left" >
          <?php echo $error; ?>
        </td>
      </tr>
    <?php } ?>
      <?php echo $form ?>
    </tbody>
  </table> 
</form>
</div>
<br>