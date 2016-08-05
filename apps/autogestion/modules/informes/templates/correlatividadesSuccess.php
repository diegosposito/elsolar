<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Régimen de Correlatividades de Planes Estudios</h1>
	</td>
	</tr>
</table>
<br>
<div align="center">
<form action="<?php echo url_for('informes/mostrarcorrelatividades') ?>" method="post">
  <table cellspacing="0" class="stats" width="70%">
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
        <td colspan="2">
          <b><font color="red"><div id="mensaje"><?php echo $mensaje; ?></div></font></b>
        </td>
      </tr>    
     <?php } ?>
     <?php echo $form ?>
    </tbody>
  </table>
</form>
</div>
