<table>
  <tbody>
    <tr>
      <th>Persona:</th>
      <td><?php echo $persona->getApellido().', '.$persona->getNombre(); ?></td>
    </tr>
      <th>Período Informado:</th>
      <td><?php echo $mesactual." de ".$anio; ?></td>
    </tr>
    </tr>
      <th>Total de horas trabajadas en el mes:</th>
      <td><?php echo $horas_mensuales_trabajadas; ?></td>
    </tr>
  </tbody>
</table>

<hr />
<br>
<a target="_blank" href="<?php echo url_for('horarios/personalhorasdetallepdf?idpersona='.$idpersona).'/idmes/'.$idmes.'/idanio/'.$anio ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table width="100%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="60%" align="center" class="hed">Persona</td>
        <td width="20%" align="center" class="hed">Fecha</td>
        <td width="20%" align="center" class="hed">Horas Trabajadas</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($detalle_mensual_detallado as $dt){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="60%" align="left"><?php echo $dt['nombrecompleto'] ?></td>
        <td width="20%" align="left"><?php echo $dt['date'] ?></td>
        <td width="20%" align="left"><?php echo $dt['hora'] ?></td>
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
        <td width="40%" align="center" class="hed">Persona</td>
        <td width="20%" align="center" class="hed">Fecha</td>
        <td width="20%" align="center" class="hed">Tipo Registro</td>
        <td width="20%" align="center" class="hed">Estado</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($superdetallado as $st){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="40%" align="left"><?php echo $st['nombrecompleto'] ?></td>
        <td width="20%" align="left"><?php echo $st['date'] ?></td>
        <td width="20%" align="left"><?php echo $st['tiporegistro'] ?></td>
        <td width="20%" align="left"><?php echo $st['estado'] ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
  <br>
<a href="<?php echo url_for('horarios/registro') ?>">Volver al listado</a>
