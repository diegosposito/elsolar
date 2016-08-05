<br>
<div align="center">
<form action="<?php echo url_for('empleados/buscarpersona') ?>" method="post">
  <table cellspacing="0" class="stats" width="60%">
      <?php echo $form->renderGlobalErrors() ?> 
      <tr>
        <td><b><?php echo $form['tipocriterio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['tipocriterio']->renderError() ?>
          <?php echo $form['tipocriterio'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['criterio']->renderLabel() ?></td>
        <td>
          <?php echo $form['criterio']->renderError() ?>
          <?php echo $form['criterio'] ?>
        </td>
      </tr>  
	<tr>
		<?php echo $form->renderHiddenFields(false) ?>
		<td colspan="2" align="center"><input type="submit" value="Buscar" /></td>
    </tr>    
  </table>
</form>

<br>
<?php if (count($resultado) > 0){ ?>		    	   	
	<table cellspacing="0" class="stats">
	    <tr>
	      <td colspan="5" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
	    </tr>
	    <tr>
	      <td width="5%" align="center" class="hed">Id</td>
	      <td width="50%" align="center" class="hed">Persona</td>
	      <td width="20%" align="center" class="hed">Nro. de Documento</td>
	      <td width="25%" align="center" class="hed"></td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="5%"><?php echo $item['idpersona'] ?></td>
	      <td width="50%"><?php echo $item['apellido'].", ".$item['nombre'] ?></td>
	      <td width="20%" align="center"><?php echo $item['nrodoc'] ?></td>
	      <td width="25%" align="center">
	      <input type="button" value="Editar" onclick="location.href='<?php echo url_for('personas/modificar?idpersona='.$item['idpersona']) ?>'">
	      <input type="button" value="Agregar" onclick="location.href='<?php echo url_for('empleados/new?idpersona='.$item['idpersona']) ?>'">
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
	<br>
<?php } ?> 		
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('empleados/index') ?>'"></p>
<br>