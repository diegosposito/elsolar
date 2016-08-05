<table>
  <tbody>
    <tr>
      <th>Idtipodocumentacion:</th>
      <td><?php echo $tipos_documentacion->getIdtipodocumentacion() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $tipos_documentacion->getNombre() ?></td>
    </tr>
    <tr>
      <th>Nombre reducido:</th>
      <td><?php echo $tipos_documentacion->getNombrereducido() ?></td>
    </tr>    
    <tr>
      <th>Aplicable a</th>
      <td><?php echo $tipos_documentacion->getAplicable() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('tiposdocumentacion/edit?idtipodocumentacion='.$tipos_documentacion->getIdtipodocumentacion()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('tiposdocumentacion/index') ?>">List</a>
