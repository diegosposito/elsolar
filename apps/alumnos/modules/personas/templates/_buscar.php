<br>
<div align="center">
<form action="<?php echo url_for('personas/buscar') ?>" method="post">
  <table cellspacing="0" class="stats" width="80%">
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
<?php if ($habilitado_edicion){ ?>
<a href="<?php echo url_for('personas/new') ?>">Agregar Nuevo Personal</a>
<?php } ?>

<?php if (count($resultado) > 0){ ?>		    	   	
	<table cellspacing="0" class="stats">
	    <tr>
	      <td colspan="6" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
	    </tr>
	    <tr>
	      <td width="40%" align="center" class="hed">Nombre</td>
	      <td width="20%" align="center" class="hed">Usuario</td>
	      <td width="20%" align="center" class="hed">Nro. de Documento</td>
	      <td width="20%" align="center" class="hed">Edicion</td>
	    </tr>
	  </thead>
	  <tbody>
            <?php $i=0; ?>
	    <?php foreach($resultado as $item){ ?>
	    <tr class="fila_<?php echo $i%2 ; ?>">
	    <td width="40%" align="left"><a href="#" title="<?php echo $item['horarios'] ?>"> <?php echo $item['apellido'].', '.$item['nombre'] ?> </a></td>
	      <td width="20%" align="center"><?php echo $item['username'] ?></td>
	      <td width="20%" align="center"><?php echo $item['nrodoc'] ?></td>
	      <?php if ($habilitado_edicion){ ?>
	      <td align="center"><?php echo link_to("Editar", 'personas/edit?idpersona='.$item['idpersona'] ,'class="mhead"'); ?></td>
	      <?php } else { ?>
          <td align="center"><?php echo link_to("Visualizar", 'personas/show?id='.$item['idpersona'] ,'class="mhead"'); ?></td>
	      <?php } ?>
	    </tr>
            <?php $i++; ?>
	    <?php } ?>

	    <br>
  
  <br><br>
	  </tbody>
	</table>
	<br>
<?php } ?> 		
</div>
