<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Origen</td>
      <td class="hed" align="center">Destino</td>
      <td class="hed" align="center">Obs.</td>
      <td class="hed" align="center">Leido?</td>
      <td class="hed" align="center">Fecha</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($derivacioness as $derivaciones): ?>
    <tr>
      <td align="center"><?php echo $derivaciones->getIdderivacion() ?></td>
      <td><?php $oAreaOrigen = Doctrine_Core::getTable('Areas')->find($derivaciones->getIdareaorigen()); ?>
      <?php echo $oAreaOrigen->getDescripcion() ?></td>
      <td><?php $oAreaDestino = Doctrine_Core::getTable('Areas')->find($derivaciones->getIdareadestino()); ?>
      <?php echo $oAreaDestino->getDescripcion() ?></td>     
      <td><?php echo $derivaciones->getObservaciones() ?></td>
      <td align="center">
      	<?php $arregloSiNo = array(0 => 'No', 1 =>'Si'); ?>	
		<?php echo $arregloSiNo[$derivaciones->getLeido()] ?>
	  </td>      
	  <td align="center"><?php echo date("d-m-Y", strtotime($derivaciones->getCreatedAt())); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
