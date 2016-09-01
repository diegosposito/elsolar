<table>
  <tbody>
    <tr>
      <th>Idobrasocial:</th>
      <td><?php echo $obras_sociales->getIdobrasocial() ?></td>
    </tr>
    <tr>
      <th>Denominacion:</th>
      <td><?php echo $obras_sociales->getDenominacion() ?></td>
    </tr>
    <tr>
      <th>Abreviada:</th>
      <td><?php echo $obras_sociales->getAbreviada() ?></td>
    </tr>
    <tr>
      <th>Estado:</th>
      <td><?php echo $obras_sociales->getEstado() ?></td>
    </tr>
    <tr>
      <th>Fechaarancel:</th>
      <td><?php echo $obras_sociales->getFechaarancel() ?></td>
    </tr>
    <tr>
      <th>Fechaultimoperiodo:</th>
      <td><?php echo $obras_sociales->getFechaultimoperiodo() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $obras_sociales->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $obras_sociales->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $obras_sociales->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated by:</th>
      <td><?php echo $obras_sociales->getUpdatedBy() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('obrassociales/edit?idobrasocial='.$obras_sociales->getIdobrasocial()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('obrassociales/index') ?>">List</a>
