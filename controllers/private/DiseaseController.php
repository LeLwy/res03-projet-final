<?php 

class DiseaseController extends PrivateAbstractController 
{
    
    public function index(){
        
        $this->render('disease', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}