<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('families', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}