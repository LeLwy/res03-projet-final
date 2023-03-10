<?php 

class FamilyController extends PrivateAbstractController
{
    
    public function show(int $id)
    {

    }

    public function index(){

        $this->render('family', 'index', []);
    }
}