 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<div id="boton" align='center'>
 <a target="_blank" href="<?php echo url_for('informes/profesionalespdf') ?>"><img style="width:200px;height=200px"src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/registrarme.jpeg' size='20' /></a>
</div>
<br>
<p align="left" style="color:black;">Ultimos Ingresos/Egresos Registrados</h1>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="5%" align="center" class="hed">Matrícula</td>
        <td width="50%" align="center" class="hed">Persona</td>
        <td width="10%" align="center" class="hed">Tipo</td>
        <td width="25%" align="center" class="hed">Fecha/Hora</td>
        <td width="10%" align="center" class="hed">Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($horarioss as $horarios){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="5%" align="left"><?php echo $horarios->getPersonas()->getNrolector() ?></td>
        <td width="50%" align="left"><a href="#" title="<?php echo $horarios->getPersonas()->getHorarios() ?>"> <?php echo $horarios->getPersonas()->getApellido().', '.$horarios->getPersonas()->getNombre() ?> </a></td>
        <td width="10%" align="left"><?php echo $horarios->getTiporegistro() ?></td>
        <td width="25%" align="left"><?php echo $horarios->getCreatedAt() ?></td>
        <td width="10%" align="left"><a href="<?php echo url_for('horarios/show?id='.$horarios->getId()) ?>"><?php echo 'Mostrar' ?></a></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>

  <a href="<?php echo url_for('horarios/new') ?>">Nuevo registro</a>
