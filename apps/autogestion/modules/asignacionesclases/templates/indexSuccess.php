<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Universidad de Concepción del Uruguay</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

   <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php use_stylesheet('main.css') ?>
    <?php use_stylesheet('jquery-ui-1.8.20.custom.css') ?>
    <?php use_stylesheet('tabla.css') ?>
    <?php use_stylesheet('av.css') ?>
		
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<h1>Asignaciones</h1>

<table width="100%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <th>Id</th>
      <th>Dia</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Hora de inicio</th>
      <th>Hora de fin</th>
      <th>Aula</th>
      <th>Observaciones</th>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($asignacioness) > 0) { ?>
    <?php foreach ($asignacioness as $asignaciones): ?>
    <tr>
      <td class="hed" align="center"><?php echo $asignaciones->getIdasignacion() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getNombreDia() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getInicio() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getFin() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getHorainicio() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getHorafin() ?></td>
      <td class="hed" align="center"><?php echo $asignaciones->getAulas() ?></td>
      <td class="hed" align="left"><?php echo $asignaciones->getObservaciones() ?></td>
    </tr>
    <?php endforeach; ?>
    <?php }else{ ?>
    <tr>
      <td class="hed" align="center" colspan="8">No hay horarios asignados.</td>
    </tr>    
    <?php } ?>
  </tbody>
</table>
</body></html>