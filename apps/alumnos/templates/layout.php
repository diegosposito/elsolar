<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>EL SOLAR URUGUAY - GESTION</title>
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
    <?php use_javascript('jquery.jcarousel.js') ?>
    <?php use_javascript('DD_belatedPNG-min.js') ?>
    <?php use_javascript('functions.js') ?>
    <?php use_javascript('ddaccordion.js') ?>

    <?php use_javascript('prettyCheckboxes.js') ?>

    <?php use_javascript('jquery-1.7.min.js') ?>
   
 
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

	// Obtener areas de documentos
	$q = Doctrine_Query::create()
					->distinct(true)
					->from('AreaDocumentos a')
					->Where('visible')
					->orderBy('orden');
				          	
	$area_documentos = $q->execute();
	
?>

	<div class="shell">
		<!-- Header -->
		<div id="header">
			<div class="cl"></div>
			<!-- Logo -->
			<img alt="Smiley face" height="110" width="940" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/header_elsolar.png">

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
					<a title="Ingreso" href="<?php echo url_for('ingreso/index') ?>"><span class="sep-left"></span>Inicio<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('informes/profesionales') ?>"><span class="sep-left"></span>Profesionales<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Obras Sociales" href="<?php echo url_for('informes/obrassociales') ?>"><span class="sep-left"></span>Obras Sociales<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Documentacion" href="#"><span class="sep-left"></span>Documentacion<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
						<?php foreach($area_documentos as $areas_doc){ ?>
							<li><a title="<?php echo $areas_doc ?>" href="<?php echo url_for('documentosinstitucion/index?idareadocumento='.$areas_doc->getId()) ?>"><span class="sep-left"></span><?php echo $areas_doc->getNombre() ?></a></li>
						<?php } ?>
						</ul>
					</div>
				</li>
				<li>
					<a title="General" href="#"><span class="sep-left"></span>General<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
							<li><a title="Ubicacion" href="<?php echo url_for('ingreso/ubicacion') ?>"><span class="sep-left"></span>Ubicación</a></li>
							<li><a title="Horarios" href="<?php echo url_for('informes/verdetalle') ?>"><span class="sep-left"></span>Horarios</a></li>
							<!--<li><a title="Concacto" href="<?php echo url_for('ingreso/contacto') ?>"><span class="sep-left"></span>Contacto</a></li> -->
						</ul>
					</div>
				</li>
			</ul>
			<div class="cl"></div>
		</div>
		<!-- END Navigation -->
		<!-- Main  -->
		<div id="main">
			<!-- Slider -->
			<!-- <div id="slider-holder">				
				
			</div> -->
			<!-- END Slider -->

            <!-- Content -->
			<div id="content">				
				 <?php echo $sf_content; ?>
			</div>
			<!-- ЕND Content  -->
			<!-- Sidebar -->
			<?php if ($autenticated){ ?>
					<div id="sidebar">
						<div class="box">
							<h2>Gestión General</h2>
							<ul>
							    <?php   if ($autenticated){
							                if ($sf_user->getGuardUser()->getIsSuperAdmin()) {
							    	            echo '<li>'.link_to('Usuarios', 'sf_guard_user').'</li>' ; 
							    	        } 
							    	    } ?>   
								
								<?php
 
								$currentUser = sfContext::getInstance()->getUser();
								 
								// DEFINIR MENU DERECHO para usuarios logueados      
								if ($currentUser->isAuthenticated()) {

									// Menu del grupo administracion
									if ($currentUser->hasCredential("administracion")){ ?>
									   <?php echo '<li>'.link_to('Obras Sociales', 'obrassociales/index').'</li>' ; ?>
									   <?php echo '<li>'.link_to('Personal', 'personas/buscar').'</li>' ; ?>
									   <?php echo '<li>'.link_to('Pacientes', 'paciente/index').'</li>' ; ?>
									   <?php echo '<li>'.link_to('Configuracion General', 'centros/verconfiguracion').'</li>' ; ?>
										<!--<?php echo '<li>'.link_to('Autoridades', 'autoridades').'</li>' ; ?>  -->
										<!--<?php echo '<li>'.link_to('Entidades', 'cargoautoridades/index').'</li>' ; ?> -->
										<?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
									<?php } 

                                                                         // Menu del grupo trabajo social
                                                                         if ($currentUser->hasCredential("trabajosocial")){ ?>
                                                                              <?php echo '<li>'.link_to('Obras Sociales', 'obrassociales/index').'</li>' ; ?>
                                                                              <?php echo '<li>'.link_to('Pacientes', 'paciente/index').'</li>' ; ?>
                                                                             <?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
                                                                        <?php }

                                                                       // Menu del grupo trabajo social solo lectura
                                                                       if ($currentUser->hasCredential("trabajosociallectura")){ ?>
                                                                           <?php echo '<li>'.link_to('Obras Sociales', 'obrassociales/index').'</li>' ; ?>
                                                                           <?php echo '<li>'.link_to('Pacientes', 'paciente/index').'</li>' ; ?>
                                                                           <?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
                                                                        <?php }

									// Menu del grupo administracion
									if ($currentUser->hasCredential("registro")){ ?>
									    <?php echo '<li>'.link_to('Horarios', 'horarios/registro').'</li>' ; ?>
										<?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
									<?php } 

									// Menu del grupo rrhh
									if ($currentUser->hasCredential("rrhh")){ ?>
								        <?php echo '<li>'.link_to('Horarios', 'horarios/personal').'</li>' ; ?>
								        <?php echo '<li>'.link_to('Personal', 'personas/buscar').'</li>' ; ?>
									    <?php echo '<li>'.link_to('Pacientes', 'paciente/index').'</li>' ; ?>
										<?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
									<?php }  

								} ?>
							</ul>
						</div>
					</div>	
			<?php } else { ?>	
				     <div id="sidebar">

				        <div class="box" style="width=200px"><br></div>	
				        
					    <div class="box" style="background-color:#AA4375;width=200px">
								<p style="margin-left: 0em;text-align:center;color:#ffffff;font-weight:bold"><a style="text-align:left;color:#ffffff;font-weight:bold" href="<?php echo url_for('guard/login') ?>">Administrador</a></p>
						</div>
						<div class="box" style="width=200px">
							<a  href="<?php echo url_for('guard/login') ?>"><img alt="Smiley face"  src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/login.png"></a>
						</div>
                        <div class="box" style="background-color:#AA4375;width=200px">
								<p style="margin-left: 0em;text-align:center;color:#ffffff;font-weight:bold"><a style="text-align:left;color:#ffffff;font-weight:bold" href="<?php echo url_for('ingreso/registro') ?>">Ingreso</a></p>
						</div>
						<div class="box" style="width=200px">
						   <a  href="<?php echo url_for('ingreso/registro') ?>"><img alt="Comunicaciones" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/registro.jpg"></a>
						</div>
                        <br>
                        <div class="box" style="background-color:#AA4375;width=200px">
								<p style="margin-left: 0em;text-align:center;color:#ffffff;font-weight:bold"><a style="text-align:left;color:#ffffff;font-weight:bold" href="<?php echo url_for('guard/login') ?>">Comunicación</a></p>
						</div>
						<div class="box" style="width=200px">
						   <a  href="<?php echo url_for('guard/login') ?>"><img alt="Comunicaciones" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/comunicaciones.png"></a>
						</div>
                        <br>
                        <div class="box" style="background-color:#AA4375;width=200px">
								<p style="margin-left: 0em;text-align:center;color:#ffffff;font-weight:bold"><a style="text-align:left;color:#ffffff;font-weight:bold" href="<?php echo url_for('guard/login') ?>">Biblioteca</a></p>
						</div>
						<div class="box" style="width=200px">
					        <a  href="<?php echo url_for('guard/login') ?>"><img alt="libros" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/libros.jpg"></a>
						</div>
                        <br>
					</div>	 
			<?php } ?>	
			<!-- END Sidebar -->
			<div class="cl"></div>
			<!-- Feartured Products -->
			<div class="products featured">
			</div>
			<!-- END Featured Products -->			
			<!-- Footer  -->
			<div id="footer">
			<!--
				<div id="footer-top"></div>
				<div id="footer-middle">
					<div class="col styles">
						<h3>Quienes somos?</h3>
						<ul>
							<li><a title="Acerca de" href="#"><span class="bullet"></span>Misión</a></li>
						</ul>
					</div>
					<div class="col info">
						<h3>Información</h3>
						<ul>
							<li><a title="Políticas de Privacidad" href="#"><span class="bullet"></span>Políticas Privacidad</a></li>
						</ul>
					</div>
					<div class="col newsletter">
						<h3>Newsletter</h3>
						 <form name="registrarse" method="post" action="<?php echo url_for('ingreso/index' ) ?>"> 
							<div class="field-holder"><input type="text" class="field" value="Ingrese su Email" title="Ingrese su Email" /></div>
							<div class="cl"></div>
							<input type="checkbox" name="check-box" value="" id="check-box" />
							<label for="check-box">Confirmo que deseo recibir correspondencia. </label>
							<input type="submit" value="Registrarse" class="submit-button" />
						</form>
					</div>
					<div class="cl"></div>
				</div>
				-->
				<div id="footer-bottom">
					<p>&copy;Copyright El Solar Uruguay. Diseñado por <a href="#">C.del U.</a></p>
				</div>
			</div>
			<!-- END Footer -->
		</div>
		<!-- END Main -->
	</div>	
</body>
</html>
