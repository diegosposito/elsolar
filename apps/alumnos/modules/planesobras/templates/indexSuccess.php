 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Planes de Obras Sociales</h1>
<br>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
<a href="<?php echo url_for('planesobras/new') ?>">Nuevo Plan de Obra Social</a>
  

<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="70%" align="center" class="hed">Obra Social</td>
        <td width="20%" align="center" class="hed">Plan</td>
        <td width="20%" align="center" class="hed">Activa</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($planes_obrass as $planes_obras){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="70%"><?php echo  $planes_obras->getObrasSociales()->getAbreviada() ?></td>
        <td width="20%" align="center"><?php echo $planes_obras->getNombre() ?></td>
        <td width="20%" align="center"><?php echo $planes_obras->getActivo() ? 'Si' : 'No' ?></td>
        <td align="center"><?php echo link_to("Editar", 'planesobras/edit?id='.$planes_obras->getId() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
