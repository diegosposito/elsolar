<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="center">
<form action="<?php echo url_for('personas/registrarpersona') ?>" method="post">
  <table cellspacing="0" class="stats" width="60%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Aceptar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
    <?php if ($mensaje) {?>
      <tr>
        <td colspan="2" align="center">
          <b><font color="red"><div id="mensaje"><?php echo $mensaje; ?></div></font></b>
        </td>
      </tr>  
     <?php } ?>
      <?php echo $form->renderGlobalErrors() ?>


      <tr>
        <td><b><?php echo $form['apellido']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['apellido']->renderError() ?>
          <?php echo $form['apellido'] ?>
        </td>
      </tr>  
    </tbody>
  </table>
</form>
</div>

<br>
<br>
<?php if (count($resultado) > 0){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="6" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
      </tr>
      <tr>
        <td width="5%" align="center" class="hed">Id</td>
        <td width="45%" align="center" class="hed">Persona</td>
        <td width="30%" align="center" class="hed">Nro. de Documento</td>
        <td width="10%" align="center" class="hed"></td>
      </tr>
    </thead>
    <tbody>
            <?php $i=0; ?>
      <?php foreach($resultado as $item){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
        <td width="10%" align="center"><?php echo $item['idpersona'] ?></td>
        <td width="50%"><?php echo $item['nombre'] ?></td>
        <td width="30%" align="center"><?php echo $item['nrodoc'] ?></td>
        <td width="10%" align="center">
      <form name="form_<?php echo $item['idpersona']; ?>" method="post" action="<?php echo url_for('personas/modificarregistro') ?>">  
        <input type="hidden" name="idpersona" value="<?php echo $item['idpersona']; ?>">
        <input type="submit" value="Modificar" title="Modificar" id="Ver">
      </form>
        </td>
      </tr>
            <?php $i++; ?>
      <?php } ?>
    </tbody>
  </table>
  <br>
<?php } ?>

<?php if (count($resultado) == 0 && $isPost){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="6" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda <?php echo $form->getValue('criterio') ?> por <?php if($form->getValue('tipocriterio')==1){ echo "Apellido";} else {echo "Nro. Documento";} ?>.</td>
      </tr>
    </thead>
    <tbody>
      <form name="form_idpersona" method="post" action="<?php echo url_for('personas/modificarregistro') ?>">  
        <input type="hidden" name="idtipodocumento" id="idtipodocumento" value="<?php echo $idtipodocumento; ?>">
        <input type="hidden" name="nrodocumento" id="nrodocumento" value="<?php echo $nrodocumento; ?>">
        <input type="submit" value="Nueva Persona" title="Nueva Persona" id="Ver">
      </form>
    </tbody>
  </table>
  <br>
<?php } ?>
