<script>

$(document).ready(function(){

    $("#inicio").datepicker();
    $("#fin").datepicker();
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('personas/obtenerrecibosporestado'); ?>",
          { seleccionar: $("#seleccionar").val(), seleccionar2: $("#seleccionar2").val(), inicio: $("#inicio").val(), fin: $("#fin").val()},
        function(data){
            $('#idresultados').html(data);
        }
        );
    }); 

});    

</script>
<br>
<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>

</br>
<h3 align="center">Gestión de Recibos </h3>
<h4>Observaciones: </h4>
<h5>Se pueden desmarcar registros que se considere no deberían generarse para este mes, por el motivo que corresponda. </h5>

<form action="<?php echo url_for('personas/imprimirrecibosseleccionados') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tr>
    <td colspan="2" width="10%"><b>Seleccionar Estado:</b></td>
    <td>
    <?php
      //el bucle para cargar las opciones
      echo "<select id='seleccionar' name='seleccionar' >";
      
      foreach ($estados as $k => $v){
        echo "<option value=".$k.">".$v."</option>";
      }
      echo "</select>";
    ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" width="10%"><b>Seleccionar Cobrador:</b></td>
    <td>
    <?php
       echo "<select id='seleccionar2' name='seleccionar2' >";
       echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
       foreach ($cobradores as $cobrador){
          echo "<option value=".$cobrador["idpersona"].">".$cobrador["nombrecompleto"]."</option>";
       }
       echo "</select>";
     ?>
    </td>
  </tr> 

  <tr>
  <td colspan="2" width="10%"><b>Fecha Desde:</b></td>
  <td><input type="text" name="inicio" id="inicio"></td>
</tr>
<tr>
  <td colspan="2" width="10%"><b>Fecha Hasta:</b></td>
  <td><input type="text" name="fin" id="fin"></td>
</tr>
    
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar recibos" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Imprimir Selección" id="botonimprimir" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>
</div><br>

