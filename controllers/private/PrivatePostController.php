<?php 

class PrivatePostController extends PrivateAbstractController
{
    private PostManager $postManager;
    
    public function index(){

        $this->render('post', 'index', []);
    }

    public function show(int $id)
    {
        $post = $this->postManager->getpostById($id);
        $this->render('post', 'single', ['post' =>$post]);
    }

    public function create()
    {
        $this->render('post', 'create', []);
    }

    public function update($post)
    {
        $post = $this->postManager->updatepost($post);
        $this->render('post', 'edit', ['post' =>$post]);
    }
}