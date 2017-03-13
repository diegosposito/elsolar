 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Detalle de horas del Listado</h1>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
<a href="<?php echo url_for('detallehorarios/new?idlistahorario='.$idlistahorario) ?>">Nuevo Detalle de Horas</a>

 <br>
 <a href="<?php echo url_for('informes/obrassocialespdf') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="15%" align="center" class="hed">Centro</td>
        <td width="30%" align="center" class="hed">Profesional</td>
        <td width="30%" align="center" class="hed">Paciente</td>
        <td width="10%" align="center" class="hed">Día</td>
        <td width="6%" align="center" class="hed">Desde</td>
        <td width="6%" align="center" class="hed">Hasta</td>
        <td colspan=2 width="3%" align="center" class="hed">Edición</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($detalle_horarioss as $detalle_horarios){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="15%" align="center"><?php echo $detalle_horarios['cenabreviado']  ?></td>
        <td width="30%"><?php echo $detalle_horarios['profesional']  ?></td>
        <td width="30%"><?php echo $detalle_horarios['paciente']  ?></td>
        <td width="10%"><?php echo $detalle_horarios['dia_descripcion']  ?></td>
        <td width="6%"><?php echo $detalle_horarios['hdesde']  ?></td>
        <td width="6%"><?php echo $detalle_horarios['hhasta']  ?></td>
        <td align="center"><?php echo link_to("Editar", 'detallehorarios/edit?id='.$detalle_horarios['id'] ,'class="mhead"'); ?></td>
        <td align="center"><?php echo link_to("Clonar", 'detallehorarios/clonar?id='.$detalle_horarios['id'] ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
