<h1>Alumnoss List</h1>

<table>
  <thead>
    <tr>
      <th>Idalumno</th>
      <th>Idpersona</th>
      <th>Idplanestudio</th>
      <th>Fechaingreso</th>
      <th>Ingreso</th>
      <th>Legajo</th>
      <th>Fotografia</th>
      <th>Fotocopiadni</th>
      <th>Fotocopialegtitulo</th>
      <th>Certtittramite</th>
      <th>Certalureg</th>
      <th>Derechoevaluacion</th>
      <th>Experiencialaboral</th>
      <th>Pagomatricula</th>
      <th>Bancarizacion</th>
      <th>Titulorevalidado</th>
      <th>Tramiteresidencia</th>
      <th>Radiografiatorax</th>
      <th>Electrocardiograma</th>
      <th>Ergonomia</th>
      <th>Planillamedica</th>
      <th>Planillabucodental</th>
      <th>Activo</th>
      <th>Idestadoalumno</th>
      <th>Codadministracion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($alumnoss as $alumnos): ?>
    <tr>
      <td><a href="<?php echo url_for('alumnos/edit?idalumno='.$alumnos->getIdalumno()) ?>"><?php echo $alumnos->getIdalumno() ?></a></td>
      <td><?php echo $alumnos->getIdpersona() ?></td>
      <td><?php echo $alumnos->getIdplanestudio() ?></td>
      <td><?php echo $alumnos->getFechaingreso() ?></td>
      <td><?php echo $alumnos->getIngreso() ?></td>
      <td><?php echo $alumnos->getLegajo() ?></td>
      <td><?php echo $alumnos->getFotografia() ?></td>
      <td><?php echo $alumnos->getFotocopiadni() ?></td>
      <td><?php echo $alumnos->getFotocopialegtitulo() ?></td>
      <td><?php echo $alumnos->getCerttittramite() ?></td>
      <td><?php echo $alumnos->getCertalureg() ?></td>
      <td><?php echo $alumnos->getDerechoevaluacion() ?></td>
      <td><?php echo $alumnos->getExperiencialaboral() ?></td>
      <td><?php echo $alumnos->getPagomatricula() ?></td>
      <td><?php echo $alumnos->getBancarizacion() ?></td>
      <td><?php echo $alumnos->getTitulorevalidado() ?></td>
      <td><?php echo $alumnos->getTramiteresidencia() ?></td>
      <td><?php echo $alumnos->getRadiografiatorax() ?></td>
      <td><?php echo $alumnos->getElectrocardiograma() ?></td>
      <td><?php echo $alumnos->getErgonomia() ?></td>
      <td><?php echo $alumnos->getPlanillamedica() ?></td>
      <td><?php echo $alumnos->getPlanillabucodental() ?></td>
      <td><?php echo $alumnos->getActivo() ?></td>
      <td><?php echo $alumnos->getIdestadoalumno() ?></td>
      <td><?php echo $alumnos->getCodadministracion() ?></td>
      <td><?php echo $alumnos->getCreatedAt() ?></td>
      <td><?php echo $alumnos->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('alumnos/new') ?>">New</a>
