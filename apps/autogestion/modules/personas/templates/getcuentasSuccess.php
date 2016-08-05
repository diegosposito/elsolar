<br />
<h1>Datos Alumno</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['nombre'] ?><br /></p>

<br />
<p style="color:red; font-size:11px"><b>Atencion!! </b> Los saldos que figuran son a modo informativo y estan sujetos a modificaciones relacionadas con el atraso de cuotas, recargos, etc. al momento de abonar el arancel. </p>
<br />

<table width="50%" class="stats" cellspacing="0">
	<thead>
    	<tr>
     	 <td class="hed">Cuenta</td>
     	 <td class="hed">Codigo</td>
    	 <td class="hed">Saldo</td>
    	</tr>
 	 </thead>
<?php foreach ($cuentas as $cuenta) { ?>
	<tr>
      <td width="100px"><?php echo $cuenta['descripcion'] ?></td>
      <td width="30px"><?php echo $cuenta['codcar'] ?></td>
      <td width="30px"><?php echo "$".number_format($cuenta['saldo'], 2) ?></td>
	</tr>
<?php } ?>
</table>