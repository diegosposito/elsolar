<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $documentacion_planes_estudios->getId() ?></td>
    </tr>
    <tr>
      <th>Iddocumentacion:</th>
      <td><?php echo $documentacion_planes_estudios->getIddocumentacion() ?></td>
    </tr>
    <tr>
      <th>Idplanestudio:</th>
      <td><?php echo $documentacion_planes_estudios->getIdplanestudio() ?></td>
    </tr>
    <tr>
      <th>Activo:</th>
      <td><?php echo $documentacion_planes_estudios->getActivo() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $documentacion_planes_estudios->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $documentacion_planes_estudios->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $documentacion_planes_estudios->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $documentacion_planes_estudios->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('documentacionplanes/edit?id='.$documentacion_planes_estudios->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('documentacionplanes/index') ?>">List</a>
