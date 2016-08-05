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
<script type="text/javascript">
	// initialise plugins
	jQuery(function(){
		$('ul.sf-menu sf-navbar').superfish({
			pathClass:  'current' 
		});
		
		$('ul.sf-menu sf-vertical').superfish({ 
    		animation: {height:'show'},   // slide-down effect without fade-in
			delay:     1200               // 1.2 second delay on mouseout 
		}); 
	});
</script> 
</head>
<body>
<h1>Visualizar Mesa de Examen</h1>
<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2"><b>Carrera: <?php echo $carrera; ?></b></td>
  </tr>
  <tr>
    <td colspan="2"><b>Asignatura: <?php echo $materia; ?></b></td>
  </tr>
  <tr>
    <td>Condición: <?php echo $condicion; ?></td>
    <td>Fecha: <?php echo $mesa; ?></td>
  </tr>
    <tr>
    <td>Libro: <?php echo $libro; ?></td>
    <td>Folio: <?php echo $folio; ?></td>
  </tr>  
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Legajo</td>
		      <td class="hed" align="center" width="15%">Nro. de Documento</td>
		      <td class="hed" align="center" width="35%">Alumno</td>
		      <td class="hed" align="center" width="15%">Promedio</td>		    
		      </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($alumnos)>0) { ?>
		    <?php foreach ($alumnos as $id =>$alumno) { ?>
		    <tr>
		      <td align="center">
		      	<?php echo $alumno->getLegajo(); ?>
		      	<input type="hidden" value="<?php echo $alumno->getIdalumno(); ?>" name="alumnos[<?php echo $alumno->getIdalumno(); ?>]" />
		      </td>
		      <td align="center"><?php echo $alumno->getPersonas()->getTiposDocumentos()." ".$alumno->getPersonas()->getNumerodoc(); ?></td>
		      <td><?php echo $alumno->getPersonas(); ?></td>
		      <td align="center"><?php echo $notas[$alumno->getIdalumno()]; ?></td>
		    </tr>
		    <?php } ?>	
		    <?php } else { ?>
		    <tr>
		      <td colspan="4" align="center">No existen inscriptos.</td>
		      </td>
		    </tr>			    
		    <?php } ?>	  
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
<br>
</body>