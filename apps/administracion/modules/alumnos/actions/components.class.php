<?php
 
class personasComponents extends sfComponents
    {
      public function executeBuscar(sfWebRequest $request)
	  {
        $this->resultado = array();

        $this->form = new BuscarAlumnosForm(array(
			'url' => $this->url,
            'titulo' => $this->titulo,
        	'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
       	));
	  } 
   }