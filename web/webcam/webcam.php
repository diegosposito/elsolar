<!doctype html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>Sistema de Alumnos</title>
  <script type="text/javascript" src="webcam.js"></script>
</head>
<body>
<div id='camara'>
  <script language="JavaScript">
    webcam.set_api_url('../alumnos.php/aspirante/guardarfotografia/idpersona/<?php echo $_GET['idpersona']?>');
    webcam.set_swf_url('webcam.swf');
    webcam.set_quality(90); // JPEG quality (1 - 100)
    webcam.set_shutter_sound(true); // play shutter click sound
    webcam.shutter_url = 'shutter.mp3';
    webcam.set_hook("onLoad", null);
    webcam.set_hook("onComplete", 'camMensaje');
    webcam.set_hook("onError", null);
    document.write(webcam.get_html(320, 240));
    
    function camMensaje(response) {
        alert(response);
        window.close();
    }
    function camGrabar(){
      webcam.reset();
      webcam.freeze();
      document.getElementById('btnGrabar').style.display = 'none';
      document.getElementById('btnCancelar').style.display = '';
      document.getElementById('btnGuardar').style.display = '';
    }
    function camCancelar(){
      webcam.reset();
      document.getElementById('btnGrabar').style.display = '';
      document.getElementById('btnCancelar').style.display = 'none';
      document.getElementById('btnGuardar').style.display = 'none';
    }
    function camGuardar(){
      webcam.upload();
    }   
  </script>
</div>
<p>
  <button onclick="camGrabar(); return false;" id='btnGrabar'>Grabar</button>
  <button onclick="camCancelar(); return false;" id='btnCancelar' style='display:none'>Cancelar</button>
  <button onclick="camGuardar(); return false" id='btnGuardar' style='display:none'>Guardar</button>
</p>
</body>
</html> 
