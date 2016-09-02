 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Obras Sociales</h1>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
 <a href="<?php echo url_for('obrassociales/new') ?>">Nueva Obra Social</a>
 <br>
 <a href="<?php echo url_for('obrassociales/imprimir') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="40%" align="center" class="hed">Obra Social</td>
        <td width="5%" align="center" class="hed">Abrev.</td>
        <td width="15%" align="center" class="hed">Estado</td>
        <td width="10%" align="center" class="hed">Fec.Arancel</td>
        <td width="10%" align="center" class="hed">Fec.Ult.Per</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($obras_socialess as $obras_sociales){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="40%" align="center"><?php echo $obras_sociales->getDenominacion() ?></td>
        <td width="5%"><?php echo $obras_sociales->getAbreviada() ?></td>
        <?php $estado = ($obras_sociales->getEstado()==1) ? 'Habilitada' : 'No Habilitada'; ?>
        <td width="15%"><?php echo $estado ?></td>
        <td width="10%"><?php echo $obras_sociales->getFechaarancel() ?></td>
        <td width="10%"><?php echo $obras_sociales->getFechaultimoperiodo() ?></td>
        <td align="center"><?php echo link_to("Editar", 'obrassociales/edit?idobrasocial='.$obras_sociales->getIdobrasocial() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>


 

