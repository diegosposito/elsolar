<h1>Detalle de datos Personales</h1>
<table>
  <tbody>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $personas->getApellido().','.$personas->getNombre() ?></td>
    </tr>
    <tr>
      <th>Documento:</th>
      <td><?php echo $personas->getNrodoc() ?></td>
    </tr>
     <tr>
      <th>Fecha Nac.:</th>
      <td><?php echo $personas->getFechanac() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $personas->getEmail() ?></td>
    </tr>
    <tr>
      <th>Teléfono:</th>
      <td><?php echo $personas->getTelefono() ?></td>
    </tr>
    <tr>
      <th>Celular:</th>
      <td><?php echo $personas->getCelular() ?></td>
    </tr>
    <tr>
      <th>Ciudad:</th>
      <td><?php echo $personas->getCiudad() ?></td>
    </tr>
    <tr>
      <th>Dirección:</th>
      <td><?php echo $personas->getDireccion() ?></td>
    </tr>
    <tr>
      <th>Horarios:</th>
      <td><?php echo htmlentities($personas->getHorarios()) ?></td>
    </tr>
   
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('personas/buscar') ?>">Volver al listado</a>
