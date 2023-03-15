<?php 

class PrivateUserController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('user', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}