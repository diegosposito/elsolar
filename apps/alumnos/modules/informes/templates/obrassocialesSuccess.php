 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Obras Sociales</h1>

 <a target="_blank" href="<?php echo url_for('informes/obrassocialespdf') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="60%" align="left" class="hed">Obra Social</td>
        <td width="30%" align="left" class="hed">Abrev.</td>
        <td width="10%" align="center" class="hed">Archivos</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($obras_socialess as $obras_sociales){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="60%" align="left"><?php echo $obras_sociales->getDenominacion() ?></td>
        <td width="30%"><?php echo $obras_sociales->getAbreviada() ?></td>
        <td align="center"><?php echo link_to("Visualizar", 'informes/mostrararchivos?idobrasocial='.$obras_sociales->getIdobrasocial() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>