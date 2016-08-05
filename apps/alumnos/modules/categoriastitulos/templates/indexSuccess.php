<h1>Categorias tituloss List</h1>

<table>
  <thead>
    <tr>
      <th>Idcategoriatitulo</th>
      <th>Descripcion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorias_tituloss as $categorias_titulos): ?>
    <tr>
      <td><a href="<?php echo url_for('categoriastitulos/edit?idcategoriatitulo='.$categorias_titulos->getIdcategoriatitulo()) ?>"><?php echo $categorias_titulos->getIdcategoriatitulo() ?></a></td>
      <td><?php echo $categorias_titulos->getDescripcion() ?></td>
      <td><?php echo $categorias_titulos->getCreatedAt() ?></td>
      <td><?php echo $categorias_titulos->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('categoriastitulos/new') ?>">New</a>
