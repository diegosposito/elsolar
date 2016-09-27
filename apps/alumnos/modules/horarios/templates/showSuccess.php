<table>
  <tbody>
    <tr>
      <th>Persona:</th>
      <td><?php echo $horarios->getPersonas()->getApellido().', '.$horarios->getPersonas()->getNombre(); ?></td>
    </tr>
    <tr>
      <th>Anulado:</th>
      <td><?php echo $horarios->getAnulado() ?></td>
    </tr>
    <tr>
      <th>Tipo de Registro:</th>
      <td><?php echo $horarios->getTiporegistro()=='E' ? 'Entrada' : 'Salida' ?></td>
    </tr>
    <tr>
      <th>Observaciones:</th>
      <td><?php echo $horarios->getObservaciones() ?></td>
    </tr>
    <tr>
      <th>Creado el:</th>
     <td><?php echo date('d-m-Y H:i:s', strtotime($horarios->getCreatedAt())); ?></td>
    </tr>
    <tr>
      <th>Actualizado el:</th>
      <td><?php echo date('d-m-Y H:i:s', strtotime($horarios->getUpdatedAt())); ?></td>
    </tr>
   
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('horarios/edit?id='.$horarios->getId()) ?>">Editar</a>
&nbsp;
<a href="<?php echo url_for('horarios/registro') ?>">Volver al listado</a>
