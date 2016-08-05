<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>

</br>
<form action="<?php echo url_for('profesores/confirmarelevacion') ?>" method="post" id="formElevar">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <input type="submit" value="Elevar Designaciones" id="botonElevar" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div><br>

<?php if (count($resultado) > 0){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%"><b>Se han encontrado <?php echo count($resultado); ?> designaciones en estado inicial, listas para elevar.</b></td>
      </tr>
      <tr>
        <td width="10%" align="center" class="hed">Sede</td>
        <td width="15%" align="center" class="hed">Carrera-Plan</td>
        <td width="13%" align="center" class="hed">Profesor</td>
        <td width="13%" align="center" class="hed">Materia</td>
        <td width="9%" align="center" class="hed">Cargo docente</td>
        <td width="9%" align="center" class="hed">Inicio</td>
        <td width="9%" align="center" class="hed">Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
        <td width="5%" align="center" class="hed">Estado</td>
        
        <?php /*if ($item['idestadodesignacion']==1 || $item['idestadodesignacion']==3 ){ 
           if ($item['idsede'] == $idsede ){ ?>
              <td width="6%" align="center" class="hed"></td>
           <?php } ?>
           <td width="6%" align="center" class="hed"></td>
        <?php }*/ ?>
    </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td width="10%"><?php echo $item['sedeabv'] ?></td>
        <td width="15%"><?php echo $item['carreraplan'] ?></td>
        <td width="13%"><?php echo $item['persona'] ?></td>
        <td width="13%"><?php echo $item['materia'] ?></td>
        <td width="9%"><?php echo $item['tipo'].' ('.$item['categoria'].')' ?></td>
        <td width="9%"><?php echo $item['inicioformat'] ?></td>
        <td width="9%"><?php echo $item['finformat'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>
       
        <?php switch ($item['idestadodesignacion']) {
            case 1: ?>
                <td bgcolor="#D8D8D8" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 2: ?>
                <td bgcolor="#ACFA58" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 3: ?>
                <td bgcolor="#F7FE2E" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 4: ?>
                <td bgcolor="#848484" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;        
            case 5: ?>
                <td bgcolor="#088A08" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
        }
        ?>
        <?php /*if ($item['idestadodesignacion']==1 || $item['idestadodesignacion']==3 ){ 
         if ($item['idsede'] == $idsede ){ ?>
              <td width="6%" align="center"><?php echo button_to("Editar", 'profesores/edit?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
           <?php } ?>

            <td width="6%" align="center"><?php echo button_to("Eliminar", 'designaciones/deleteconfirmar?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
        <?php }*/ ?>
      
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?> 