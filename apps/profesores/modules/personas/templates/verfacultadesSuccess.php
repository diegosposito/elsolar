<br>
<h1>Seleccionar facultad</h1>
<br>

<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="5%">Id</th>
      <td class="hed" align="center" width="40%">Apellido</th>
      <td class="hed" align="center" width="30%">Nombre</th>
      <td class="hed" align="center" width="15%">Nro.Doc.</th>
    </tr>
    <tr>
      <td align="center"><?php echo $oPersona->getIdPersona(); ?></td>
      <td align="left"><?php echo $oPersona->getApellido(); ?></td>
      <td align="left"><?php echo $oPersona->getNombre(); ?></td>
      <td align="center"><?php echo $oPersona->getNrodoc(); ?></td>
    </tr>
   </table>

  <br>
  <div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
  <?php if (count($facultades) == 0){ ?>
  <div align="left"><p style="color:red"><b> <?php echo 'La persona no tiene m&aacutes facultades para asociar en esta &aacuterea.' ?> </b></p></div>
  <?php } ?>

<form action="<?php echo url_for('personas/agregarprofesor') ?>" method="post" id="formDesignar">
<input type="hidden" id="idpersona" name="idpersona" value="<?php echo $idpersona; ?>">
  <table cellspacing="0" class="stats" width="100%">
    <?php if (count($facultades) > 0){ ?> 
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <input type="submit" value="Crear Profesor" id="botonDesignar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
       <tr><td>Facultad:</td>
       <td><select id="idfacultad" name="idfacultad">
        <?php foreach ($facultades as $facultad) { ?>
            <option value="<?php echo $facultad['idfacultad'] ?>"> <?php echo $facultad['nombre'] ?></option>
        <?php } ?>
      </select>        
      </td></tr> 
       <tr>
      <td> Legajo: </td>
       <td><input type="text" name="legajo" id="legajo" size="20">
      </td>
      </tr>
    </tbody>  
    <?php } ?>    
  </table>
</form>
</div><br>