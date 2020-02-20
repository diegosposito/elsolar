<style type="text/css">
    body {font-family: "Lato", sans-serif;}

	ul.tab {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    border: 1px solid #ccc;
	    background-color: #f1f1f1;
	}

	/* Float the list items side by side */
	ul.tab li {float: left;}

	/* Style the links inside the list items */
	ul.tab li a {
	    display: inline-block;
	    color: black;
	    text-align: center;
	    padding: 14px 16px;
	    text-decoration: none;
	    transition: 0.3s;
	    font-size: 17px;
	}

	/* Change background color of links on hover */
	ul.tab li a:hover {
	    background-color: #ddd;
	}

	/* Create an active/current tablink class */
	ul.tab li a:focus, .active {
	    background-color: #ccc;
	}

	/* Style the tab content */
	.tabcontent {
	    display: none;
	    padding: 6px 12px;
	    border: 1px solid #ccc;
	    border-top: none;
	}
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>

 <script>

  $(document).ready(function(){
 
    $('#paciente_idprovincia').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCiudades('#paciente_idciudadnac', $(this).val(), 0);
    }); 
    $('#paciente_idobrasocial').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboPlanes('#paciente_idplan', $(this).val(), 0);
        actualizarOS('#osdescripcion', $(this).val(), 0);
        actualizarFormato('#ostiponroafiliado', $(this).val(), 0);
    }); 

  });

    $('#paciente_idprovincia').click(function() {
		cargarComboCiudades('#paciente_idciudadnac', $(this).val(), 0);
   	}); 
   	$('#paciente_idobrasocial').click(function() {
		cargarComboPlanes('#paciente_idplan', $(this).val(), 0);
   	});      
    
	//Cargar combo de ciudades
	function cargarComboCiudades(combo, id, idseleccionado){
	    // cargar las ciudades de la carrera al combo
	    $.post("<?php echo url_for('provincias/obtenerciudades'); ?>",
	    { idprovincia: id },
	    function(data){
	      if (data){
	        $(combo).html(data);
	        $(combo).attr('disabled',false);
	        $(combo).val(idseleccionado);             
	      }else{
	        $(combo).attr('disabled',true);
	        $(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
	      }
	    }
	  );
	}

	//Cargar combo de ciudades
	function actualizarOS(combo, id, idseleccionado){
	    // cargar las ciudades de la carrera al combo
	    $.post("<?php echo url_for('obrassociales/obtenerinfo'); ?>",
	    { idobrasocial: id },
	    function(data){
	      if (data){
	        $(combo).html(data.replace(/\d+/g, ''));
	        $(combo).attr('disabled',false);
	     //   $(combo).val(idseleccionado);             
	      }else{
	        $(combo).attr('disabled',true);
	        $(combo).html("");
	      }
	    }
	  );
	}

	//Cargar combo de ciudades
	function actualizarFormato(combo, id, idseleccionado){
	    // cargar las ciudades de la carrera al combo
	    $.post("<?php echo url_for('obrassociales/obtenerformato'); ?>",
	    { idobrasocial: id },
	    function(data){
	      if (data){
	        $(combo).html(data.substr(3,100));
	        $(combo).attr('disabled',false);
	      //  $(combo).val(idseleccionado);             
	      }else{
	        $(combo).attr('disabled',true);
	        $(combo).html("");
	      }
	    }
	  );
	}


		//Cargar combo de planes de obras sociales
	function cargarComboPlanes(combo, id, idseleccionado){
	    // cargar las ciudades de la carrera al combo
	    $.post("<?php echo url_for('obrassociales/obtenerplanes'); ?>",
	    { idobrasocial: id },
	    function(data){
	      if (data){
	        $(combo).html(data);
	        $(combo).attr('disabled',false);
	        $(combo).val(idseleccionado);             
	      }else{
	        $(combo).attr('disabled',true);
	        $(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
	      }
	    }
	  );
	}

	function openCity(evt, cityName) {
	    var i, tabcontent, tablinks;
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }
	    document.getElementById(cityName).style.display = "block";
	    evt.currentTarget.className += " active";
	}

</script>

<br>
<h1 align="center" style="color:black;">Editar Pacientes</h1>
<br>

<ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Datos')">Datos Personales</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Documentacion')">Documentacion</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Historial')">Historial</a></li>
 </ul>

<div id="Datos" class="tabcontent">
<?php 
include_partial('form', array('form' => $form, 'paciente' => $paciente)) ?>
 </div>

<div id="Historial" class="tabcontent">
<?php 
include_partial('formhistorial', array('historialpacientes' => $historialpacientes, 'paciente' => $paciente)) ?>
 </div>

