  <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Servicios ofrecidos</h1>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
<a href="<?php echo url_for('centros/new') ?>">Nueva Servicio</a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="60%" align="center" class="hed">Servicio</td>
        <td width="20%" align="center" class="hed">Abrev.</td>
        <td width="10%" align="center" class="hed">Estado</td>
        <td width="10%" align="center" class="hed">Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($centross as $centros){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="60%" align="center"><?php echo $centros->getDescripcion() ?></td>
        <td width="20%"><?php echo $centros->getAbreviacion() ?></td>
        <?php $estado = ($centros->getActivo()==1) ? 'Activo' : 'No Activo'; ?>
        <td width="10%"><?php echo $estado ?></td>
        <td align="center"><?php echo link_to("Editar", 'centros/edit?id='.$centros->getId() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>


 


