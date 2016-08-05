<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('carrerassede/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'carrerassede/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="33%"><?php echo $form['idsede']->renderLabel() ?></td>
        <td>
          <?php echo $form['idsede']->renderError() ?>
          <?php echo $form['idsede'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['exploratoria']->renderLabel() ?></td>
        <td>
          <?php echo $form['exploratoria']->renderError() ?>
          <?php echo $form['exploratoria'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['plazocerttittramite']->renderLabel() ?></td>
        <td>
          <?php echo $form['plazocerttittramite']->renderError() ?>
          <?php echo $form['plazocerttittramite'] ?>
        </td>
      </tr>   
      <tr>
        <td><?php echo $form['entregaencuesta']->renderLabel() ?></td>
        <td>
          <?php echo $form['entregaencuesta']->renderError() ?>
          <?php echo $form['entregaencuesta'] ?>
        </td>
      </tr>   
      <tr>
        <td><?php echo $form['vigente']->renderLabel() ?></td>
        <td>
          <?php echo $form['vigente']->renderError() ?>
          <?php echo $form['vigente'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['plazoborradoexamen']->renderLabel() ?></td>
        <td>
          <?php echo $form['plazoborradoexamen']->renderError() ?>
          <?php echo $form['plazoborradoexamen'] ?>
        </td>
      </tr>       
      <tr>
        <td><?php echo $form['permiterevalida']->renderLabel() ?></td>
        <td>
          <?php echo $form['permiterevalida']->renderError() ?>
          <?php echo $form['permiterevalida'] ?>
        </td>
      </tr>              
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('carrerassede/index?idcarrera='.$idcarrera) ?>'"></p>
<br>