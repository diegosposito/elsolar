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
<table align="center" bgcolor="#ffffff" border="0" width="500">
  <tbody>
    <tr>
      <td>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2">
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/cabeceraucu.png">
            </td>
          </tr>
          <tr height="21px" bgcolor="#707173">
			<?php if ($sf_user->isAuthenticated()) { ?>
            <td align="center" >
			 	<div class="sf-menu-container">
					<ul class="sf-menu sf-navbar">
					<?php
						$credencial='';
						$arrCredenciales = array();
						foreach ($sf_user->getCredentials() as $credencial) {
							array_push($arrCredenciales, $credencial); 
						}
						$sis=$sf_user->getGuardUser()->obtenerSistemas();
					?>
					<?php foreach ($sis as $sistema) { ?>
						<li>
							<a href="<?php echo $sistema->getUrl();	 ?>"><?php echo $sistema->getDescripcion(); ?></a>
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
            <?php $mensaje_usuario=''; ?>

            <?php if ($sf_user->isAuthenticated()) { 
				$sf_user->setAttribute('idsede',$sf_user->getProfile()->getIdsede());
				$q = Doctrine_Query::create()
					->distinct(true)
					->from('Menu m')
					->Where('m.idsistema = 3')
					->andWhereIn('m.credencial', $arrCredenciales)
					->orderBy('m.idgrupomenu, m.orden');
				          	
				$opciones_menu = $q->execute();     

				$grupo_menu_anterior = '';
				$grupo_menu = '';
				foreach ($opciones_menu as $item) {
					$grupo_menu = $item->getIdgrupomenu();
					
					if($grupo_menu <> $grupo_menu_anterior) {
						if ($grupo_menu_anterior != '') {
							echo '</ul></div><br><br>';
						}
						echo '<div id="sf-menu-container"><b>'.$item->getGrupomenu()->getDescripcion().'</b><ul class="sf-menu sf-vertical">';
					}
					echo '<li>'.link_to($item->getDescripcion(), $item->getModulo()).'</li>' ;						              
					$grupo_menu_anterior = $grupo_menu;
				}		
				echo '</ul></div>';	
            ?>
            <?php } ?> 
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
					<img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/pieUCU.jpg">
					</td>
				</tr> 
			</table>
	  </td>
      </tr>
  </tfoot>
</table>
<p style="text-align: center;"><small>copyright © 2012 U.C.U. | sistemas@ucu.edu.ar</small><br>
</p>
</body></html>