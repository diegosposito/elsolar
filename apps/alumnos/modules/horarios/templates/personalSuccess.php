 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Gestión Horas Trabajadas</h1>
<br>
<?php 
$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Setiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'); 
$mesactual = date('m');
$mesactual = (int) $mesactual;
$anios =array();
$anioactual = date('Y');
for($i = $anioactual; $i >= $anioactual-10; $i--){
    $anios[] = $i;
}
?>
<div align="center">
<b>Seleccionar Mes:</b> <select id="meses" name="meses">
      <?php foreach ($meses as $k => $v) { ?>
        <option value="<?php echo $k ?>" <?php if ($k == $mesactual) { ?>selected<?php } ?>><?php echo $v ?></option>
      <?php } ?>
</select>  
<br>
<b>Seleccionar Año:</b> <select id="anio" name="anio">
      <?php foreach ($anios as $anio) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioactual) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
</select>  
<br>

</div>
<a target="_blank" href="<?php echo url_for('informes/profesionalespdf') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="5%" align="center" class="hed">Matrícula</td>
        <td width="30%" align="center" class="hed">Nombre</td>
        <td width="20%" align="center" class="hed">Dirección</td>
        <td width="10%" align="center" class="hed">Teléfono</td>
        <td width="35%" align="center" class="hed">Ciudad</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($profesionaless as $profesionales){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="5%" align="left"><?php echo $profesionales->getNrolector() ?></td>
        <td width="30%" align="left"><a href="#" title="<?php echo $profesionales->getHorarios() ?>"> <?php echo $profesionales->getApellido().', '.$profesionales->getNombre() ?> </a></td>
        <td width="20%" align="left"><?php echo $profesionales->getMostrarinfocontacto() ? $profesionales->getDireccion() : ' - ' ?></td>
        <td width="10%" align="left"><?php echo $profesionales->getMostrarinfocontacto() ? $profesionales->getTelefono() : ' - '  ?></td>
        <td width="35%" align="left"><?php echo $profesionales->getCiudad() ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>