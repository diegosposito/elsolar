<br>
<div align="center">
<h1>Registrar meses de cobro</h1><br>
<h3><?php echo $persona->getApellido().', '.$persona->getNombre(); ?></h3>
<form action="<?php echo url_for('personas/registrarcobro') ?>" method="post">
<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $persona->getIdPersona(); ?>">
 
 <br>
 <table cellspacing="0" class="stats" width="70%">
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="1">Enero</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="2">Febrero</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="3">Marzo</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="4">Abril</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="5">Mayo</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="6">Junio</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="7">Julio</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="8">Agosto</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="9">Septiembre</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="10">Octubre</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="11">Noviembre</input></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" value="12">Diciembre</input></td></tr>

 <br>
 <tr><td colspan="2" align="center"><input type="submit" value="Registrar Cobro" /></td></tr>  
 </table>
 </form>
 </div>
  
  <br>
  <a href="<?php echo url_for('personas/buscar') ?>">Volver</a>
  <br><br>