<table cellspacing="0" class="stats" width="100%">
  <tbody>
    <tr>
      <td width="15%"><b>Id:</b></td>
      <td><?php echo $solicitudes_libredeuda->getId() ?></td>
    </tr>
    <tr>
      <td><b>Origen:</b></td>
      <td>
      	<?php $oUsuarioOrigen = Doctrine_Core::getTable('sfGuardUser')->find($solicitudes_libredeuda->getIdusuarioorigen()); ?>
		<?php echo $oUsuarioOrigen->getUsername() ?>
      </td>
    </tr>
    <tr>
      <td><b>Destino:</b></td>
      <td>
      	<?php $oUsuarioDestino = Doctrine_Core::getTable('sfGuardUser')->find($solicitudes_libredeuda->getIdusuariodestino()); ?>
      	<?php echo $oUsuarioDestino->getUsername() ?>
      </td>
    </tr>
    <tr>
      <td><b>Alumno:</b></td>
      <td><?php echo $solicitudes_libredeuda->getAlumnos()->getPersonas() ?></td>
    </tr>
    <tr>
      <td><b>Sede:</b></td>
      <td><?php echo $solicitudes_libredeuda->getAlumnos()->getSedes() ?></td>
    </tr>    
    <tr>
      <td><b>Estado:</b></td>
      <td><?php echo $solicitudes_libredeuda->getEstadosSolicitudes() ?></td>
    </tr>
    <tr>
      <td><b>Mensaje:</b></td>
      <td><?php echo $solicitudes_libredeuda->getMensaje() ?></td>
    </tr>
    <tr>
      <td><b>Observaciones:</b></td>
      <td><?php echo $solicitudes_libredeuda->getObservaciones() ?></td>
    </tr>
  </tbody>
</table>

<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('solicitudeslibredeuda/index') ?>'"></p>
<br>	