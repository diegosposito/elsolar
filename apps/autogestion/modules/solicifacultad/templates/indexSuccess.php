<br>
<h1>Listado de solicitudes</h1>
<br>
<?php if ($id==1){ ?>
<a href="<?php echo url_for('solicifacultad/index?id=0') ?>">Visualizar no resueltas</a>
<?php } else { ?>
<a href="<?php echo url_for('solicifacultad/index?id=1') ?>">Visualizar resueltas</a>	
<?php } ?>
<br><br>
<table width="70%" class="stats" cellspacing="0">
<thead>
    <tr>
      <td class="hed">Descripcion</td>
      <td class="hed">Respuesta</td>
      <td class="hed">Resuelta</td>
      <td class="hed">Actualizada</td>
      <td class="hed">Acciones</td>
    </tr>
  </thead>

<?php foreach ($solicitudess as $solicitudes): ?>
<tr>
      <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getDescripcion()),0, 50)."..." ?></td>
      <td width="250px"><?php echo substr(htmlspecialchars_decode($solicitudes->getRespuesta()),0, 50)."..." ?></td>
      <td width="30px"><input type=checkbox disabled <?php if($solicitudes->getResuelta()) echo 'checked="checked"' ?>><br></td>
      <td width="30px"><?php echo $solicitudes->getUpdatedAt() ?></td>
      <td width="30px"><a href="<?php echo url_for('solicifacultad/edit?id='.$solicitudes->getId()) ?>">Editar</a></td>
</tr>
<?php endforeach; ?>
</table>

  <br>  