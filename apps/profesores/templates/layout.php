<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Universidad de Concepción del Uruguay</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
            <?php if (!$sf_user->isAuthenticated()) { ?>
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/cabeceraucu.png">
            <?php }else{ ?>
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/cabeceraucu2.png">
            <?php } ?>                       
            </td>
          </tr>
          <tr height="21px" bgcolor="#7b76b6">
			<?php if ($sf_user->isAuthenticated()) { ?>
            <td align="center" >
<div class="sf-menu-container">
					<ul class="sf-menu sf-navbar">
					<?php
						$esalumno=false;
						$credencial='';
						$arrCredenciales = array();
						foreach ($sf_user->getCredentials() as $credencial) {
							array_push($arrCredenciales, $credencial); 
						}
						$sis=$sf_user->getGuardUser()->obtenerSistemas();
					?>
					<?php foreach ($sis as $sistema) { ?>
						<li>
							<a href="<?php echo $sistema->getUrl(); ?>"><?php echo $sistema->getDescripcion(); ?></a>
						</li>
					<?php } ?>							
					</ul>
				</div>
            </td>
            <td align="right" >
            	<font color="#ffffff"><b><?php echo $sf_user->getGuardUser()->getUsername().' (<a href="'.url_for('@sf_guard_signout').'">Salir</a>)'; ?></b><br>
				<b>Perfil:</b>
				<?php	
				$credencial='';
				$arrCredenciales = array();
				foreach ($sf_user->getCredentials() as $credencial) {
					array_push($arrCredenciales, $credencial); 
					echo '&nbsp'.$credencial;
				}
				?></font>         
			</td>            
			<?php } else { ?>
			<td colspan="2">&nbsp</td>	
            <?php } ?>              
            
          </tr>          
      </table>
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
					->Where('m.idsistema = '.$sf_user->getAttribute('id_sistema'))
					->WhereIn('m.credencial', $arrCredenciales)
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
		<?php if (!$sf_user->isAuthenticated()) { ?>
			<table width="100%" border="0">
				<tr>
					<td>
					<img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/pieUCU.jpg">
					</td>
				</tr> 
			</table>
      	<?php } else { ?>
		  <table width="100%" border="0" bgcolor="#707173">
			<tr>
				<td width="12%"></td>
				<td width="26%"><div id="titlefooter"><img alt="Links de Interés" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-info.png">Links de Interés</div></td>
				<td width="2%"></td>
				<td width="2%"></td>
				<td width="27%"><div id="titlefooter"><img alt="Seguinos en" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-seguinos.png">Seguinos en</div></td>
				<td width="2%"></td>
				<td width="2%"></td>
				<td width="26%"><div id="titlefooter"><img alt="Contacto" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-contacto.png">Contacto</div></td>
			</tr>
			<tr>
				<td></td>
				<td class="punteado" valign="top"><div id="txtfooter">
				<ul>
				<li><a href="http://www.ucu.edu.ar" target="_blank"><img alt="UCU" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-web.png">UCU Web</a><br>
				<a href="http://biblioteca.ucu.edu.ar" target="_blank"><img alt="Biblioteca Central" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-biblio.png">Biblioteca Central</a><br>
				</li></ul></div>
				</td>
				<td></td>
				<td></td>
				<td class="punteado" valign="top" ><div id="txtfooter">
				<ul>
				<li>
				<a href="http://www.facebook.com/ucu.oficial" target="_blank"><img alt="Facebook" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-facebook.png"> UCU </a><br>
				<a href="http://twitter.com/#!/@UCUNoticias" target="_blank"><font color="#ffffff"><img alt="Twitter" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/icon-twitter.png"> @UCUNoticias</a><br>
				</font>
				</li></ul></div></td>
				<td></td>
				<td></td>
				<td valign="top"><div id="txtfooter">
					8 de junio 522 - CP E3260ANJ<br>
					Concecpión del Uruguay - Entre Ríos<br>
					Tel./Fax: 00 54 3442-425606/427721
				</div></td>
			</tr>	  
		  </table>
		<?php } ?>      
	  </td>
      </tr>
  </tfoot>
</table>
<p style="text-align: center;"><small>copyright © 2015 U.C.U. | sistemas@ucu.edu.ar</small><br>
</p>
</body></html>
