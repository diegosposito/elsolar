<br>
<div align="center">
<h1>Registrar meses de cobro</h1><br>
<h3><?php echo $persona->getApellido().', '.$persona->getNombre(); ?></h3>
<form action="<?php echo url_for('personas/registrarcobro') ?>" method="post">
<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $persona->getIdPersona(); ?>">
 
 <br>
<table cellspacing="0" class="stats" width="70%">
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==1) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="1">Enero</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==2) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="2">Febrero</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==3) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="3">Marzo</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==4) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="4">Abril</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==5) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="5">Mayo</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==6) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="6">Junio</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==7) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="7">Julio</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==8) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="8">Agosto</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==9) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="9">Septiembre</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==10) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="10">Octubre</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==11) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="11">Noviembre</input></td></tr>
<?php 
$checked='';
foreach($resultado as $dato)
	if($dato==12) $checked = 'checked';
?>
<tr><td colspan="2" align="left"><input type="checkbox" name="meses[]" <?php echo $checked ?> value="12">Diciembre</input></td></tr>

 <br>
 <tr><td colspan="2" align="center"><input type="submit" value="Registrar Cobro" /></td></tr>  
 </table>
 </form>
 </div>
  
  <br>
  <a href="<?php echo url_for('personas/buscar') ?>">Volver</a>
  <br><br>