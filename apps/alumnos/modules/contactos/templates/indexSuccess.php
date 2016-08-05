<h1>Contactoss List</h1>

<table>
  <thead>
    <tr>
      <th>Idcontacto</th>
      <th>Idpersona</th>
      <th>Idciudade</th>
      <th>Callee</th>
      <th>Numeroe</th>
      <th>Barrioe</th>
      <th>Edificioe</th>
      <th>Pisoe</th>
      <th>Deptoe</th>
      <th>Idciudadt</th>
      <th>Callet</th>
      <th>Numerot</th>
      <th>Barriot</th>
      <th>Edificiot</th>
      <th>Pisot</th>
      <th>Deptot</th>
      <th>Telefonofijocar</th>
      <th>Telefonofijonum</th>
      <th>Celularcar</th>
      <th>Celularnum</th>
      <th>Email</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contactoss as $contactos): ?>
    <tr>
      <td><a href="<?php echo url_for('contactos/edit?idcontacto='.$contactos->getIdcontacto()) ?>"><?php echo $contactos->getIdcontacto() ?></a></td>
      <td><?php echo $contactos->getIdpersona() ?></td>
      <td><?php echo $contactos->getIdciudade() ?></td>
      <td><?php echo $contactos->getCallee() ?></td>
      <td><?php echo $contactos->getNumeroe() ?></td>
      <td><?php echo $contactos->getBarrioe() ?></td>
      <td><?php echo $contactos->getEdificioe() ?></td>
      <td><?php echo $contactos->getPisoe() ?></td>
      <td><?php echo $contactos->getDeptoe() ?></td>
      <td><?php echo $contactos->getIdciudadt() ?></td>
      <td><?php echo $contactos->getCallet() ?></td>
      <td><?php echo $contactos->getNumerot() ?></td>
      <td><?php echo $contactos->getBarriot() ?></td>
      <td><?php echo $contactos->getEdificiot() ?></td>
      <td><?php echo $contactos->getPisot() ?></td>
      <td><?php echo $contactos->getDeptot() ?></td>
      <td><?php echo $contactos->getTelefonofijocar() ?></td>
      <td><?php echo $contactos->getTelefonofijonum() ?></td>
      <td><?php echo $contactos->getCelularcar() ?></td>
      <td><?php echo $contactos->getCelularnum() ?></td>
      <td><?php echo $contactos->getEmail() ?></td>
      <td><?php echo $contactos->getCreatedAt() ?></td>
      <td><?php echo $contactos->getUpdatedAt() ?></td>
      <td><?php echo $contactos->getCreatedBy() ?></td>
      <td><?php echo $contactos->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('contactos/new') ?>">New</a>
