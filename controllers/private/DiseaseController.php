<?php 

class DiseaseController extends PrivateAbstractController 
{
    
    public function show(int $id)
    {

    }

    public function index(){

        $this->render('disease_index', []);
    }
}