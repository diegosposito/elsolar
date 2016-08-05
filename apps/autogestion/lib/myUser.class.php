<?php

class myUser extends sfGuardSecurityUser
{
     const INFO_MESSAGE = 'infoMessages';  
     const WARNING_MESSAGE = 'warnMessages';  
     const ERROR_MESSAGE = 'errorMessages';  
   
     //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  
     // METODOS PARA MANEJO DE MENSAJES FLASH  
     //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  
   
     /** 
      * Agrega mensajes al FLASH del objeto sfUser creando un array por cada tipo 
      * de mensaje (myUser::INFO_MESSAGE, myUser::WARNING_MESSAGE, myUser::ERROR_MESSAGE). 
      * El mensaje $msg será agregado al nivel correspondiente que por defecto será el INFO 
      * @param string $msg 
      * @param string $level 
      */  
     public function addMessage($msg, $level = myUser::INFO_MESSAGE)  
     {  
         //-- Obtengo el array almacenado, en caso de no existir retorna una array vacío  
         $flashContent = $this->getFlash($level, array());  
   
         //-- Controla si ya existe un mensaje igual para no insertarlo repetido  
         if(!in_array($msg, $flashContent))  
         {  
             //- Agrego el mensaje enviado en la siguiente posición disponible del array  
             $flashContent[] = $msg;  
   
             //-- Seteo el array al Flash nuevamente  
             $this->setFlash($level, $flashContent);  
         }  
     }  
 
}