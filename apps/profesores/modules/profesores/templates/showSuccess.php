<table>
  <tbody>
    <tr>
      <th>Id:</th>
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
      <th>Tipo Doc.:</th>
      <td><?php echo $personas->getIdtipodoc() ?></td>
    </tr>
    <tr>
      <th>Nro Doc:</th>
      <td><?php echo $personas->getNrodoc() ?></td>
    </tr>
    <tr>
      <th>Numerodoc:</th>
      <td><?php echo $personas->getNumerodoc() ?></td>
    </tr>
    <tr>
      <th>Fecha Nac:</th>
      <td><?php echo $personas->getFechanac() ?></td>
    </tr>
    <tr>
      <th>Fecha Ing.:</th>
      <td><?php echo $personas->getFechaingreso() ?></td>
    </tr>
    <tr>
      <th>Ciudad Nac.:</th>
      <td><?php echo $personas->getIdciudadnac() ?></td>
    </tr>
    <tr>
      <th>Nacionalidad:</th>
      <td><?php echo $personas->getIdnacionalidad() ?></td>
    </tr>
    <tr>
      <th>Estado Civil:</th>
      <td><?php echo $personas->getEstadocivil() ?></td>
    </tr>
    <tr>
      <th>Vive:</th>
      <td><?php echo $personas->getVive() ?></td>
    </tr>
    <tr>
      <th>Profesion:</th>
      <td><?php echo $personas->getIdprofesion() ?></td>
    </tr>
    <tr>
      <th>Cant. Grupo Familiar:</th>
      <td><?php echo $personas->getCantgrupofamiliar() ?></td>
    </tr>
    <tr>
      <th>Titulo:</th>
      <td><?php echo $personas->getTitulo() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('profesores/edit?idpersona='.$personas->getIdpersona()) ?>">Editar</a>
&nbsp;
<a href="<?php echo url_for('profesores/index') ?>">Volver al listado</a>
<br><br>
