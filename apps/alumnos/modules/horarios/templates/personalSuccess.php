 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Gestión Horas Trabajadas</h1>
<br>
<form action="<?php echo url_for('horarios/personal'); ?>" method="post" >
<?php 
$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Setiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'); 
$mesactual = date('m');
$anios =array();
$anioactual = date('Y');
for($i = $anioactual; $i >= $anioactual-10; $i--){
    $anios[] = $i;
}
?>
<div align="center">
<b>Seleccionar Mes:</b> <select id="meses" name="meses">
      <?php foreach ($meses as $k => $v) { ?>
        <option value="<?php echo $k ?>" <?php if ($k == $idmes) { ?>selected<?php } ?>><?php echo $v ?></option>
      <?php } ?>
</select>  
<br>
<b>Seleccionar Año:</b> <select id="anio" name="anio">
      <?php foreach ($anios as $anio) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $idanio) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
</select> 
<br>
<b>Persona:</b> <select id="idpersona" name="idpersona">
      echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
      <?php foreach ($personass as $persona) { ?>
        <option value="<?php echo $persona->getIdpersona() ?>" <?php if ($persona->getIdpersona() == $idpersona) { ?>selected<?php } ?>><?php echo $persona->getApellido().', '.$persona->getNombre() ?></option>
      <?php } ?>
</select>  
<br><br>
<input style="background:#f79de7;height: 30px;width: 140px;font-size: 12px;" type=submit value="Obtener Informacion">
</div>
<a target="_blank" href="<?php echo url_for('horarios/personalhoraspdf?idmes='.$idmes).'/idanio/'.$idanio ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table width="100%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="40%" align="center" class="hed">Persona</td>
        <td width="20%" align="center" class="hed">Mensual</td>
        <td width="20%" align="center" class="hed">Día Actual</td>
        <td width="20%" align="center" class="hed">Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($personas_tiempos as $personatiempo){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="40%" align="left"><?php echo $personatiempo['nombrecompleto'] ?></td>
        <td width="20%" align="left"><?php echo $personatiempo['hora'] ?></td>
        <td width="20%" align="left"><?php echo $personatiempo['hora_del_dia'] ?></td>
        <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
                <td width="20%" align="center"><a href="<?php echo url_for('horarios/verdetalle?id='.$personatiempo['idpersona']).'/idmes/'.$idmes.'/idanio/'.$idanio ?>"><?php echo 'Ver Detalle' ?></a></td>
        <?php } else { ?>
                <td width="20%" align="center"><?php echo ' - ' ?></a></td>
        <?php } ?>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
</form>  