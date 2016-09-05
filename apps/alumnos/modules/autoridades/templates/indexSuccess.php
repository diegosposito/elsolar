<h1>Listado de Autoridades</h1>

<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Idcargoautoridad</th>
      <th>Fecha Alta</th>
      <th>Fecha Ult. Modificación</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($autoridadess as $autoridades): ?>
    <tr>
      <td><a href="<?php echo url_for('autoridades/show?idautoridad='.$autoridades->getIdautoridad()) ?>"><?php echo $autoridades->getNombre() ?></a></td>
      <td><?php echo $autoridades->getIdcargoautoridad() ?></td>
      <td><?php echo $autoridades->getCreatedAt() ?></td>
      <td><?php echo $autoridades->getUpdatedAt() ?></td>
     
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('autoridades/new') ?>">Nueva Autoridad</a>
