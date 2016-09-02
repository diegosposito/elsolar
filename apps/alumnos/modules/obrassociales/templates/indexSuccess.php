 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
<h1 align="center" style="color:black;">Listado de Obras Sociales</h1>
<br>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="50%" align="center" class="hed">Obra Social</td>
        <td width="10%" align="center" class="hed">Abreviada</td>
        <td width="20%" align="center" class="hed">Estado</td>
        <td width="10%" align="center" class="hed">Fecha Arancel</td>
        <td width="10%" align="center" class="hed">Fecha Ult Periodo</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($obras_socialess as $obras_sociales){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="50%" align="center"><?php echo $obras_sociales->getDenominacion() ?></td>
        <td width="10%"><?php echo $obras_sociales->getAbreviada() ?></td>
        <?php $estado = ($obras_sociales->getEstado()==1) ? 'Habilitada' : 'No Habilitada'; ?>
        <td width="20%"><?php echo $estado ?></td>
        <td width="10%"><?php echo $obras_sociales->getFechaarancel() ?></td>
        <td width="10%"><?php echo $obras_sociales->getFechaultimoperiodo() ?></td>
        <td align="center"><?php echo link_to("Editar", 'obrassociales/edit?idobrasocial='.$obras_sociales->getIdobrasocial() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
  <br><br>
    </tbody>
  </table>


  <a href="<?php echo url_for('obrassociales/new') ?>">Nueva Obra Social</a>

