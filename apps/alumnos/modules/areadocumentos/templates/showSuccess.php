<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $area_documentos->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $area_documentos->getNombre() ?></td>
    </tr>
    <tr>
      <th>Orden:</th>
      <td><?php echo $area_documentos->getOrden() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $area_documentos->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $area_documentos->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $area_documentos->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $area_documentos->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('areadocumentos/edit?id='.$area_documentos->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('areadocumentos/index') ?>">List</a>
