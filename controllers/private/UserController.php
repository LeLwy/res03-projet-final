<?php 

class UserController extends PrivateAbstractController
{
    
    public function show(int $id)
    {

    }

    public function index(){

        $this->render('user_index', []);
    }
}