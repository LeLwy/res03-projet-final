<?php 

abstract class PublicAbstractController
{
    // protected function renderPartial(string $template, array $values)  
    // {  
    //     $data = $values;  
          
    //     require "templates/public/".$template.".phtml";  
    // }  
      
    // protected function render(array $values)  
    // {  
    //     echo json_encode($values);
    // }
    public function render(string $view, array $values) : void
        {
            
            $template = $view;
            $data = $values;
            
            require 'templates/public/layout.phtml';
        }
}