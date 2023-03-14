<?php 

class BlogController extends PublicAbstractController
{
    private PostManager $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function index()
    {
        $this->render('post', 'index', []);
    }

    public function show()
    {
        $this->render('post', 'single', []);
    }
}