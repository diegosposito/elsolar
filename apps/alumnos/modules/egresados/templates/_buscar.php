<div align="center">
<form action="<?php echo url_for('egresados/buscar') ?>" method="post">
  <table cellspacing="0" class="stats" width="60%">
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>
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
	      <td width="35%" align="center" class="hed">Persona</td>
	      <td width="20%" align="center" class="hed">Nro. de Documento</td>
	      <td width="5%" align="center" class="hed">Sexo</td>
	      <td width="35%" align="center" class="hed">Acciones</td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="5%" align="center"><?php echo $item['idpersona'] ?></td>
	      <td width="35%"><?php echo $item['nombre'] ?></td>
	      <td width="20%" align="center"><?php echo $item['nrodoc'] ?></td>
	      <td width="5%" align="center"><?php echo (($item['idsexo']==1) ? "M":"F") ?></td>
	      <td width="35%" align="center">
	      	<input type="button" value="Asociar a Carrera" onclick="location.href='<?php echo url_for('egresados/agregaralumno?idpersona='.$item['idpersona']) ?>'">
			<input type="button" value="Registrar Egresado" onclick="location.href='<?php echo url_for('egresados/vercarreras?idpersona='.$item['idpersona']) ?>'">	
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
<?php } ?> 		
</div>