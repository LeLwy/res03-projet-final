<?php 

class BlogController extends AbstractController
{
    
    public function index()
    {
        require "../templates/public/blog_index.phtml";
    }
}