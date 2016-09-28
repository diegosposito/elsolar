<br/>
<h1 align="center">Registrar Ingreso / Egreso</h1>
<br/>
<form name="calc" id="calc" action="<?php echo url_for('horarios/registro') ?>" method="post">
<div id="contenido" align="center" >
<table style="width:200px;" border=1>
<tr>
<td colspan=4><input style="height: 70px;font-weight: bold;font-size: 32px;" type=text Name="display" size="12"></td>
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
<td colspan=2><input style="height: 70px;width: 185px;font-size: 18px;" type=submit value="Registrar"></td>
</tr>
</table>
</div>
</form>