<table class="stats" cellspacing="0">
    <tr>
      <td width="15%"><b>Id:</b></td>
      <td><?php echo $solicitudes->getId() ?></td>
    </tr>
    <tr>
      <td ><b>Solicitud:</b></td>
      <td><?php echo htmlspecialchars_decode($solicitudes->getDescripcion()) ?></td>
    </tr>
    <tr>
      <td ><b>Resuelta:</b></td>
      <td><?php echo ( $solicitudes->getResuelta() == 1 ) ? 'Si' : 'No'; ?></td>
    </tr>
    <tr>
      <td ><b>Respuesta:</b></td>
      <td><?php echo htmlspecialchars_decode($solicitudes->getRespuesta()) ?></td>
    </tr>
    <tr>
      <td ><b>Fecha de Creación:</b></td>
      <td><?php echo $solicitudes->getCreatedAt() ?></td>
    </tr>
    <tr>
      <td ><b>Fecha de Actualización:</b></td>
      <td><?php echo $solicitudes->getUpdatedAt() ?></td>
    </tr>
</table>