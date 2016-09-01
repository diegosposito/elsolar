<h1>Comparativa de Ingresantes</h1>
<script>
  $(function() {
    $( "#fechaarancel" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#fechaultimoperiodo" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });

  $(function() {
    $( "input:submit, a, button", ".demo" ).button();  
  });
</script>
<p><b>Seleccionar 2 per&iacute;odos a comparar</b></p>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>

<form action="<?php echo url_for('obrassociales/guardar') ?>" method="post" id="formObraSocial">
<input type="hidden" id="idobrasocial" name="idobrasocial" value="<?php echo $idobrasocial; ?>">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="submit" value="Nuevo" id="botonObraSocial" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['denominacion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['denominacion']->renderError() ?>
          <?php echo $form['denominacion'] ?>
        </td>
      </tr>
      <tr>        
        <td><?php echo $form['fechaarancel']->renderLabel() ?></td>
        <td colspan="3">
           <input id="fechaarancel" name="fechaarancel" type="text">
        </td>
      </tr>  
          <?php echo $form['fechaarancel']->renderError() ?>
          <?php echo $form['fechaarancel'] ?>
        </td>
      </tr>
      <tr>        
        <td><?php echo $form['fechaultimoperiodo']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['fechaultimoperiodo']->renderError() ?>
          <?php echo $form['fechaultimoperiodo'] ?>
        </td>
      </tr>
    </tbody>      
  </table>
</form>
</div><br>
<div id="idmcatedra" align="center"></div>
<br>