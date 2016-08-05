<h1>Impresión de Acta Volante</h1> 

<?php include_partial('formActaVolante', array('form' => $form, 'mensaje' => $mensaje)) ?>

<?php if($catedra) { ?>
<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td class="hed">Materia: <?php echo $catedra->getMateriasPlanes(); ?></td>
  </tr>
  <tr>
    <td>Mesa de exámenes:</td>
  </tr>
  <tr>
    <td align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center">Id</td>
		      <td class="hed" align="center">Fecha</td>
		      <td class="hed" align="center">Hora</td>
		      <td class="hed" align="center">Condición</td>
		      <td class="hed" align="center">Libro</td>
		      <td class="hed" align="center">Folio</td>
		      <td class="hed" align="center">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($mesas) > 0){ ?>
		    <?php foreach ($mesas as $mesa): ?>
		    <tr>
		      <td align="center"><?php echo $mesa->getIdmesaexamen(); ?></td>
		      <td align="center"><?php echo $mesa->getFecha(); ?></td>
		      <td align="center"><?php echo $mesa->getHora(); ?></td>
		      <td align="center"><?php echo $mesa->getCondicionesMesas(); ?></td>
		      <td align="center"><?php echo $mesa->getLibrosActas(); ?></td>
		      <td align="center"><?php echo $mesa->getFolio(); ?></td>
		      <td align="center">
		      <?php if(count($mesa->obtenerInscriptos()) > 0) { ?>
				<form name="form" method="post" action="<?php echo url_for('impresiones/imprimiractavolante') ?>">  
					<input type="hidden" name="idmesaexamen" value="<?php echo $mesa->getIdmesaexamen(); ?>">
					<input type="submit" value="Imprimir" title="Imprimir" id="Imprimir">
				</form>		
			  <?php } else { ?>
			  No hay inscriptos.      
			  <?php } ?>
		      </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php } else {?>
		    <tr>
		      <td colspan="6" align="center">No hay mesas de exámenes para dicha asignatura.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
<?php } ?>
