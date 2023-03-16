<?php 

class PrivateCatController extends PrivateAbstractController
{
    
    private CatManager $catManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
    }

    public function index()
    {
        $cats = $this->catManager->findAll();
        $this->render('cat', 'index', [$cats]);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $this->render('cat', 'single', ['cat' =>$cat]);
    }

    public function create($post)
    {
        var_dump($post);

        $error = "";

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(!empty($field)){
    
                    $error = "Veuillez renseigner ce champ";
                }
            }

            if($error !== ""){

                $sterilizedStatus = "";

                if($post['cat-is-sterilized'] === "on"){

                    $sterilizedStatus = "oui";
                }else{

                    $sterilizedStatus = "non";
                }

                $cat = new Cat($post['cat-name'], $post['cat-age'], $post['cat-sex'], $post['cat-color'], $post['cat-description'], $sterilizedStatus);
                $this->catManager->insertCat($cat);

                header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
            }
            
        }else{

            $this->render('cat', 'create', []);
        }
    }

    public function update($cat)
    {
        $cat = $this->catManager->updateCat($cat);
        $this->render('cat', 'edit', ['cat' =>$cat]);
    }
}