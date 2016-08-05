<?php

require_once dirname(__FILE__).'/../lib/personasegresadasGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/personasegresadasGeneratorHelper.class.php';

/**
 * personasegresadas actions.
 *
 * @package    sig
 * @subpackage personasegresadas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personasegresadasActions extends autoPersonasegresadasActions
{

  public function executeIndex(sfWebRequest $request)
  {
      $this->redirect('personasegresadas/new');
  }


  public function executeEdit(sfWebRequest $request)
  {
      $this->redirect('personasegresadas/new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {


    	   $nrodoc = preg_replace('/[^\d]/', '', $form["numerodoc"]->getValue());

	    // GRABAR VIA WS EN SISTEMA ALUMNOS ANTERIOR
	    //=============================================================================
	    $soapclient = new nusoap_client(sfConfig::get('app_wstest1_nuevaspersonas'));
	    $soapclient->setCredentials("root", "root911");

	    // llamamos la función implementada en el webservices
	    $resultadoSoap = $soapclient->call('actualizarpersona',
		array('idpersona' => null,
		'nombre' => ucwords(strtolower($form["nombre"]->getValue())), 
		'apellido' => strtoupper($form["apellido"]->getValue()), 
		'sexo' => $form["idsexo"]->getValue(), 
		'idtipodoc' => $form["idtipodoc"]->getValue(),
		'nrodoc' => $nrodoc,      
		'fechanac' => "1980-01-01",
		'fechaingreso' => "1980-01-01",
		'idciudadnac' => "734", 
		'idnacionalidad' => "1",
		'estadocivil' => "1",
		'vive' => 1)
	    );

	    $this->persona = unserialize(base64_decode($resultadoSoap));    
	    //echo $nrodoc."*".$this->persona['idPersona']; die;
	    if($this->persona['idPersona']>0){
     
                   $personas = $form->save();
		   $personas->setNrodoc($nrodoc);
                   $personas->save();
		}



      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $personas)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@personasegresadas_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'personasegresadas_edit', 'sf_subject' => $personas));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }


}
