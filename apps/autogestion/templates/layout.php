<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Universidad de Concepción del Uruguay</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
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
<table align="center" border="0" width="70%">
  <tbody>
    <tr>
      <td>
      <table class="encabezadologin"  >
          <tr>
            <td class="titulo">
            <?php if (!$sf_user->isAuthenticated()) { ?>
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/cabeceraucu_2015.jpg">
            <?php }else{ ?>
            <img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/encabezado_autogestion_2015.jpg">
            <?php } ?>                       
            </td>
          </tr>
          <tr height="21px">
			<?php if ($sf_user->isAuthenticated()) { ?>
            <td align="center" colspan="2" >
		      <table class="cuerpo">
		          <tr>
		            <td class="titulo_sistema" >Sistema de Alumnos On-line</td>
					<td class="subtitnegro" >					
						<ul class="jd_menu jd_menu_slate" >
							<li><a class="accessible"><?php echo $sf_user->getGuardUser()->getFirstName()." ".$sf_user->getGuardUser()->getLastName(); ?></a>
						<ul>
							<li><a href="<?php echo url_for('personas/modificardatospersonales') ?>">Datos personales</a>
							<li><a href="<?php echo url_for('usuario/cambiarpassword') ?>">Cambiar Contraseña</a>
							<li><a href="<?php echo url_for('@user_logout') ?>">Salir</a>
						</ul>	
						</ul>
					</td>
		          </tr>
		      </table>	  
  
			</td>            
			<?php } else { ?>
			<td colspan="2">&nbsp</td>	
            <?php } ?>              
            				<?php	
				$credencial='';
				$arrCredenciales = array();
				foreach ($sf_user->getCredentials() as $credencial) {
					array_push($arrCredenciales, $credencial); 
					//echo '&nbsp'.$credencial;
				}
				?>
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
					->Where('m.idsistema = '.$sf_user->getAttribute('id_sistema'))
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
		<?php if (!$sf_user->isAuthenticated()) { ?>
			<table class="pielogin">
				<tr>
					<td>
					<img alt="" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/pieUCU.jpg">
					</td>
				</tr> 
			</table>
      	<?php }else{ ?>
		  <table  class="pieloginon">
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
<p style="text-align: center;"><small>copyright © 2012 U.C.U. | sistemas@ucu.edu.ar</small><br>
</p>
</body></html>
