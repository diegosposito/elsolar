<script>
$(document).ready(function(){
	$('#horainicio').timepicker({
		showOn: "button",
		button: '.ui-icon-clock'
	});
	$('#horafin').timepicker({
		showOn: "button",
		button: '.ui-icon-clock'
	});	
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['dia']->renderLabel() ?></th>
        <td>
          <?php echo $form['dia']->renderError() ?>
          <?php echo $form['dia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['horainicio']->renderLabel() ?></th>
        <td>
          <?php echo $form['horainicio']->renderError() ?>
          <?php echo $form['horainicio'] ?>
        </td>
      </tr>   
      <tr>
        <th><?php echo $form['horafin']->renderLabel() ?></th>
        <td>
          <?php echo $form['horafin']->renderError() ?>
          <?php echo $form['horafin'] ?>
        </td>
      </tr>           
      <tr>
        <th><?php echo $form['inicio']->renderLabel() ?></th>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fin']->renderLabel() ?></th>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>       
      <tr>
        <th><?php echo $form['idtipoclase']->renderLabel() ?></th>
        <td>
          <?php echo $form['idtipoclase']->renderError() ?>
          <?php echo $form['idtipoclase'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['periodicidad']->renderLabel() ?></th>
        <td>
          <?php echo $form['periodicidad']->renderError() ?>
          <?php echo $form['periodicidad'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
