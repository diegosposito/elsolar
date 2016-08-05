<h2>Buscador</h2>
<div align="center">
<form action="<?php echo url_for('profesores/buscar') ?>" method="post">
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
	      <td width="10%" align="center" class="hed"></td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="30%"><?php echo $item['apellido'] ?></td>
	      <td width="30%"><?php echo $item['nombre'] ?></td>
	      <td width="30%"><?php echo $item['nrodoc'] ?></td>
	      <td width="10%">
			<form action="<?php echo url_for('profesores/registrar') ?>" method="post">
				<input type="hidden" name="addfacultad" value="<?php echo $idfacultad; ?>">
				<input type="hidden" name="idpersona" value="<?php echo $item['idpersona']; ?>">
				<input type="submit" value="Registrar" title="Registrar" id="Registrar">
			</form>
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
<?php } ?> 		
</div>
