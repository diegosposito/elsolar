<td>
  <ul class="sf_admin_td_actions">
 <? if ($ficha_carga->getTransferido()!=true) { ?>
    <?php echo $helper->linkToEdit($ficha_carga, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($ficha_carga, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<? } ?>
  </ul>
</td>
