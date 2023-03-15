<?php 

class UserController extends PublicAbstractController
{
    
    public function index(){

        $this->render('user', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}