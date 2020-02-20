<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $paciente->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $paciente->getNombre() ?></td>
    </tr>
    <tr>
      <th>Apellido:</th>
      <td><?php echo $paciente->getApellido() ?></td>
    </tr>
    <tr>
      <th>Idsexo:</th>
      <td><?php echo $paciente->getIdsexo() ?></td>
    </tr>
    <tr>
      <th>Nrodoc:</th>
      <td><?php echo $paciente->getNrodoc() ?></td>
    </tr>
    <tr>
      <th>Fechanac:</th>
      <td><?php echo $paciente->getFechanac() ?></td>
    </tr>
    <tr>
      <th>Fechaingreso:</th>
      <td><?php echo $paciente->getFechaingreso() ?></td>
    </tr>
    <tr>
      <th>Idciudadnac:</th>
      <td><?php echo $paciente->getIdciudadnac() ?></td>
    </tr>
    <tr>
      <th>Estadocivil:</th>
      <td><?php echo $paciente->getEstadocivil() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $paciente->getEmail() ?></td>
    </tr>
    <tr>
      <th>Celular:</th>
      <td><?php echo $paciente->getCelular() ?></td>
    </tr>
    <tr>
      <th>Telefono:</th>
      <td><?php echo $paciente->getTelefono() ?></td>
    </tr>
    <tr>
      <th>Direccion:</th>
      <td><?php echo $paciente->getDireccion() ?></td>
    </tr>
    <tr>
      <th>Titular:</th>
      <td><?php echo $paciente->getTitular() ?></td>
    </tr>
    <tr>
      <th>Parentesco:</th>
      <td><?php echo $paciente->getParentesco() ?></td>
    </tr>
    <tr>
      <th>Ocupacion:</th>
      <td><?php echo $paciente->getOcupacion() ?></td>
    </tr>
    <tr>
      <th>Siglas:</th>
      <td><?php echo $paciente->getSiglas() ?></td>
    </tr>
    <tr>
      <th>Plan:</th>
      <td><?php echo $paciente->getPlan() ?></td>
    </tr>
    <tr>
      <th>Trabajo:</th>
      <td><?php echo $paciente->getTrabajo() ?></td>
    </tr>
    <tr>
      <th>Jerarquia:</th>
      <td><?php echo $paciente->getJerarquia() ?></td>
    </tr>
    <tr>
      <th>Credencial:</th>
      <td><?php echo $paciente->getCredencial() ?></td>
    </tr>
    <tr>
      <th>Anotaciones:</th>
      <td><?php echo $paciente->getAnotaciones() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $paciente->getActivo() ?></td>
    </tr>
    <tr>
      <th>Nroafiliado:</th>
      <td><?php echo $paciente->getNroafiliado() ?></td>
    </tr>
    <tr>
      <th>Historial:</th>
      <td><?php echo $paciente->getHistorial() ?></td>
    </tr>
    <tr>
      <th>Imagefile:</th>
      <td><?php echo $paciente->getImagefile() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $paciente->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $paciente->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $paciente->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $paciente->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('paciente/edit?id='.$paciente->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('paciente/index') ?>">List</a>
