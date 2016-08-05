<?php
 
class personasComponents extends sfComponents
    {
      public function executeBuscar(sfWebRequest $request)
	  {
        $this->resultado = array();

        $this->form = new BuscarAlumnosForm(array(
			'url' => $this->url,
            'titulo' => $this->titulo,
        	'tipo' => $this->tipo,        		
        	'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
       	));
	  } 


      public function executeBuscarcertificado(sfWebRequest $request)
	  {
        $this->resultado = array();

        $this->form = new BuscarAlumnosCertificadoForm(array(
			'url' => $this->url,
            'titulo' => $this->titulo,
        	'tipo' => $this->tipo,        		
        	'referer' => $request->getGetParameter('referer', str_replace($request->getUriPrefix(), '', $request->getUri()))
       	));
	  } 
   }
