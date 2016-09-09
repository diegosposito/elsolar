 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Autoridades</h1>
<?php if($sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
         <img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
         <a href="<?php echo url_for('autoridades/new') ?>">Nueva Autoridad</a>
  <?php } ?>

 <br>
 <a href="<?php echo url_for('informes/obrassocialespdf') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="70%" align="center" class="hed">Autoridad</td>
        <td width="20%" align="center" class="hed">Fecha Creación</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($autoridadess as $autoridades){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="70%" align="center"><?php echo $autoridades->getNombre() ?></td>
        <td width="20%"><?php echo date("d/m/Y", strtotime($autoridades->getCreatedAt())) ?></td>
        <td align="center"><?php echo link_to("Editar", 'autoridades/edit?idautoridad='.$autoridades->getIdautoridad() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>