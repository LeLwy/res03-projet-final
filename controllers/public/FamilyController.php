<?php 

class FamilyController extends PublicAbstractController
{
    
    public function index(){

        $this->render('families', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}