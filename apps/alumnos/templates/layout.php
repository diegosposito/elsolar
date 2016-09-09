<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>CIRCULO ODONTOLOGICO CONCEPCION DEL URUGUAY</title>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php use_stylesheet('jquery-ui-1.8.20.custom.css') ?>
    <?php use_stylesheet('menu.css') ?>
    <?php use_stylesheet('ui.jqgrid.css') ?>   
    <?php use_stylesheet('jquery.ui.timepicker.css') ?>
    <?php use_stylesheet('jquery.tablescroll.css') ?>
    <?php use_stylesheet('superfish.css') ?>
    <?php use_stylesheet('superfish-vertical.css') ?>
    <?php use_stylesheet('superfish-navbar.css') ?>
    <?php use_stylesheet('ddaccordion.css') ?>
    <?php use_stylesheet('style.css') ?>
    <?php use_stylesheet('prettyCheckboxes.css') ?>
    
    <?php //use_javascript('webcam.js') ?>       
    <?php use_javascript('hoverIntent.js') ?>
    <?php use_javascript('superfish.js') ?>        
	<?php use_javascript('jquery.validator.js') ?>      
    <?php use_javascript('grid.locale-es.js') ?>
    <?php use_javascript('jquery.jqGrid.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
    <?php use_javascript('jquery.ui.timepicker.js') ?>
    <?php use_javascript('jquery.tablescroll.js') ?>
    <?php use_javascript('jquery-1.7.min.js') ?>
    <?php use_javascript('jquery.jcarousel.js') ?>
    <?php use_javascript('DD_belatedPNG-min.js') ?>
    <?php use_javascript('functions.js') ?>
    <?php use_javascript('ddaccordion.js') ?>
 
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<?php
	$autenticated =false;
	if ($sf_user->isAuthenticated()) { 
	    $esalumno = false;
	    $autenticated =true;
	    $credencial = '';
		$arrCredenciales = array();
		foreach ($sf_user->getCredentials() as $credencial) {
			array_push($arrCredenciales, $credencial); 
		}
		$sis=$sf_user->getGuardUser()->obtenerSistemas();
		$sf_user->setAttribute('idsede',$sf_user->getProfile()->getIdsede());
	}	
?>

	<div class="shell">
		<!-- Header -->
		<div id="header">
			<div class="cl"></div>
			<!-- Logo -->
			<img alt="Smiley face" height="142" width="900" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/headerlogo.png">

			<?php if ($autenticated){ ?>
			<p align="right"><?php echo '<b>Usuario:</b> '.$sf_user->getGuardUser()->getUsername(); ?> </p>
			<?php } ?>
			
		
			<!-- END Top Navigation -->	
		</div>
		<!-- END Header -->
		<!-- Navigation -->
		<div id="navigation">
			<ul>
				<li>
					<a title="Profesionales" href="<?php echo url_for('ingreso/index') ?>"><span class="sep-left"></span>Inicio<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('informes/profesionales') ?>"><span class="sep-left"></span>Profesionales<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('informes/obrassociales') ?>"><span class="sep-left"></span>Obras Sociales<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Institucionales" href="#"><span class="sep-left"></span>Institucionales<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
							<li><a title="Autoridades" href="<?php echo url_for('autoridades/index') ?>"><span class="sep-left"></span>Autoridades</a></li>
							<li>
								<a title="Drop down menu 2" href="#"><span class="sep-left"></span>Drop down menu 2</a>
								<div class="dd">
									<ul>
										<li><a title="Drop down menu 1" href="#"><span class="sep-left"></span><span class="dd-first"></span>Drop down menu 1</a></li>
										<li><a title="Drop down menu 2" href="#"><span class="sep-left"></span>Drop down menu 2</a></li>
										<li><a title="Drop down menu 3" href="#"><span class="sep-left"></span>Drop down menu 3</a></li>										
									</ul>
								</div>
							</li>
							<li><a title="Drop down menu 3" href="#"><span class="sep-left"></span>Drop down menu 3</a></li>							
						</ul>
					</div>
				</li>
				<li><a title="For Children" href="#"><span class="sep-left"></span>Acerca de<span class="sep-right"></span></a></li>
			</ul>
			<div class="cl"></div>
		</div>
		<!-- END Navigation -->
		<!-- Main  -->
		<div id="main">
			<!-- Slider -->
			<div id="slider-holder">				
				
			</div>
			<!-- END Slider -->

            <!-- Content -->
			<div id="content">				
				 <?php echo $sf_content; ?>
			</div>
			<!-- ЕND Content  -->
			<!-- Sidebar -->
			<div id="sidebar">
				<div class="box">
					<h2>Gestión General</h2>
					<ul>
					    <?php   if ($autenticated){
					                if ($sf_user->getGuardUser()->getIsSuperAdmin()) {
					    	            echo '<li>'.link_to('Usuarios', 'sf_guard_user').'</li>' ; 
					    	        } 
					    	    } ?>   
						<?php echo '<li>'.link_to('Profesionales', 'personas/buscar').'</li>' ; ?>
						<?php echo '<li>'.link_to('Obras Sociales', 'obrassociales/index').'</li>' ; ?>
						<?php echo '<li>'.link_to('Autoridades', 'autoridades').'</li>' ; ?>
						<?php echo '<li>'.link_to('Entidades', 'cargoautoridades/index').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Contenido', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Documentos', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
					</ul>
				</div>
			</div>	
			<!-- END Sidebar -->
			<div class="cl"></div>
			<!-- Feartured Products -->
			<div class="products featured">
			</div>
			<!-- END Featured Products -->			
			<!-- Footer  -->
			<div id="footer">
				<div id="footer-top"></div>
				<div id="footer-middle">
					<div class="col styles">
						<h3>Styles</h3>
						<ul>
							<li><a title="Acerca de" href="#"><span class="bullet"></span>Acerca de</a></li>
							<li><a title="abstract" href="#"><span class="bullet"></span>Misión</a></li>
						</ul>
					</div>
					<div class="col info">
						<h3>Información</h3>
						<ul>
							<li><a title="Políticas de Privacidad" href="#"><span class="bullet"></span>Políticas Privacidad</a></li>
							<li><a title="@CopyRight" href="#"><span class="bullet"></span>@CopyRight</a></li>
						</ul>
					</div>
					<div class="col newsletter">
						<h3>Newsletter</h3>
						<form action="" method="post">
							<div class="field-holder"><input type="text" class="field" value="Ingrese su Email" title="Ingrese su Email" /></div>
							<div class="cl"></div>
							<input type="checkbox" name="check-box" value="" id="check-box" />
							<label for="check-box">Confirmo que deseo recibir correspondencia. </label>
							<input type="submit" value="Registrarse" class="submit-button" />
						</form>
					</div>
					<div class="cl"></div>
				</div>
				<div id="footer-bottom">
					<p>&copy; Círculo Odontológico. Diseñado por <a href="#">C.del U.</a></p>
				</div>
			</div>
			<!-- END Footer -->
		</div>
		<!-- END Main -->
	</div>	
</body>
</html>