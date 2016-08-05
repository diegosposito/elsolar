<h1>Bajas</h1>

<div align="center">
<table width="95%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed" align="center" width="3%">Id</td>
	  <td class="hed" align="center" width="25%">Alumno</td>
	  <td class="hed" align="center">Sede</td>
	  <td class="hed" align="center">Carrera</td>
      <td class="hed" align="center" width="10%">Fecha de informe</td>
      <td class="hed" align="center" width="10%">Fecha efectiva de baja</td>
      <td class="hed" align="center" width="10%">Fecha de registro</td>
      <td class="hed" align="center">Tipo de solicitud</td>
      <td class="hed" align="center">Tipo de baja</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($bajas_alumnoss as $bajas_alumnos): ?>
    <tr>
      <td align="center"><?php echo $bajas_alumnos->getIdbaja() ?></td>
		<td><?php echo $bajas_alumnos->getAlumnos()->getPersonas() ?></td>
		<td align="center"><?php echo $bajas_alumnos->getAlumnos()->getSedes() ?></td>
		<td align="center"><?php echo $bajas_alumnos->getAlumnos()->getPlanesEstudios()->getCarreras(); ?></td>
      <td align="center">
      	<?php 
		$arr = explode('-', $bajas_alumnos->getFecha());
		$fechainforme = $arr[2]."-".$arr[1]."-".$arr[0]; 
		?>			
	    <?php echo $fechainforme; ?>
      </td>

      <td align="center">
      	<?php 
		$arr1 = explode('-', $bajas_alumnos->getFechabaja());
		$fechaefectiva = $arr1[2]."-".$arr1[1]."-".$arr1[0]; 
		?>			
	    <?php echo $fechaefectiva; ?>
      </td>    
      <td align="center">
      	<?php 
		$arr2 = explode('-', substr($bajas_alumnos->getCreatedAt(),0,10));
		$fecharegistro = $arr2[2]."-".$arr2[1]."-".$arr2[0]; 
		?>			
	    <?php echo $fecharegistro; ?>
      </td>        
      <td align="center"><?php echo (($bajas_alumnos->getTiposolicitud()=="O")?"Oficio":"Solicitada") ?></td>
      <td align="center"><?php echo (($bajas_alumnos->getTipobaja()=="P")?"Parcial":"Total") ?></td>
      <td>
      <input type="button" value="Ver" onclick="location.href='<?php echo url_for('estadosalumno/verbaja?idbaja='.$bajas_alumnos->getIdbaja()) ?>'">
      <input type="button" value="Imprimir" onclick="location.href='<?php echo url_for('estadosalumno/imprimirbaja?idbaja='.$bajas_alumnos->getIdbaja()) ?>'">
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
