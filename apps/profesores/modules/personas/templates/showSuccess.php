<br>
<h1>Mostrar informacion de persona seleccionada</h1>
<br>
<table align="center">
  <tbody>
    <tr>
      <th>Identificador:</th>
      <td><?php echo $personas->getIdpersona() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $personas->getNombre() ?></td>
    </tr>
    <tr>
      <th>Apellido:</th>
      <td><?php echo $personas->getApellido() ?></td>
    </tr>
    <tr>
      <th>Sexo:</th>
      <td><?php echo $personas->getSexo() ?></td>
    </tr>
    <tr>
      <th>Tipo Documento:</th>
      <td><?php echo $personas->getIdtipodoc() ?></td>
    </tr>
    <tr>
      <th>Nro. Doc:</th>
      <td><?php echo $personas->getNrodoc() ?></td>
    </tr>
    <tr>
      <th>Numero Doc:</th>
      <td><?php echo $personas->getNumerodoc() ?></td>
    </tr>
    <tr>
      <th>Fecha nacimiento:</th>
      <td><?php echo $personas->getFechanac() ?></td>
    </tr>
    <tr>
      <th>Fecha ingreso:</th>
      <td><?php echo $personas->getFechaingreso() ?></td>
    </tr>
    <tr>
      <th>Ciudad nacimiento:</th>
      <td><?php echo $personas->getIdciudadnac() ?></td>
    </tr>
    <tr>
      <th>Nacionalidad:</th>
      <td><?php echo $personas->getIdnacionalidad() ?></td>
    </tr>
    <tr>
      <th>Estado civil:</th>
      <td><?php echo $personas->getEstadocivil() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $personas->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $personas->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $personas->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $personas->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('personas/edit?idpersona='.$personas->getIdpersona()) ?>">Editar</a>
&nbsp;
<a href="<?php echo url_for('personas/index') ?>">Listar todos</a>
