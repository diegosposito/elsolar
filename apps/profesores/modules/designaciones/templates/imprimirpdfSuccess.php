<br><div align="center">
<h1>Imprimir Designaciones</h1><br>
<form action="<?php echo url_for('designaciones/imprimirpdf') ?>" method="post">
  <table cellspacing="0" class="stats" width="70%">
    <?php echo $form ?>
    <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $oPersona->getIdPersona(); ?>">
  <tr><td colspan="2" align="center"><input type="submit" value="Imprimir" /></td></tr>  
  </table>
</form>
</div>
<br>
 <table cellspacing="0" class="stats" width="70%">
 <tr><td colspan="2" align="center"></td></tr> 
     <?php if ($oPersona) { ?>
     <tr><td colspan="2" align="center"><p>Profesor(a) seleccionado(a): <b><?php echo $oPersona->getApellido().", ".$oPersona->getNombre(); ?></b></p></td></tr>   
     <?php } ?>
 </table> 
<br>
  
  <br>
  <a href="<?php echo url_for('designaciones') ?>">Volver al listado</a>
  <br><br>
