<script>
window.onload = function() {
  document.getElementById("display").focus();
};
</script>
<br/>
<h1 align="center">Registrar Salida</h1>
<a id="ver" name="ver"></a>
<form name="calc" id="calc" action="<?php echo url_for('horarios/registro') ?>" method="post">
<input type="hidden" id="registro" name="registro" value="S">
<div id="contenido" align="center" >
<table style="width:200px;" border=1>
<tr>
<td colspan=2><input style="width: 185px; height: 70px;font-weight: bold;font-size: 32px;" type=text id="display" name="display" size="12"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;background:#f79de7;" type=button value="Borrar" OnClick="calc.display.value=''"></td>
</tr>
<tr>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="0" OnClick="calc.display.value+='0'"></td>
<td ><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="1" OnClick="calc.display.value+='1'"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="2" OnClick="calc.display.value+='2'"></td>
</tr>
<tr>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="3" OnClick="calc.display.value+='3'"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="4" OnClick="calc.display.value+='4'"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="5" OnClick="calc.display.value+='5'"></td>
</tr>
<tr>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="6" OnClick="calc.display.value+='6'"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="7" OnClick="calc.display.value+='7'"></td>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="8" OnClick="calc.display.value+='8'"></td>
</tr>
<tr>
<td><input style="height: 70px;width: 90px;font-size: 18px;" type=button value="9" OnClick="calc.display.value+='9'"></td>
<td colspan=2><input style="background:#f79de7;height: 70px;width: 185px;font-size: 18px;" type=submit value="Registrar"></td>
</tr>
</table>
</div>
</form>