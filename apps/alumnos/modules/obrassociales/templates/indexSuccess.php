<h1>Listado de Obras sociales</h1>

<table cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="5%" align="center" class="hed">Obra Social</td>
        <td width="50%" align="center" class="hed">Abreviada</td>
        <td width="40%" align="center" class="hed">Estado</td>
        <td width="10%" align="center" class="hed">Fecha Arancel</td>
        <td width="10%" align="center" class="hed">Fecha Ult Periodo</td>
        <td width="10%" align="center" class="hed">Edicion</td>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
      <?php foreach ($obras_socialess as $obras_sociales){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="5%" align="center"><?php echo $obras_sociales->getDenominacion() ?></td>
        <td width="50%"><?php echo $obras_sociales->getAbreviada() ?></td>
        <?php $estado = ($obras_sociales->getEstado()==1) ? 'Habilitada' : 'No Habilitada'; ?>
        <td width="40%"><?php echo $estado ?></td>
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

