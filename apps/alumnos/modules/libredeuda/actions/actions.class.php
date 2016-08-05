

<?php

/**
 * libredeuda actions.
 *
 * @package    sig
 * @subpackage libredeuda
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libredeudaActions extends sfActions
{
	/**
	* Executes index action
  	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->form = new BuscarPersonaslibreDeudaForm();
	}
	
  	public function executeVerhistorico(sfWebRequest $request)
  	{
    	$maxLimit = 150;
    	$usuario = $this->getUser()->getUsername(); // obtengo el nombre de usuario logeado para filtrar consulta

    	$this->pager = new sfDoctrinePager('historicoconsultas', $maxLimit);
    	if ($usuario == 'administracion') {
			//si es el usuario administrador muestro todos los registros
    		$q = Doctrine_Query::create()
				->from('historicoconsultas hc')
				->orderBy('created_at DESC');		
		} else {
			$posarroba=strpos($usuario,'@');
			$user= substr($usuario, 0, $posarroba);

			$q = Doctrine_Query::create()
				->from('historicoconsultas hc')
				->where('hc.usuario like "'.$user.'%"')
				->orderBy('created_at DESC');
		}

    	$this->pager->setQuery($q);

    	$this->pager->setPage($request->getParameter('page', 1));
    	$this->pager->setPage($this->getUser()->getAttribute('HistoricoConsultas.page'));
    	$this->pager->init();
	}
	
  
	// Obtiene los personas segun el filtro
	public function executeObtenerpersonas(sfWebRequest $request)
	{

		$this->administracion = new Administracion();		
		
		// Obtener personas relacionadas a la facultad del usuario con perfil de facultad
		$idsede = sfContext::getInstance()->getUser()->getAttribute('id_sede','');
	
		$this->personas = $this->administracion->obtenerpersonassegunfiltrosede($request->getPostParameter('apellido'),$request->getPostParameter('dni'),$idsede);
	}
			
	// Obtiene el estado de la persona
	public function executeVerestado(sfWebRequest $request)
	{


		$administracion = new Administracion();

		$fechalibredeuda = $administracion->obtenerlibredeudaalumnoporid($request->getParameter('idalumno')); 

		$fecha = unserialize(base64_decode($fechalibredeuda)); 
		$this->fechalib=$fecha['fechalibredeuda'];

		if ($fecha['fechalibredeuda']>=date('Y-m-d')){ 
		$fecha_det= explode('-',$fecha['fechalibredeuda']);
		$nuevafecha=  $fecha_det[2].'/'.$fecha_det[1].'/'.$fecha_det[0];
						$mensaje = 'Posee libredeuda hasta :'.$nuevafecha; 
					} else { 
						$mensaje = 'Consultar Administracion'; 
					};

		echo $mensaje;


	}	

 public function executeLista(sfWebRequest $request)
  {
	$condicion = "";
  	$this->getResponse()->setHttpHeader('Content-type', 'application/json; charset=utf-8');

	// se obtienen los parametros de la grilla
	$page = $request->getGetParameter('page');
	$limit = $request->getGetParameter('rows');
	$sidx = $request->getGetParameter('sidx');
	$sord = $request->getGetParameter('sord');
	$count = $request->getGetParameter('records');
	$searchField = $request->getGetParameter('searchField');
	$searchOper = $request->getGetParameter('searchOper');
	$searchString = $request->getGetParameter('searchString');
	if ($searchString) $condicion = $this->generarCondicion($searchField, $searchOper, $searchString);
  	
	// si no hay valores en los parametros, se asignan por defecto
	if(!$page) $page = 1; 
	if(!$limit) $limit = 100; 
	if(!$sidx) $sidx = 1; 
	
	$usuario = $this->getUser()->getUsername();
	$posarroba=strpos($usuario,'@');
	$user= substr($usuario, 0, $posarroba);
	
    if ($usuario == 'administracion') 
	{
		$result = Doctrine_Core::getTable('HistoricoConsultas')->obtenerHistorico("");	
	} else {
		$result = Doctrine_Core::getTable('HistoricoConsultas')->obtenerHistorico($user);
	}

    // se calculan la cantidad de registros
	$count = count($result); 
	// se calcula la cantidad de paginas
	if( $count >0 ) { 
		$total_pages = ceil($count/$limit); 
	} else { 
	 	$total_pages = 0; 
	} 
	 
	if ($page > $total_pages) $page = $total_pages; 
	 
	$start = $limit*$page - $limit; // do not put $limit*($page - 1) 	
	
  	// se obtienen los estudios de acuerdo a los parametros ingresados
	if (!$condicion) {
		$result = Doctrine_Query::create()
			->select('h.*')
	        ->from('HistoricoConsultas h')
	        ->where('h.usuario like "'.$user.'%"')
	        ->orderBy($sidx." ".$sord)
	        ->offset($start)
	        ->limit($limit)
	        ->execute();  
	} else {
		$result = Doctrine_Query::create()
			->select('h.*')
	        ->from('HistoricoConsultas h')
	        ->where('h.usuario like "'.$user.'%"')
	        ->andWhere($condicion)
	        ->orderBy($sidx." ".$sord)
	        ->offset($start)
	        ->limit($limit)
	        ->execute();  	
	}	
	
	// se arma la cabecera de la grilla   
	$response = array();
	$response["total"] = "$total_pages";
	$response["page"] = "$page";
	$response["records"] = "$count";

	$i=0; 			
	// se arma el contenido de la grilla
	foreach ($result as $key => $value) {	
		// carga los datos para la grilla
		$response["rows"][$i]['id'] = $result[$key]->id;
	    $response["rows"][$i]['cell'] = array($result[$key]->id, $result[$key]->persona, $result[$key]->carrera, $result[$key]->mensaje, $result[$key]->usuario, $result[$key]->created_at );
    
	    $i++;
	}
	return $this->renderText(json_encode($response)); 
  } 	
  
  protected function generarCondicion($campo, $operador, $criterio)
  {
	// array to translate the search type
	$arregloOperadores = array('eq'=>'=', 'ne'=>'<>', 'lt'=>'<', 'le'=>'<=', 'gt'=>'>', 'ge'=>'>=', 'bw'=>'LIKE', 'bn'=>'NOT LIKE', 'in'=>'LIKE', 'ni'=>'NOT LIKE', 'ew'=>'LIKE', 'en'=>'NOT LIKE', 'cn'=>'LIKE', 'nc'=>'NOT LIKE');
	$criterio = strtoupper($criterio);
	
	if (($operador == 'eq') or ($operador == 'ne') or ($operador == 'lt') or ($operador == 'le') or ($operador == 'gt') or ($operador == 'ge')){
		$condicion = $campo." ".$arregloOperadores[$operador]." ".$criterio;
	} elseif (($operador == 'bw') or ($operador == 'bn')) {
		$condicion = $campo." ".$arregloOperadores[$operador]." '".$criterio."%'";
	} elseif (($operador == 'ew') or ($operador == 'en')) {
		$condicion = $campo." ".$arregloOperadores[$operador]." '".$criterio."%'";
	} else {
		$condicion = $campo." ".$arregloOperadores[$operador]." '%".$criterio."%'";
	}
	
	return $condicion;
  }  	   
}


