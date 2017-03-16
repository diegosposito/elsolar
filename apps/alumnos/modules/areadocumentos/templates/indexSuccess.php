<style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Areas de Documentos</h1>
<br>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
<a href="<?php echo url_for('areadocumentos/new') ?>">Nueva Area de Documentos</a>
  

<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="70%" align="center" class="hed">Area</td>
        <td width="15%" align="center" class="hed">Visible</td>
        <td width="5%" align="center" class="hed">Orden</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($area_documentoss as $area_documentos){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="70%"><?php echo  $area_documentos->getNombre() ?></td>
        <td width="20%" align="center"><?php echo $area_documentos->getVisible() ? 'Si' : 'No'  ?></td>
        <td width="20%" align="center"><?php echo $area_documentos->getorden() ?></td>
        <td align="center"><?php echo link_to("Editar", 'areadocumentos/edit?id='.$area_documentos->getId() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>
