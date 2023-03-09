<?php 

class BlogController extends PublicAbstractController
{
    
    public function index()
    {
        $this->render('post_index', []);
    }

    public function show()
    {
        $this->render('post_index', []);
    }
}