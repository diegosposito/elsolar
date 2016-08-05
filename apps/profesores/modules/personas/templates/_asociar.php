<h2>Buscador</h2>
<div align="center">
 <?php if (count($facultades) == 0){ ?>
  <div align="left"><p style="color:green"><b> <?php echo $msg ?> </b></p></div>
  <?php } ?>
<form action="<?php echo url_for('personas/asociar') ?>" method="post">
  <table cellspacing="0" class="stats" width="70%">
    <?php echo $form ?>
	<tr>
		<td colspan="2" align="center"><input type="submit" value="Buscar" /></td>
    </tr>    
  </table>
</form>

<br>
<?php if (count($resultado) > 0){ ?>		    	   	
	<table cellspacing="0" class="stats">
	    <tr>
	      <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
	    </tr>
	    <tr>
	      <td width="30%" align="center" class="hed">Apellido</td>
	      <td width="30%" align="center" class="hed">Nombre</td>
	      <td width="30%" align="center" class="hed">Nro. de Documento</td>
	      <td width="10%" colspan="2" align="center" class="hed">Asociar a Facultad</td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="30%"><?php echo $item['apellido'] ?></td>
	      <td width="30%"><?php echo $item['nombre'] ?></td>
	      <td width="30%"><?php echo $item['nrodoc'] ?></td>
	      <td width="5%">
			<form action="<?php echo url_for('personas/verfacultades') ?>" method="post">
				<input type="hidden" name="idpersona" value="<?php echo $item['idpersona']; ?>">
				<input type="submit" value="Seleccionar" title="Seleccionar" id="Asociar">
			</form>
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
<?php } else { 
	if ($post) { ?>
    <table cellspacing="0" class="stats">
	    <tr>
	      <td colspan="4" bgcolor="#F80F0F" width="100%">No es han encontrado coincidencias. Redefina la búsqueda. <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
	    </tr>
	    <tr>
	      <td width="30%" align="center" class="hed">Apellido</td>
	      <td width="30%" align="center" class="hed">Nombre</td>
	      <td width="30%" align="center" class="hed">Nro. de Documento</td>
	      <td width="10%" align="center" class="hed"></td>
	    </tr>
	  </thead>
	</table>
<?php } 
 } ?> 		
</div>
