<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
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
    
    <?php //use_javascript('webcam.js') ?>       
    <?php use_javascript('hoverIntent.js') ?>
    <?php use_javascript('superfish.js') ?>        
	<?php use_javascript('jquery.validator.js') ?>      
    <?php use_javascript('grid.locale-es.js') ?>
    <?php use_javascript('jquery.jqGrid.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
    <?php use_javascript('jquery.ui.timepicker.js') ?>
    <?php use_javascript('jquery.tablescroll.js') ?>
    <?php use_javascript('ddaccordion.js') ?>
 
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

<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/plus.gif' class='statusicon' />", "<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
</head>
<body>
<table align="center" bgcolor="#ffffff" border="0" width="500">
  <tbody>
    <tr>
      <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2">
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/alcec3.jpg">
            </td>
          </tr>
          <tr height="21px" bgcolor="#707173">
          	<?php $esalumno=false; ?>
			<?php if ($sf_user->isAuthenticated()) { ?>
            <td align="center" >
			 	<div class="sf-menu-container">
					<ul class="sf-menu sf-navbar">
					<?php
						$esalumno = false;
						$credencial = '';
						$arrCredenciales = array();
						foreach ($sf_user->getCredentials() as $credencial) {
							array_push($arrCredenciales, $credencial); 
						}
						$sis=$sf_user->getGuardUser()->obtenerSistemas();
					?>
					<?php foreach ($sis as $sistema) { ?>
						<li>
							<a href="<?php echo $url; ?>"><?php echo $sistema->getDescripcion(); ?></a>
						</li>
					<?php } ?>							
					</ul>
				</div>
            </td>
            <td align="right" >
            	<font color="#ffffff"><b><?php echo $sf_user->getGuardUser()->getUsername().' (<a href="'.url_for('@sf_guard_signout').'">Salir</a>)'; ?></b><br>
				<b>Perfil: Administrador</b>
				<?php	
				$credencial = '';
				$arrCredenciales = array();
			?></font>         
			</td>            
			<?php } else { ?>
			<td colspan="2">&nbsp</td>	
            <?php } ?>   
          </tr>          
      </table>
	<?php if($esalumno){ ?>
	  <table><a href="">INGRESAR DESDE AQUI</a></table>
	<?php 
		exit;
	}; ?>
      <table border="0" cellpadding="0" bgcolor="#ffffff" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td width="190" valign="top" >
 				<div class="glossymenu">               
            		<?php $mensaje_usuario=''; ?>
		            <?php if ($sf_user->isAuthenticated()) { 
						$sf_user->setAttribute('idsede',$sf_user->getProfile()->getIdsede());
						$q = Doctrine_Query::create()
							->distinct(true)
							->from('Menu m')
							->Where('m.idsistema = 1')
							->andWhereIn('m.credencial', $arrCredenciales)
							->orderBy('m.idgrupomenu, m.orden');
						          	
						$opciones_menu = $q->execute();     
		
						$grupo_menu_anterior = '';
						$grupo_menu = '';
						foreach ($opciones_menu as $item) {
							$grupo_menu = $item->getIdgrupomenu();
							
							if($grupo_menu <> $grupo_menu_anterior) {
								if ($grupo_menu_anterior != '') {
									echo '</ul></div>';
								}
								echo '<a class="menuitem submenuheader" href="" >'.$item->getGrupomenu()->getDescripcion().'</a><div class="submenu"><ul>';
							}
							echo '<li>'.link_to($item->getDescripcion(), $item->getModulo()).'</li>' ;						              
							$grupo_menu_anterior = $grupo_menu;
						}		
						echo '</ul></div>';	
            		} ?> 
            	</div>
      		</td>
            <td valign="top" style="border-left:1px solid #fcdb1c;">
            <div id="column2">
				<?php 
					echo $mensaje_usuario;
					echo $sf_content;
				?>
			</div>
            </td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
  </tbody>
  <tfoot>
  	<tr>
      <td>
			<table width="100%" border="0">
				<tr>
					<td>
					<img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/alcec2.jpg">
					</td>
				</tr> 
			</table>
	  </td>
      </tr>
  </tfoot>
</table>
<p style="text-align: center;"><small>copyright © 2016 A.L.C.E.C. | dsposito@gmail.com</small><br>
</p>
</body></html>
