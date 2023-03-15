<?php 

class PostController extends PublicAbstractController
{
    
    public function index(){

        $this->render('post', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}