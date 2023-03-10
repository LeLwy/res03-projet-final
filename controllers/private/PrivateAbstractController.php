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
            
            require 'templates/private/layout.phtml';
        }
}