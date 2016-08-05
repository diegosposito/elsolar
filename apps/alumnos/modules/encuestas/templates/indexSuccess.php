<h1>Encuestas</h1>
<br>
<input type="button" value="Nuevo" onclick="location.href='<?php echo url_for('encuestas/new') ?>'">
<br><br>
<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center" width="2%">Id</td>
      <td class="hed" align="center">Nombre</td>
      <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center" width="12%">Fecha limite</td>
      <td class="hed" align="center">Descripcion</td>
      <td class="hed" align="center" width="10%">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($encuestass as $encuestas): ?>
    <tr>
      <td><?php echo $encuestas->getIdencuesta() ?></td>
      <td><?php echo $encuestas->getNombre() ?></td>
      <td><?php echo $encuestas->getCarreras() ?></td>
      <td align="center">
		<?php 
			$arr = explode('-', $encuestas->getFecha());
			$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
		?>	
      	<?php echo $fecha; ?>
      </td>
      <td><?php echo $encuestas->getDescripcion() ?></td>
	  <td align="center">
	  	<input type="button" value="Editar" onclick="location.href='<?php echo url_for('encuestas/edit?idencuesta='.$encuestas->getIdencuesta()) ?>'">         
	  </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>