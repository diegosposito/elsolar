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
    <?php use_stylesheet('ui.jqgrid.css') ?>   
    <?php use_stylesheet('jquery.ui.timepicker.css') ?>
    <?php use_stylesheet('jquery.tablescroll.css') ?>
    <?php use_stylesheet('superfish.css') ?>
    <?php use_stylesheet('superfish-vertical.css') ?>
    <?php use_stylesheet('superfish-navbar.css') ?>
    
    <?php use_javascript('webcam.js') ?>   
    <?php use_javascript('hoverIntent.js') ?>
    <?php use_javascript('superfish.js') ?>        
	<?php use_javascript('jquery.validator.js') ?>      
    <?php use_javascript('grid.locale-es.js') ?>
    <?php use_javascript('jquery.jqGrid.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
    <?php use_javascript('jquery.ui.timepicker.js') ?>
    <?php use_javascript('jquery.tablescroll.js') ?>
    
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<h1>Visualizar Mesas de Examenes</h1>
<br>
<div align="center">
	<table width="100%" cellspacing="0" class="stats">
	  <thead>
	    <tr>
	      <td class="hed" align="center" width="2%">Id</td>
	      <td class="hed" align="center" width="16%">Fecha</td>
	      <td class="hed" align="center" >Materia</td>
	      <td class="hed" align="center" width="2%">Libro</td>
	      <td class="hed" align="center" width="2%">Folio</td>
	      <td class="hed" align="center" width="2%">Condición</td>
	    </tr>
	  </thead>
	  <tbody>
	  <?php if (count($mesas) > 0) { ?>
	    <?php foreach ($mesas as $mesa): ?>
	    <tr>
	      <td align="center"><?php echo $mesa->getIdmesaexamen(); ?></td>
		  <td align="center">
				<?php 
				$arr = explode('-', $mesa->fecha);
				$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
				?>			
	    		<?php echo $fecha." - ".$mesa->hora; ?>
	      </td>	      
	      <td><?php echo $mesa->getCatedras()->getMateriasPlanes()->getMaterias()->getNombre(); ?></td>
	      <td align="center"><?php echo $mesa->getLibrosActas(); ?></td>
		  <td align="center"><?php echo $mesa->folio ?></td>
		  <td align="center"><?php echo $mesa->getCondicionesMesas() ?></td>
	     </tr>
	    <?php endforeach; ?>
		<?php } else {?>
			<tr>
				<td colspan="6" align="center">No existen mesas de examenes.</td>
			</tr>
		<?php } ?>	 	    		  
	  </tbody>
	</table>
</div>
<br>
</body>