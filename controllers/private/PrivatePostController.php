<?php 

class PrivatePostController extends PrivateAbstractController
{
    private PostManager $postManager;
    private UserManager $userManager;

    public function __construct(){

        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
    }
    
    public function index(){

        $posts = $this->postManager->findAll();
        $this->render('post', 'index', $posts);
    }

    public function show(int $id)
    {
        $post = $this->postManager->getpostById($id);
        $this->render('post', 'single', ['post' =>$post]);
    }

    public function create(array $post)
    {
        $error = "";

        if(isset($_SESSION['email'])){

            $author = $this->userManager->getUserByEmail($_SESSION['email']);
            $authorId = $author->getId();
        }

        date_default_timezone_set('Europe/Paris');

        $date = gmdate('d-m-Y h:i:s');

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }

            if($error !== ""){
                
                echo $error;

            }else{

                $newPost = new Post($post['post-title'], $post['post-content'], $date, $authorId);
                $newPost->setAuthor($author);
                $postToInsert = $this->postManager->insertPost($newPost);

                header('Location: /res03-projet-final/admin/index-des-articles');
            }
            
        }else{

            $this->render('post', 'create', []);
        }
    }

    public function update(array $post, int $postId)
    {
        $postToUpdate = $this->postManager->getPostById($postId);

        $error = "";

        if(isset($_SESSION['email'])){

            $author = $this->userManager->getUserByEmail($_SESSION['email']);
            $authorId = $author->getId();
        }
        
        date_default_timezone_set('Europe/Paris');

        $date = gmdate('d-m-Y h:i:s');

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }

            if($error !== ""){
                
                echo $error;

            }else{

                $newPostToUpdate = new Post($post['post-title'], $post['post-content'], $date, $authorId);
                $newPostToUpdate->setId($postId);
                $newPostToUpdate = $this->postManager->updatePost($newPostToUpdate);
                
                header('Location: /res03-projet-final/admin/index-des-articles');
            }
            
        }else{

            $this->render('post', 'edit', ['post' => $postToUpdate]);
        }
    }

    public function delete($id) : void
    {
        $postToDelete = $this->postManager->getPostById($id);

        $this->postManager->deletePost($postToDelete);

        header('Location: /res03-projet-final/admin/index-des-articles');
    }
}