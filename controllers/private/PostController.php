<?php 

class PostController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('post', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}