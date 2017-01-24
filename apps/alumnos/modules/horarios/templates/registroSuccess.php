 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
<?php if( $msgError <> "" ) { ?>
<div align="center"><p style="font-size:18px;font-weight:bold;color:red"><b> <?php echo $msgError ?> </b></p></div>
<?php } ?>
<?php if( $msgSuccess <> "" ) { ?>
<div align="center"><p style="font-size:18px;font-weight:bold;color:green"><b> <?php echo $msgSuccess ?> </b></p></div>  
<?php } ?>
<div id="boton" align='center'>
 <a href="<?php echo url_for('horarios/entrada#ver') ?>"><img style="width:220px;height=220px"src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/entrada.png' size='30' /></a>
 <a href="<?php echo url_for('horarios/salida#ver') ?>"><img style="width:220px;height=220px"src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/salida.png' size='30' /></a>
</div>

<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="40%" align="center" class="hed">Persona</td>
        <td width="10%" align="center" class="hed">Tipo</td>
        <td width="18%" align="center" class="hed">Fecha/Hora</td>
        <td width="25%" align="center" class="hed">Observac.</td>
        <td width="7%" align="center" class="hed">X</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($horarioss as $horarios){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td style="height:30px;width='40%'" align="left"><a href="#" title="<?php echo $horarios->getPersonas()->getHorarios() ?>"> <?php echo $horarios->getPersonas()->getApellido().', '.$horarios->getPersonas()->getNombre() ?> </a></td>
        <td style="height:30px;width='10%'" align="left"><?php echo $horarios->getTiporegistro()==1 ? 'ENTRADA' : 'SALIDA' ?></td>
        <td style="height:30px;width='18%'" align="left"><?php echo date('d-m-Y H:i:s', strtotime($horarios->getCreatedAt())) ?></td>
        <td style="height:30px;width='25%'" align="center">
            <form action="<?php echo url_for('horarios/agregarobservacion?id='.$horarios->getId()) ?>" method="post"> 
              <input type="hidden" value="<?php echo $horarios->getId(); ?>" name="idpersona" />
              <input type="submit" style="height:30px; width:130px" class="botonEditar" value="Observaciones" title="Observaciones" >
            </form>           
        </td>
       <td style="height:30px;width='7%'" align="center">
        <?php 
          if (trim($horarios->getObservaciones())<>''){ ?>
            <img width="17px" height="17px" src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/accept_ico.png' align='center' size='20' />
          <?php } else { ?>
             <?php echo " - "; ?>
          <?php } ?> 
        </td>
        </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>

<?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
  <a href="<?php echo url_for('horarios/new') ?>">Nuevo registro</a>
<?php } ?>  
