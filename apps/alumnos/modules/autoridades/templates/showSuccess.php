<table>
  <tbody>
    <tr>
      <th>Idautoridad:</th>
      <td><?php echo $autoridades->getIdautoridad() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $autoridades->getNombre() ?></td>
    </tr>
    <tr>
      <th>Cargo de la Autoridad:</th>
      <td><?php echo $autoridades->getCargoAutoridades()->getNombre() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $autoridades->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('autoridades/edit?idautoridad='.$autoridades->getIdautoridad()) ?>">Editar</a>
&nbsp;
<a href="<?php echo url_for('autoridades/index') ?>">Volver al listado de Autoridades</a>
