<?php 

abstract class PrivateAbstractController
{
    // protected function renderPartial(string $template, array $values)  
    // {  
    //     $data = $values;  
          
    //     require "templates/private/".$template.".phtml";  
    // }  
      
    // protected function render(array $values)  
    // {  
    //     echo json_encode($values);  
    // }

    public function render(string $view, string $page, array $values) : void
        {
            
            $template = $view;
            $data = $values;
            $crudFunction = $page;
  
            if(isset($_SESSION['isConnected']) && $_SESSION['isConnected']){ 
            
                $logLink = "/res03-projet-final/deconnexion";
                $logLinkText = "Déconnexion";
                
                if(isset($_SESSION['role']) && $_SESSION['role'] !== "admin"){ 
                
                    $displayLinkForAdminOnly = "d-none";
                }else{

                    $displayLinkForAdminOnly = "";
                }

            }else{

                $logLink = "/res03-projet-final/connexion";
                $logLinkText = "Connexion";
            }

            $logInfos = [

                'logLink' => $logLink,
                'logLinkText' => $logLinkText,
                'displayLinkForAdminOnly' => $displayLinkForAdminOnly
            ];
            
            require 'templates/private/layout.phtml';
        }
}