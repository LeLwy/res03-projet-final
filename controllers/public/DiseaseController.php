<?php 

class DiseaseController extends PublicAbstractController 
{
    
    public function index(){
        
        $this->render('disease', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}