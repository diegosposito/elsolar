 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
<div align="center"><p style="font-size:18px;font-weight:bold;color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="center"><p style="font-size:18px;font-weight:bold;color:green"><b> <?php echo $msgSuccess ?> </b></p></div>  
<br/>
<div id="boton" align='center'>
 <a href="<?php echo url_for('horarios/entrada#ver') ?>"><img style="width:250px;height=250px"src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/entrada.png' size='30' /></a>
 <a href="<?php echo url_for('horarios/salida#ver') ?>"><img style="width:250px;height=250px"src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/salida.png' size='30' /></a>
</div>

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
        <td width="10%" align="left"><?php echo $horarios->getTiporegistro()==1 ? 'ENTRADA' : 'SALIDA' ?></td>
        <td width="25%" align="left"><?php echo date('d-m-Y H:i:s', strtotime($horarios->getCreatedAt())) ?></td>
        <?php if ($sf_user->isAuthenticated() && $sf_user->hasCredential('administracion')){ ?>
                <td width="10%" align="left"><a href="<?php echo url_for('horarios/show?id='.$horarios->getId()) ?>"><?php echo 'Mostrar' ?></a></td>
        <?php } else { ?>
                <td width="10%" align="left"><?php echo ' - ' ?></a></td>
        <?php } ?>                
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>

<?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
  <a href="<?php echo url_for('horarios/new') ?>">Nuevo registro</a>
<?php } ?>  
