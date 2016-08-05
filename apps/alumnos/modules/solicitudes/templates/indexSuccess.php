<h1>Solicitudes Alumnos</h1>

<table width="100%" class="stats" cellspacing="0">
	<tr>
	  <td colspan="5" align="center">
	  	<?php if ($resuelta==1){ ?>
		<input type="submit" value="Ver No Resueltas" onclick="location.href='<?php echo url_for('solicitudes/index?resuelta=0') ?>'">
		<?php } else { ?>
		<input type="submit" value="Ver Resueltas" onclick="location.href='<?php echo url_for('solicitudes/index?resuelta=1') ?>'">			
		<?php } ?>		
	  </td>
	</tr>
    <tr>
      <td class="hed" align="center" width="40%">Solicitud</td>
      <td class="hed" align="center" width="20%">Respuesta</td>
      <td class="hed" align="center" width="15%">Resuelta</td>
      <td class="hed" align="center" width="15%">Actualizada</td>
      <td class="hed" width="10%"></td>
    </tr>
    <?php if (count($solicitudess) > 0) { ?>
		<?php foreach ($solicitudess as $solicitudes): 
         $alumno = new Alumnos();
         $usuario=$alumno->obtenerDatosUsuario($solicitudes->getIdUsuario());
        // $oAlumno = Doctrine::getTable('Alumnos')->find($request->getParameter('idalumno')); 
        
		?>
		
		<tr>
	      <td width="250px" colspan="3" ><?php echo "Alumno:".$usuario[0].'-'.$solicitudes->getIdusuario(); 

		$oUsuario = Doctrine::getTable('sfGuardUser')->find($solicitudes->getIdusuario()); 
		echo ' DNI: '.$oUsuario->getProfile()->getNrodoc();
		$oPersona = Doctrine::getTable('Personas')->findByNrodoc($oUsuario->getProfile()->getNrodoc());
		foreach($oPersona as $persona) {
			$idpersona= $persona->getIdpersona();
		}
		$oAlumno = Doctrine::getTable('Alumnos')->buscarAlumno($idpersona, $solicitudes->getIdcarrera());

		echo " ida: ".$oAlumno->getIdalumno();
		$fechalibredeuda='';
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($oAlumno->getIdalumno(),$oUsuario->getProfile()->getNrodoc()); 
		echo " LD: ".$fechalibredeuda;

		?></td>
	      <td width="250px" colspan="2" ><?php echo "Carrera:". $solicitudes->getIdcarrera().'-'.Doctrine_Core::getTable('Carreras')->find($solicitudes->getIdcarrera()); ?></td>
		</tr>		
		
		<tr <?php if(($fechalibredeuda>date()) and (checkdate($fechalibredeuda))) echo 'bgcolor="#22BBEA"'; else echo 'bgcolor="#FFCC66"'; ?>>
	      <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getDescripcion()),0, 250)."..." ?></td>
	      <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getRespuesta()),0, 50)."..." ?></td>
	      <td width="30px" align="center"><?php echo ( $solicitudes->getResuelta() == 1 ) ? 'Si' : 'No'; ?></td>
	      <td width="30px" align="center"><?php echo $solicitudes->getUpdatedAt() ?></td>
	      <td width="30px" align="center">
			<input type="button" value="Editar" onclick="location.href='<?php echo url_for('solicitudes/edit?id='.$solicitudes->getId()) ?>'">
	      </td>
		</tr>
		<?php endforeach; ?>
	<?php } else { ?>
		<tr>
	      <td colspan="5" align="center">No existen solicitudes.</td>
		</tr>	
	<?php } ?>
</table> 
