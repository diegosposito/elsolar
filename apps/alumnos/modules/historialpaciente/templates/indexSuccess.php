  <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
    a.tooltip {outline:none; }

    a.tooltip strong {line-height:30px;}
    a.tooltip:hover {text-decoration:none;} 
    a.tooltip span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:315px; line-height:16px;
    }
    a.tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
        
    /*CSS3 extras*/
    a.tooltip span
    {
        border-radius:4px;
        box-shadow: 5px 5px 8px #CCC;
    }
  </style>
 <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Historial Paciente</h1>
<br>
<div align="center">
<a href="<?php echo url_for('historialpaciente/new') ?>">Agregar Historial</a>

<?php if (count($historialpacientes) > 0){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="6" width="100%">Se han encontrado <?php echo count($historialpacientes); ?> coincidencias de la búsqueda.</td>
      </tr>
      <tr>
        <td width="40%" align="center" class="hed">Detalle</td>
        <td width="40%" align="center" class="hed">Profesionales</td>
        <td width="10%" align="center" class="hed">Fecha</td>
        <td width="5%" align="center" class="hed">Edicion</td>
        <td width="5%" align="center" class="hed">Eliminar</td>
      </tr>
    </thead>
    <tbody>
            <?php $i=0; ?>
      <?php foreach($historialpacientes as $historialpaciente){ ?>
      <tr class="fila_<?php echo $i%2 ; ?>">
      <td width="40%" align="left"><a href="#" class="tooltip"><div style="align: left;"><?php echo substr($historialpaciente->getDetalle(), 0, 25);  ?><span>
        <strong><?php echo "Fecha : ".date("d/m/Y", strtotime($historialpaciente->getFecha())) ?></strong><br>
        <?php echo htmlspecialchars_decode($historialpaciente->getDetalle()) ?></span></div"></a>
      </td>

        <td width="20%" align="center"><?php echo $historialpaciente->getProfesionales() ?></td>
        <td width="20%" align="center"><?php echo date("d/m/Y", strtotime($historialpaciente->getFecha())) ?></td>
        <td align="center"><?php echo link_to("Editar", 'historialpaciente/edit?id='.$historialpaciente->getId() ,'class="mhead"'); ?></td>
         <td align="center"><?php echo link_to('Eliminar', 'historialpaciente/delete?id='.$historialpaciente->getId(), array('method' => 'delete', 'confirm' => 'Estas seguro que desea borrar el historial del Paciente?')) ?>
      </tr>
            <?php $i++; ?>
      <?php } ?>

      <br>
  
  <br><br>
    </tbody>
  </table>
  <br>
<?php } ?>  
</div>