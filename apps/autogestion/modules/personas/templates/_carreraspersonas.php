<div align="center">
<form action="<?php echo url_for('personas/carreraspersonas') ?>" method="post">
  <table cellspacing="0" class="stats" width="70%">
    <?php echo $form ?>
	<tr>
		<td colspan="2" align="center"><input type="submit" value="Aceptar" /></td>
    </tr>    
  </table>
</form>

<br>
<?php if (count($resultado) > 0){ ?>		    	   	
	<table cellspacing="0" class="stats">
	    <tr>
	      <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> registros de la búsqueda.</td>
	    </tr>
	    <tr>
	      <td width="10%" align="center" class="hed">Id</td>
	      <td width="60%" align="center" class="hed">Asignatura</td>
	      <td width="10%" align="center" class="hed">Estado</td>
	      <td width="10%" align="center" class="hed">Fecha</td>
	      <td width="10%" align="center" class="hed">Vencimiento</td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="5%"><?php echo $item->getComisiones()->getIdcatedra() ?></td>
	      <td width="50%"><?php echo $item->getComisiones()->getCatedras()->getMateriasPlanes() ?></td>
	      <td width="5%"><?php //echo $item->getEstadosMateria(); ?></td>
	      <td width="30%"><?php //echo $item->getPersonas()->getTiposDocumentos()." ".$item->getPersonas()->getNrodoc() ?></td>
	      <td width="10%"></td>
	    </tr> 
	    <?php } ?>
	  </tbody>
	</table>
<?php } ?>
	<?php if ($_POST) { ?>
		<?php if($activo){ ?>
			<table cellspacing="0" class="stats">
			    <tr>
			        <td class="hed" align="center">
					<form name="form" method="post" action="<?php echo url_for($form->getValue('url')) ?>">  
						<input type="hidden" id="idalumno" name="idalumno" value="<?php echo $form->getValue('carrera'); ?>">
						<input type="submit" value="Ver Inscripciones" title="Ver Inscripciones">
					</form>
					</td>	    
			    </tr>	
		    </table>
		<?php } else { ?>
			<table cellspacing="0" class="stats">
			    <tr><td>
				Para poder realizar inscripciones en materias debe <b>inscribirse previamente al ciclo lectivo</b>.   
			    </td></tr>	
		    </table>
		<?php } ?>
	<?php } ?> 	
</div>
