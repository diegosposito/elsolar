<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>CSS Free Templates with jQuery Slider</title>
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
	if ($sf_user->isAuthenticated()) { 
	    $esalumno = false;
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
			<!-- Search  -->			
			<div id="search">
				<div class="search-holder">
					<form action="" method="post">					
						<input type="text" class="field" value="Keywords" title="Keywords" />
						<input type="submit" value="" class="submit-button" />						
					</form>
					<?php if ($sf_user->isAuthenticated()) { 
						$esalumno = false;
						$credencial = '';
						$arrCredenciales = array();
						foreach ($sf_user->getCredentials() as $credencial) {
							array_push($arrCredenciales, $credencial); 
						}
						$sis=$sf_user->getGuardUser()->obtenerSistemas();
					?>
					<font color="#000000"><b><?php echo $sf_user->getGuardUser()->getUsername().' (<a href="'.url_for('@sf_guard_signout').'">Salir</a>)'; ?></b><br>
					<?php } ?>	
					<div class="cl"></div>
				</div>	
			</div>
			<!-- END Search -->						
			<div class="cl"></div>
			<!-- Logo -->
			<h1 id="logo"><a title="Home" href="#">Mega Store</a></h1>
			<!-- Top Navigation -->
			<div id="top-navigation">	
				<ul>
					<li>0 items  $ 0,00</li>
					<li><a class="start" title="My Account" href="#"><span></span>My Account</a></li>
					<li><a class="cart" title="shopping cart" href="#"><span></span>shopping cart </a></li>
					<li><a class="end" title="checkout" href="#">checkout<span></span></a></li>				
				</ul>		
			</div>				
			<!-- END Top Navigation -->	
			<div class="cl"></div>		
		</div>
		<!-- END Header -->
		<!-- Navigation -->
		<div id="navigation">
			<ul>
				<li><a title="Home" href="#">Home<span class="sep-right"></span></a></li>
				<li>
					<a title="Games" href="#"><span class="sep-left"></span>Gamer<span class="sep-right"></span></a>
				</li>
				<li><a title="Abstract" href="#"><span class="sep-left"></span>abstract<span class="sep-right"></span></a></li>
				<li>
					<a title="Retro" href="#"><span class="sep-left"></span>Retro<span class="sep-right"></span></a>
					<div class="dd">
						<ul>z
							<li><a title="Drop down menu 1" href="#"><span class="sep-left"></span>Drop down menu 1</a></li>
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
				<li><a title="HI Tech" href="#"><span class="sep-left"></span>HI Tech<span class="sep-right"></span></a></li>
				<li><a title="For Children" href="#"><span class="sep-left"></span>For Children<span class="sep-right"></span></a></li>
				<li><a title="For Ladies" href="#"><span class="sep-left"></span>For Ladies<span class="sep-right"></span></a></li>
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
					<h2>Quick Links</h2>
					<ul>
					    <?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Gestión Personas', 'personas/new').'</li>' ; ?>
						<?php echo '<li>'.link_to('Salir', 'personas/new').'</li>' ; ?>
					</ul>
				</div>
			</div>	
			<!-- END Sidebar -->
			<div class="cl"></div>
			<!-- Feartured Products -->
			<div class="products featured">
				<h2>Featured Products</h2>
				<div class="products-slider">
					<ul>
						<li>
							<a title="Details" href="#"><img src="/images/1.jpg" alt="Silver half transparent with blue lights computer case" /></a>
							<p>Model Name</p>
						</li>
					</ul>
				</div>
			</div>
			<!-- END Featured Products -->			
			<!-- Footer  -->
			<div id="footer">
				<div id="footer-top"></div>
				<div id="footer-middle">
					<div class="col styles">
						<h3>Styles</h3>
						<ul>
							<li><a title="gamer" href="#"><span class="bullet"></span>gamer</a></li>
							<li><a title="abstract" href="#"><span class="bullet"></span>abstract</a></li>
							<li><a title="retro" href="#"><span class="bullet"></span>retro</a></li>
							<li><a title="hi tech" href="#"><span class="bullet"></span>hi tech</a></li>
							<li><a title="for children" href="#"><span class="bullet"></span>for children</a></li>
							<li><a title="for ladies" href="#"><span class="bullet"></span>for ladies</a></li>							
						</ul>
					</div>
					<div class="col info">
						<h3>Information</h3>
						<ul>
							<li><a title="About MEGAStore" href="#"><span class="bullet"></span>About MEGAStore</a></li>
							<li><a title="Privacy Policy" href="#"><span class="bullet"></span>Privacy Policy</a></li>
							<li><a title="Terms &amp; Conditions" href="#"><span class="bullet"></span>Terms &amp; Conditions</a></li>
							<li><a title="Contact Us" href="#"><span class="bullet"></span>Contact Us</a></li>
							<li><a title="Site Map" href="#"><span class="bullet"></span>Site Map</a></li>												
						</ul>
					</div>
					<div class="col newsletter">
						<h3>Newsletter</h3>
						<p>NO SPAM! Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<form action="" method="post">
							<div class="field-holder"><input type="text" class="field" value="Enter Your Email" title="Enter Your Email" /></div>
							<div class="cl"></div>
							<input type="checkbox" name="check-box" value="" id="check-box" />
							<label for="check-box">Lorem ipsum dolor sit amet, consectetur </label>
							<input type="submit" value="submit" class="submit-button" />
						</form>
					</div>
					<div class="cl"></div>
				</div>
				<div id="footer-bottom">
					<p>&copy; MegaStore. Design by <a href="http://css-free-templates.com/">CSS-FREE-TEMPLATES.COM</a></p>
				</div>
			</div>
			<!-- END Footer -->
		</div>
		<!-- END Main -->
	</div>	
</body>
</html>