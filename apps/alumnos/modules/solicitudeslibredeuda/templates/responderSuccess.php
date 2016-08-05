<h1>Responder Solicitud de libredeuda</h1>

<table cellspacing="0" class="stats" width="100%">
      <tr>
        <td width="25%"><b>Solicitud:</b></td>
        <td><?php echo $solicitud->getId() ?></td>        
      </tr>
      <tr>
        <td><b>Origen:</b></td>
        <td>
            <?php $oUsuarioOrigen = Doctrine_Core::getTable('sfGuardUser')->find($solicitud->getIdusuarioorigen()); ?>
      		<?php echo $oUsuarioOrigen->getUsername() ?></td>
		</td>        
      </tr>  
      <tr>
        <td><b>Destino:</b></td>
        <td>
            <?php $oUsuarioDestino = Doctrine_Core::getTable('sfGuardUser')->find($solicitud->getIdusuariodestino()); ?>
      		<?php echo $oUsuarioDestino->getUsername() ?></td>
		</td>        
      </tr>          
      <tr>
        <td><b>Alumno:</b></td>
        <td><?php echo $solicitud->getAlumnos()->getPersonas() ?></td>        
      </tr>      
	  <tr>
        <td><b>Sede:</b></td>
        <td><?php echo $solicitud->getAlumnos()->getSedes() ?></td>        
      </tr>
	  <tr>
        <td><b>Estado:</b></td>
        <td><?php echo $solicitud->getEstadosSolicitudes() ?></td>        
      </tr>   
	  <tr>
        <td><b>Mensaje:</b></td>
        <td><?php echo $solicitud->getMensaje() ?></td>        
      </tr>       
</table>
<br>
<?php include_partial('form', array('form' => $form)) ?>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('solicitudeslibredeuda/index') ?>'"></p>
<br>