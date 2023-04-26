<?php 

class PostController extends PublicAbstractController
{
    
    private PostManager $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function index()
    {
        $posts = $this->postManager->findAll();
        $this->render('post', 'index', $posts);
    }

    public function show(int $id)
    {
        $post = $this->postManager->getPostById($id);
        $this->render('post', 'single', ['post' => $post]);
    }
}