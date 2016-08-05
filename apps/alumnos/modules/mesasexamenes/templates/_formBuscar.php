<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mesasexamenes/index'); ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="16%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>               
      <tr>
        <td><b><?php echo $form['idestado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idestado']->renderError() ?>
          <?php echo $form['idestado'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['ordencampo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['ordencampo']->renderError() ?>
          <?php echo $form['ordencampo'] ?>
          <?php echo $form['ordenmetodo']->renderError() ?>
          <?php echo $form['ordenmetodo'] ?>          
        </td>
      </tr>        
    </tbody>
  </table>
</form>
</div><br>