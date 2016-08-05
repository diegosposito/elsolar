<?php
 
class personasComponents extends sfComponents
    {
      public function executeCarreraspersonas(sfWebRequest $request)
	  {
       $this->resultado = array();
        
        $this->form = new BuscarCarrerasPersonasForm(array(
			'url' => $this->url,
        	'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
       	));
	  } 
   }