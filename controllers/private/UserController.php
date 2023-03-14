<?php 

class UserController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('user', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}