<h1>Doc laborals List</h1>

<table>
  <thead>
    <tr>
      <th>Iddoclaboral</th>
      <th>Idpersona</th>
      <th>Idprofesion</th>
      <th>Lugar</th>
      <th>Horas</th>
      <th>Idunidadtiempo</th>
      <th>Certificado</th>
      <th>Trabaja</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($doc_laborals as $doc_laboral): ?>
    <tr>
      <td><a href="<?php echo url_for('doclaboral/edit?iddoclaboral='.$doc_laboral->getIddoclaboral()) ?>"><?php echo $doc_laboral->getIddoclaboral() ?></a></td>
      <td><?php echo $doc_laboral->getIdpersona() ?></td>
      <td><?php echo $doc_laboral->getIdprofesion() ?></td>
      <td><?php echo $doc_laboral->getLugar() ?></td>
      <td><?php echo $doc_laboral->getHoras() ?></td>
      <td><?php echo $doc_laboral->getIdunidadtiempo() ?></td>
      <td><?php echo $doc_laboral->getCertificado() ?></td>
      <td><?php echo $doc_laboral->getTrabaja() ?></td>
      <td><?php echo $doc_laboral->getCreatedAt() ?></td>
      <td><?php echo $doc_laboral->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('doclaboral/new') ?>">New</a>
