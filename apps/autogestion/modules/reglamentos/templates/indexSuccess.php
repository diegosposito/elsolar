<?php
        $contador_facultad=0;
foreach($oAlumnos as $alumno){
	//echo $alumno->getPlanesEstudios();

	if($alumno->getPlanesEstudios()->getCarreras()->getIdfacultad()==3){
		$contador_facultad++;
		if($contador_facultad==1){
			echo '<br><h1 class="entry-title">Reglamentos</h1>';

			echo'<br><p><img class="wp-image-3982 alignleft" src="http://fca.ucu.edu.ar/wp-content/uploads/2009/02/tilde3.png" alt="tilde3" width="31" height="27" /><a href="http://fca.ucu.edu.ar/wp-content/plugins/downloads-manager/upload/Reglamento%2009%20-%20Del%20Alumno%20Libre.pdf"   target="_blank">Reglamento 09 &#8211; <strong>Del Alumno Libre</strong></a></p>
			';

			echo'<br><img class="wp-image-3982 alignleft" src="http://fca.ucu.edu.ar/wp-content/uploads/2009/02/tilde3.png" alt="tilde3" width="31" height="27" /><a href="http://fca.ucu.edu.ar/wp-content/plugins/downloads-manager/upload/Reglamento%2010%20-%20Tesinas%20de%20Grado.pdf" target="_blank">Reglamento 10 &#8211; <strong>Tesinas de Grado</strong></a></p>
			';
		};

		};
	if($alumno->getPlanesEstudios()->getCarreras()->getIdfacultad()==5){
		$contador_facultad++;
		if($contador_facultad==1){
		echo '<br><h1 class="entry-title">Planes de Estudios</h1>';

		echo'<br><p><img class="wp-image-3982 alignleft" src="http://fca.ucu.edu.ar/wp-content/uploads/2009/02/tilde3.png" alt="tilde3" width="31" height="27" /><a href="http://www.ucu.edu.ar/images/docs/informacion_arquitectura.pdf"   target="_blank">Arquitectura <strong></strong></a></p>
		';

		echo'<br><img class="wp-image-3982 alignleft" src="http://fca.ucu.edu.ar/wp-content/uploads/2009/02/tilde3.png" alt="tilde3" width="31" height="27" /><a href="http://www.ucu.edu.ar/images/docs/informacion_licenciatura_diseno_de_interiores.pdf" target="_blank">Lic. en Diseño de Interiores </a></p>
		';

		};

	};
};
?>
