<h1>Materias genericass List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Idmateriaplangenerica</th>
      <th>Idmateriaplan</th>
      <th>Valormateria</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($materias_genericass as $materias_genericas): ?>
    <tr>
      <td><a href="<?php echo url_for('materiasgenericas/edit?id='.$materias_genericas->getId()) ?>"><?php echo $materias_genericas->getId() ?></a></td>
      <td><?php echo $materias_genericas->getIdmateriaplangenerica() ?></td>
      <td><?php echo $materias_genericas->getIdmateriaplan() ?></td>
      <td><?php echo $materias_genericas->getValormateria() ?></td>
      <td><?php echo $materias_genericas->getCreatedAt() ?></td>
      <td><?php echo $materias_genericas->getUpdatedAt() ?></td>
      <td><?php echo $materias_genericas->getCreatedBy() ?></td>
      <td><?php echo $materias_genericas->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('materiasgenericas/new') ?>">New</a>
