 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Listado de Entidades</h1>
<?php if($sf_user->getGuardUser()->getIsSuperAdmin()){ ?>
         <img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
         <a href="<?php echo url_for('cargoautoridades/new') ?>">Nueva Entidad</a>
  <?php } ?>

 <br>
<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="40%" align="center" class="hed">Entidad</td>
        <td width="10%" align="center" class="hed">Fecha de Creación</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($cargo_autoridadess as $cargo_autoridades){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="40%" align="center"><?php echo $cargo_autoridades->getNombre() ?></td>
        <td width="10%"><?php echo date("d/m/Y", strtotime($cargo_autoridades->getCreatedAt())) ?></td>
        <td align="center"><?php echo link_to("Editar", 'cargoautoridades/edit?idcargoautoridad='.$cargo_autoridades->getIdcargoautoridad() ,'class="mhead"'); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>