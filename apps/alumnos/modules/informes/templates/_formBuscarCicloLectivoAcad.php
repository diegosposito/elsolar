<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('informes/informeaspirantescicloacad') ?>" method="post" enctype="multipart/form-data">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Aceptar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php if ($mensaje) {?>
      <tr>
        <td colspan="2" align="center">
          <b><font color="red"><div id="mensaje"><?php echo $mensaje; ?></div></font></b>
        </td>
      </tr>    
     <?php } ?>
      <tr>
        <td width="20%"><b><?php echo $form['listado']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['listado'] ?>
        </td>
      </tr> 
	  <tr>
        <td width="20%"><b><?php echo $form['idciclo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idciclo'] ?>
        </td>
      </tr>
	  <tr>
        <td width="20%"><b><?php echo $form['formatos']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['formatos'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
