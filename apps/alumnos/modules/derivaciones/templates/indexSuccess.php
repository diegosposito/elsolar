<h1>Derivaciones</h1>

<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Nro. Exp.</td>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center">Sede</td>
      <td class="hed" align="center">Origen</td>
      <td class="hed" align="center">Destino</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  <?php if (count($expedientes_derivacioness) > 0) { ?>
    <?php foreach ($expedientes_derivacioness as $derivacion) { 
    		$oExpediente = Doctrine_Core::getTable('ExpedientesEgresados')->find($derivacion['idexpediente']);
    ?>
    <tr>
      <td align="center"><?php echo $derivacion['idderivacion'] ?></td>
      <td align="center"><?php echo $derivacion['idexpediente'] ?></td>
      <td><?php echo $oExpediente->getAlumnos()->getPersonas() ?></td>
      <td align="center"><?php echo $oExpediente->getSedes()->getAbreviacion() ?></td>
      <td><?php $oAreaOrigen = Doctrine_Core::getTable('Areas')->find($derivacion['idareaorigen']); ?>
      <?php echo $oAreaOrigen->getDescripcion() ?></td>
      <td><?php $oAreaDestino = Doctrine_Core::getTable('Areas')->find($derivacion['idareadestino']); ?>
      <?php echo $oAreaDestino->getDescripcion() ?></td>     
      <td align="center">
      <form action="" id="formResponder" >
     		<input type="button" value="Responder" onclick="location.href='<?php echo url_for('derivaciones/responder?idderivacion='.$derivacion['idderivacion']) ?>'">
      </form>
      </td> 
    </tr>
    <?php } ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen expedientes.</td>
		</tr>	
	<?php } ?>         
  </tbody>
</table>