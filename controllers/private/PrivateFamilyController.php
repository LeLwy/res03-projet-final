<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('family', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}