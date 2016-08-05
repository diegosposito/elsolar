<h1>Personass List</h1>

<table>
  <thead>
    <tr>
      <th>Idpersona</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Sexo</th>
      <th>Idtipodoc</th>
      <th>Nrodoc</th>
      <th>Fechanac</th>
      <th>Fechaingreso</th>
      <th>Idciudadnac</th>
      <th>Idnacionalidad</th>
      <th>Estadocivil</th>
      <th>Vive</th>
      <th>Idprofesion</th>
      <th>Cantgrupofamiliar</th>
      <th>Titulo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($personass as $personas): ?>
    <tr>
      <td><a href="<?php echo url_for('personas/edit?idpersona='.$personas->getIdpersona()) ?>"><?php echo $personas->getIdpersona() ?></a></td>
      <td><?php echo $personas->getNombre() ?></td>
      <td><?php echo $personas->getApellido() ?></td>
      <td><?php echo $personas->getSexo() ?></td>
      <td><?php echo $personas->getIdtipodoc() ?></td>
      <td><?php echo $personas->getNrodoc() ?></td>
      <td><?php echo $personas->getFechanac() ?></td>
      <td><?php echo $personas->getFechaingreso() ?></td>
      <td><?php echo $personas->getIdciudadnac() ?></td>
      <td><?php echo $personas->getIdnacionalidad() ?></td>
      <td><?php echo $personas->getEstadocivil() ?></td>
      <td><?php echo $personas->getVive() ?></td>
      <td><?php echo $personas->getIdprofesion() ?></td>
      <td><?php echo $personas->getCantgrupofamiliar() ?></td>
      <td><?php echo $personas->getTitulo() ?></td>
      <td><?php echo $personas->getCreatedAt() ?></td>
      <td><?php echo $personas->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('personas/new') ?>">New</a>
