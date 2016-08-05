<h1>Buscador</h1> 
<br>
<div align="center">
<form action="<?php echo url_for('inscripciones/inscribirmateriaspreuniversitario') ?>" method="post">
  <table cellspacing="0" class="stats" width="80%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
        	<?php echo $form->renderHiddenFields(false) ?>
        	<input type="submit" value="Buscar" />
        </td>
      </tr>
    </tfoot>    
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="35%"><b><?php echo $form['idplanestudio']->renderLabel() ?></b></td>
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
        <td><b><?php echo $form['criterio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['criterio']->renderError() ?>
          <?php echo $form['criterio'] ?>
        </td>
      </tr>  
      <tr>
        <td><b><?php echo $form['idciclolectivo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idciclolectivo']->renderError() ?>
          <?php echo $form['idciclolectivo'] ?>
        </td>
      </tr>        
    </tbody>
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
	      <td width="50%" align="center" class="hed">Alumno</td>
	      <td width="5%" align="center" class="hed">Fecha de Ingreso</td>
	      <td width="30%" align="center" class="hed">Nro. de Documento</td>
	      <td width="10%" align="center" class="hed"></td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($resultado as $item){ ?>
	    <tr>
	      <td width="5%"><?php echo $item['idalumno'] ?></td>
	      <td width="50%"><?php echo $item['apellido'].", ".$item['nombre'] ?></td>
	      <td width="5%" align="center"><?php echo $item['fechaingreso'] ?></td>
	      <td width="30%" align="center"><?php echo $item['nrodoc'] ?></td>
	      <td width="10%" align="center">
			<form name="form_<?php echo $form->getValue('carrera'); ?>" method="post" action="<?php echo url_for('inscripciones/obtenermateriaspreuniversitario') ?>">  
				<input type="hidden" name="idplanestudio" value="<?php echo $item['idplanestudio']; ?>">
				<input type="hidden" name="idalumno" value="<?php echo $item['idalumno']; ?>">
				<input type="hidden" name="idpersona" value="<?php echo $item['idpersona']; ?>">
				<input type="submit" value="Ver" title="Ver" id="Ver">
			</form>
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
	<br>
<?php } ?> 		
</div>