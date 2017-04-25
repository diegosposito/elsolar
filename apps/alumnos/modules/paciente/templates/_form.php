<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('paciente/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div align="left">
  <table style="width:400px" cellpadding="0" cellspacing="0"  class="stats" >
    <tfoot>
      <tr align="left">
        <td colspan="6">
          &nbsp;<a href="<?php echo url_for('paciente/index') ?>">Volver al listado</a>
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
          <td width="10%">
            <?php echo "<b>".$form['nombre']->renderLabel()."</b>" ?>
          </td>
          <td>
            <?php echo $form['nombre']->render() ?>
          </td>
          <td rowspan="5" width="10%">
          </td>
           <td rowspan="5" width="10%">
            <?php if ($form->getObject()->isNew()){ ?>
            <img style="align:center; width: 180px; height: 180px;" align='center' size='20' />
            <?php } else { ?>
            <img style="align:center; width: 180px; height: 180px;" src='<?php echo $sf_request->getRelativeUrlRoot();?>/files/paciente/<?php echo $form->getObject()->getId() ?>/<?php echo $paciente->getImagefile() ?>' align='center' size='20' />
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td width="10%">
            <?php echo "<b>".$form['apellido']->renderLabel()."</b>" ?>
          </td>
          <td>
            <?php echo $form['apellido']->render() ?>
          </td>
        </tr>
        <tr>
          <td width="10%">
            <?php echo "<b>".$form['nrodoc']->renderLabel()."</b>" ?>
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
        <td colspan="1"><?php echo "<b>".$form['idsexo']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['idsexo'] ?></td>
      </tr>
       <tr>
        <td colspan="1"><?php echo "<b>".$form['estadocivil']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['estadocivil'] ?></td>
      </tr>
      <tr>
        <td colspan="1"><?php echo "<b>".$form['direccion']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['direccion'] ?></td>
      </tr>
       <tr>
        <td colspan="1"><?php echo "<b>".$form['idprovincia']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['idprovincia'] ?></td>
      </tr>
       <tr>
        <td colspan="1"><?php echo "<b>".$form['idciudadnac']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['idciudadnac'] ?></td>
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
        <th align="center" colspan=4><?php echo '_' ?></th>
      </tr>
      <tr>
        <th align="center" colspan=4><?php echo ''.'O B R A &nbsp;&nbsp;&nbsp;S O C I A L ' ?></th>
      </tr>
      <tr>
        <td align="left" colspan=4><b><label id="osdescripcion" name="osdescripcion" for="osdescripcion">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></b></td>
      </tr>
      <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['idobrasocial']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['idobrasocial'] ?>
          </td>
        </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['nroafiliado']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['nroafiliado']->render() ?>
          </td>
        </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['titular']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['titular']->render() ?>
          </td>
        </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['parentesco']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['parentesco']->render() ?>
          </td>
        </tr>
        <tr>
        <td colspan="1"><?php echo "<b>".$form['anotaciones']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['anotaciones'] ?></td>
      </tr>
       <tr>
        <td colspan="1"><?php echo "<b>".$form['historial']->renderLabel()."</b>" ?></td>
        <td colspan="3"><?php echo $form['historial'] ?></td>
      </tr>

       <tr>
        <td align="left"><?php echo "<b>".$form['imagefile']->renderLabel()."</b>" ?></td>
        <td  colspan="3" align="left"><?php echo $form['imagefile'] ?></td>
      </tr>

      <tr>
        <th align="center" colspan=4><?php echo '_' ?></th>
      </tr>
      <tr>
        <th align="center" colspan=4><?php echo ''.'D A T O S &nbsp;&nbsp;&nbsp;M A D R E / A P O D E R A D O ' ?></th>
      </tr>
      <tr>
        <td align="left" colspan=4><b><label id="osdescripcion" name="osdescripcion" for="osdescripcion">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></b></td>
      </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['mamnombre']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['mamnombre']->render() ?>
          </td>
        </tr>
        <tr>
          <td width="10%">
            <?php echo "<b>".$form['mamfechanac']->renderLabel()."</b>" ?>
          </td>
          <td>
            <?php echo $form['mamfechanac']->render() ?>
          </td>
        </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['mamnrodoc']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['mamnrodoc']->render() ?>
          </td>
        </tr>
        <tr>
          <td colspan="1" width="10%">
            <?php echo "<b>".$form['mamnacionalidad']->renderLabel()."</b>" ?>
          </td>
          <td colspan="3">
            <?php echo $form['mamnacionalidad']->render() ?>
          </td>
        </tr>
        <tr>
         <td colspan="1"><?php echo "<b>".$form['mamestudios']->renderLabel()."</b>" ?></td>
         <td colspan="3"><?php echo $form['mamestudios'] ?></td>
       </tr>
       <tr>
         <td colspan="1" width="10%">
           <?php echo "<b>".$form['mamdireccion']->renderLabel()."</b>" ?>
         </td>
         <td colspan="3">
           <?php echo $form['mamdireccion']->render() ?>
         </td>
       </tr>
       <tr>
         <th align="center" colspan=4><?php echo '_' ?></th>
       </tr>
        <tr>
          <th align="center" colspan=4><?php echo ''.'D A T O S &nbsp;&nbsp;&nbsp;P A D R E / F A M I L I A R ' ?></th>
        </tr>
        <tr>
          <td align="left" colspan=4><b><label id="osdescripcion" name="osdescripcion" for="osdescripcion">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></b></td>
        </tr>
          <tr>
            <td colspan="1" width="10%">
              <?php echo "<b>".$form['papnombre']->renderLabel()."</b>" ?>
            </td>
            <td colspan="3">
              <?php echo $form['papnombre']->render() ?>
            </td>
          </tr>
          <tr>
            <td width="10%">
              <?php echo "<b>".$form['papfechanac']->renderLabel()."</b>" ?>
            </td>
            <td>
              <?php echo $form['papfechanac']->render() ?>
            </td>
          </tr>
          <tr>
            <td colspan="1" width="10%">
              <?php echo "<b>".$form['papnrodoc']->renderLabel()."</b>" ?>
            </td>
            <td colspan="3">
              <?php echo $form['papnrodoc']->render() ?>
            </td>
          </tr>
          <tr>
            <td colspan="1" width="10%">
              <?php echo "<b>".$form['papnacionalidad']->renderLabel()."</b>" ?>
            </td>
            <td colspan="3">
              <?php echo $form['papnacionalidad']->render() ?>
            </td>
          </tr>
          <tr>
           <td colspan="1"><?php echo "<b>".$form['papestudios']->renderLabel()."</b>" ?></td>
           <td colspan="3"><?php echo $form['papestudios'] ?></td>
         </tr>
         <tr>
           <td colspan="1" width="10%">
             <?php echo "<b>".$form['papdireccion']->renderLabel()."</b>" ?>
           </td>
           <td colspan="3">
             <?php echo $form['papdireccion']->render() ?>
           </td>
         </tr>


    </tbody>
  </table>
  </div>
</form>
