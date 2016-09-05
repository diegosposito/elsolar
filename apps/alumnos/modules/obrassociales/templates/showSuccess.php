<table>
  <tbody>
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
      <th>Fecha Arancel:</th>
      <td><?php echo $obras_sociales->getFechaarancel() ?></td>
    </tr>
    <tr>
      <th>Fecha Ultimo Periodo:</th>
      <td><?php echo $obras_sociales->getFechaultimoperiodo() ?></td>
    </tr>
    <tr>
      <th>Fecha Alta:</th>
      <td><?php echo $obras_sociales->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Fecha Ultima Modificación:</th>
      <td><?php echo $obras_sociales->getUpdatedAt() ?></td>
    </tr>
   </tbody>
</table>

<hr />


&nbsp;
<a href="<?php echo url_for('informes/obrassociales') ?>">Volver al listado</a>
