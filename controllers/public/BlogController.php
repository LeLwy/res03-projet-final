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
        $pageInfos = [

            'title' => 'Blog',
        ];

        $posts = $this->postManager->findAll();
        $this->render('post', 'index', [$pageInfos, $posts]);
    }

    public function show(int $id)
    {
        $post = $this->postManager->getPostById($id);
        $postTitle = $post->getTitle();

        $pageInfos = [

            'title' => 'Billet de blog: '.$postTitle,
        ];

        $this->render('post', 'single', [$pageInfos, ['post' => $post]]);
    }
}