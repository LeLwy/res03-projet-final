<?php 

abstract class AbstractController
{
    protected function renderPartial(string $privacy, string $template, array $values)  
    {  
        $data = $values;  
          
        require "templates/".$privacy."/".$template.".phtml";  
    }  
      
    protected function render(array $values)  
    {  
        echo json_encode($values);  
    }
}