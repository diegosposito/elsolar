<h1>Tipos documentoss List</h1>

<table>
  <thead>
    <tr>
      <th>Idtipodoc</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tipos_documentoss as $tipos_documentos): ?>
    <tr>
      <td><a href="<?php echo url_for('tiposdocumentos/edit?idtipodoc='.$tipos_documentos->getIdtipodoc()) ?>"><?php echo $tipos_documentos->getIdtipodoc() ?></a></td>
      <td><?php echo $tipos_documentos->getDescripcion() ?></td>
      <td><?php echo $tipos_documentos->getCreatedAt() ?></td>
      <td><?php echo $tipos_documentos->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tiposdocumentos/new') ?>">New</a>
