
  <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Lista de Horarios</h1>
<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
<a href="<?php echo url_for('listahorarios/new') ?>">Nueva lista de Horarios</a>
<table width=80% cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="40%" align="center" class="hed">Detalle</td>
         <td width="20%" align="center" class="hed">Estado</td>
        <td colspan=2 width="40% width="10%" align="center" class="hed">Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($lista_horarioss as $lista_horarios){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="40%" align="center"><?php echo $lista_horarios->getDescripcion() ?></td>
        <?php $estado = ($lista_horarios->getActiva()==1) ? 'Activa' : 'No Activa'; ?>
        <td width="20%"><?php echo $estado ?></td>
        <td align="center"><?php echo link_to("Editar", 'listahorarios/edit?id='.$lista_horarios->getId() ,'class="mhead"'); ?></td>
        <td align="center"><?php echo link_to("Ver detalle", 'detallehorarios/index?id='.$lista_horarios->getId() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>


 



