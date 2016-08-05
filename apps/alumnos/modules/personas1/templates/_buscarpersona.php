<h1>Buscador</h1> 
<br>
<div align="center">
<form action="<?php echo url_for('personas/buscarpersonasadministratiavas') ?>" method="post">
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
	      <td colspan="6" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
	    </tr>
	    <tr>
	      <td width="5%" align="center" class="hed">Id</td>
	      <td width="5%" align="center" class="hed">Legajo</td>
	      <td width="45%" align="center" class="hed">Alumno</td>
	      <td width="15%" align="center" class="hed">Ciclo Lectivo</td>
	      <td width="30%" align="center" class="hed">Nro. de Documento</td>
	      <td width="10%" align="center" class="hed"></td>
	    </tr>
	  </thead>
	  <tbody>
            <?php $i=0; ?>
	    <?php foreach($resultado as $item){ ?>
	    <tr class="fila_<?php echo $i%2 ; ?>">
	      <td width="5%" align="center"><?php echo $item['idalumno'] ?></td>
	      <td width="5%" align="center"><?php echo $item['legajo'] ?></td>
	      <td width="45%"><?php echo $item['apellido'].", ".$item['nombre'] ?></td>
	      <td width="15%" align="center"><?php echo $item['ciclo'] ?></td>
	      <td width="30%" align="center"><?php echo $item['nrodoc'] ?></td>
	      <td width="10%" align="center">
			<form name="form_<?php echo $form->getValue('idplanestudio'); ?>" method="post" action="<?php echo url_for($form->getValue('url')) ?>">  
				<input type="hidden" name="idplanestudio" value="<?php echo $form->getValue('idplanestudio'); ?>">
				<input type="hidden" name="idalumno" value="<?php echo $item['idalumno']; ?>">
				<input type="hidden" name="idpersona" value="<?php echo $item['idpersona']; ?>">
				<input type="submit" value="<?php echo $titulo; ?>" title="<?php echo $titulo; ?>" id="Ver">
			</form>
	      </td>
	    </tr>
            <?php $i++; ?>
	    <?php } ?>
	  </tbody>
	</table>
	<br>
<?php } ?> 		
</div>
