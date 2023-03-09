<?php 

class PostController extends PrivateAbstractController
{
    
    public function show(int $id)
    {

    }

    public function index(){

        $this->render('post_index', []);
    }
}