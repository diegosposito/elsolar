<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('personas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idpersona='.$form->getObject()->getIdpersona() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>><?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div align="left">
  <table style="width:400px" cellpadding="0" cellspacing="0"  class="stats" >
    <tfoot>
      <tr align="left">
        <td colspan="6">
          &nbsp;<a href="<?php echo url_for('personas/buscar') ?>">Volver al listado</a>
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
          <?php echo $form->renderGlobalErrors() ?>
        <tr>
        <th align="center" colspan=4><?php echo ''.'D A T O S &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P E R S O N A L E S ' ?></th>
        </tr>  
        <tr>
        <td colspan="4"><?php echo "<b> (*) Datos Obligatorios </b>" ?></td>
        </tr>
        <tr>
          <td width="10%">
            <?php echo "<p align='left'><b>Nombre(*)</b></p>" ?>
          </td>
          <td>
            <?php echo $form['nombre']->render() ?>
          </td>
           <td rowspan="4" width="10%">
          </td>
           <td rowspan="4" width="10%">
            <?php if ($form->getObject()->isNew()){ ?>
            <img style="align:center; width: 180px; height: 180px;" align='center' size='20' />
            <?php } else { ?>
            <img style="align:center; width: 180px; height: 180px;" src='<?php echo $sf_request->getRelativeUrlRoot();?>/files/personal/<?php echo $form->getObject()->getIdpersona() ?>/<?php echo $persona->getImagefile() ?>' align='center' size='20' />
            <?php } ?>
          </td>
        </tr>  
        <tr>
          <td width="10%">
            <?php echo "<p align='left'><b>Apellido(*)</b></p>" ?>
          </td>
          <td>
            <?php echo $form['apellido']->render() ?>
          </td>
        </tr>  
        <tr>
          <td width="10%">
            <?php echo "<p align='left'><b>Documento(*)</b></p>" ?>
          </td>
          <td>
            <?php echo $form['nrodoc']->render() ?>
          </td>
        </tr> 
       
        <tr>
          <td width="10%">
            <?php echo "<b>".$form['fechanac']->renderLabel()."</b>" ?>
          </td>
          <td>
            <?php echo $form['fechanac']->render() ?>
          </td>
        </tr>
       <tr>
          <td width="10%">
            <?php echo "<b>".$form['fechaingreso']->renderLabel()."</b>" ?>
          </td>
          <td>
            <?php echo $form['fechaingreso']->render() ?>
          </td>
        </tr>       
      <tr>
        <td><?php echo "<b>".$form['idsexo']->renderLabel()."</b>" ?></td>
        <td><?php echo $form['idsexo'] ?></td>
        <td align="left"><?php echo "<b>".$form['estadocivil']->renderLabel()."</b>" ?></td>
        <td align="left"><?php echo $form['estadocivil'] ?></td>
      </tr>  
      <tr>
        <td colspan="1"><?php echo "<b>".$form['direccion']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['direccion'] ?></td>
      </tr>  
       <tr>
        <td colspan="1"><?php echo "<b>".$form['ciudad']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['ciudad'] ?></td>
      </tr> 
       <tr>
        <td colspan="1"><?php echo "<b>".$form['idarea']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['idarea'] ?></td>
      </tr> 
       <tr>
        <td colspan="1"><?php echo "<b>".$form['activo']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['activo'] ?></td>
      </tr> 
    
     
      <tr>
        <th align="center" colspan=4><?php echo ''.'D A T O S &nbsp;&nbsp;&nbsp;C O N T A C T O ' ?></th>
      </tr>
       <tr>
        <td><?php echo "<b>".$form['email']->renderLabel()."</b>" ?></td>
        <td><?php echo $form['email'] ?></td>
        <td align="left"><?php echo "<b>".$form['celular']->renderLabel()."</b>" ?></td>
        <td align="left"><?php echo $form['celular'] ?></td>
      </tr> 
       <tr>
        <td><?php echo "<b>".$form['telefono']->renderLabel()."</b>" ?></td>
        <td><?php echo $form['telefono'] ?></td>
        <td align="left"><?php echo '' ?></td>
        <td align="left"><?php echo '' ?></td>
      </tr> 
      <tr>
      </tr>
      <tr>
        <th align="center" colspan=4><?php echo ''.'F O T O &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></th>
      </tr>
      <tr>
        <td align="left"><?php echo "<b>".$form['imagefile']->renderLabel()."</b>" ?></td>
        <td  colspan="3" align="left"><?php echo $form['imagefile'] ?></td>
      </tr>  
                
    </tbody>
  </table>
  </div>
</form>
