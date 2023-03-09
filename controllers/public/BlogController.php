<?php 

class BlogController extends PublicAbstractController
{
    
    public function index()
    {
        $this->render('blog', []);
    }
}