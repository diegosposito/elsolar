 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
    a.tooltip {outline:none; }

    a.tooltip strong {line-height:30px;}
    a.tooltip:hover {text-decoration:none;} 
    a.tooltip span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:315px; line-height:16px;
    }
    a.tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
        
    /*CSS3 extras*/
    a.tooltip span
    {
        border-radius:4px;
        box-shadow: 5px 5px 8px #CCC;
    }
  </style>
<br>
<h1 align="center" style="color:black;">Gestión Horas Trabajadas</h1>
<br>
<form action="<?php echo url_for('informes/verdetalle'); ?>" method="post" >
<?php 
$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Setiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'); 
$anios =array();
$anioactual = date('Y');
for($i = $anioactual; $i >= $anioactual-10; $i--){
    $anios[] = $i;
}
?>
<div align="center">
<b>Seleccionar Mes:</b> <select id="idmes" name="idmes">
      <?php foreach ($meses as $k => $v) { ?>
        <option value="<?php echo $k ?>" <?php if ($k == $idmes) { ?>selected<?php } ?>><?php echo $v ?></option>
      <?php } ?>
</select>  
<br>
<b>Seleccionar Año:</b> <select id="idanio" name="idanio">
      <?php foreach ($anios as $anio) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $idanio) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
</select> 
<br>
<input style="background:#f79de7;height: 30px;width: 140px;font-size: 12px;" type=submit value="Obtener Informacion">
</div>
</form>
 
<table>
  <tbody>
    <tr>
      <th>Persona:</th>
      <td><?php echo $persona->getApellido().', '.$persona->getNombre(); ?></td>
    </tr>
      <th>Período Informado:</th>
      <td><?php echo $mesactual." de ".$anioelegido; ?></td>
    </tr>
    </tr>
      <th>Total de horas trabajadas en el mes:</th>
      <td><?php echo $horas_mensuales_trabajadas; ?></td>
    </tr>
     </tr>
      <th>Total Primer Quincena:</th>
      <td><?php echo $horas_primer_quincena; ?></td>
    </tr>
     </tr>
      <th>Total Segunda Quincena:</th>
      <td><?php echo $horas_segunda_quincena; ?></td>
    </tr>
  </tbody>
</table>

<hr />
<br>
<a target="_blank" href="<?php echo url_for('informes/personalhorasdetallepdf?idpersona='.$idpersona).'/idmes/'.$idmes.'/idanio/'.$idanio ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table width="100%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="50%" align="center" class="hed">Persona</td>
        <td width="20%" align="center" class="hed">Fecha</td>
        <td width="20%" align="center" class="hed">Horas Trabajadas</td>
        <td width="20%" align="center" class="hed">Observaciones</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($detalle_mensual_detallado as $dt){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="50%" align="left"><?php echo $dt['nombrecompleto'] ?></td>
        <td width="20%" align="center"><?php echo $dt['date'] ?></td>
        <td width="20%" align="center"><?php echo $dt['hora'] ?></td>
        <?php if ($dt['cantidadobs'] > 0) { ?>
        <td width="10%" align="left"><a href="#" class="tooltip"><div style="align: left;"><?php echo "Observaciones"; ?><span><br><strong><?php echo "Observaciones"; ?></strong><br><?php echo htmlspecialchars_decode($dt['observaciones']) ?></span></div></a></td>
        <?php } else { ?>
       <td width="10%" align="left"> </td>
       <?php } ?>
      
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
&nbsp;
<br>
<table width="100%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="50%" align="center" class="hed">Persona</td>
        <td width="15%" align="center" class="hed">Fecha</td>
        <td width="15%" align="center" class="hed">Hora Ingreso</td>
        <td width="15%" align="center" class="hed">Hora Egreso</td>
        <td width="5%" align="center" class="hed">Estado</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($superdetallado as $st){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="50%" align="left"><?php echo $st['nombrecompleto'] ?></td>
        <td width="15%" align="left"><?php echo $st['fecha'] ?></td>
        <td width="15%" align="left"><?php echo $st['horaingreso'] ?></td>
        <td width="15%" align="left"><?php echo $st['horaegreso'] ?></td>
        <td width="5%" align="left">
        <?php if ($st['estado']){ ?>
                 <img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/accept_ico.png' align='center' width='20' height='20' />
         <?php } else { ?>
                 <img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/wrong_ico.png' align='center' width='20' height='20' />
        <?php } ?>
        </td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
  <br>

