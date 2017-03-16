<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $documentos_institucion->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $documentos_institucion->getNombre() ?></td>
    </tr>
    <tr>
      <th>Visible:</th>
      <td><?php echo $documentos_institucion->getVisible() ?></td>
    </tr>
    <tr>
      <th>Idorden:</th>
      <td><?php echo $documentos_institucion->getIdorden() ?></td>
    </tr>
    <tr>
      <th>Idareadocumento:</th>
      <td><?php echo $documentos_institucion->getIdareadocumento() ?></td>
    </tr>
    <tr>
      <th>Imagefile:</th>
      <td><?php echo $documentos_institucion->getImagefile() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $documentos_institucion->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $documentos_institucion->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $documentos_institucion->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $documentos_institucion->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('documentosinstitucion/edit?id='.$documentos_institucion->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('documentosinstitucion/index') ?>">List</a>
