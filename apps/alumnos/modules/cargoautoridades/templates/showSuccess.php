<table>
  <tbody>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $cargo_autoridades->getNombre() ?></td>
    </tr>
    <tr>
      <th>Fecha Creación:</th>
      <td><?php echo $cargo_autoridades->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('cargoautoridades/edit?idcargoautoridad='.$cargo_autoridades->getIdcargoautoridad()) ?>">Editar</a>
&nbsp;
<a href="<?php echo url_for('cargoautoridades/index') ?>">Volver al listado</a>
