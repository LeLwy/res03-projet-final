<?php 

class PrivateCatController extends PrivateAbstractController
{
    
    private CatManager $catManager;
    private FamilyManager $familyManager;
    private PrivateFamilyController $familyController;

    public function __construct()
    {
        $this->catManager = new CatManager();
        $this->familyManager = new FamilyManager();
        $this->familyController = new PrivateFamilyController();
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
        $families = $this->familyController->toObjectArray($this->familyManager->findAll());

        $error = "";
        $catMedias = [];

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }
            if($error !== ""){
                
                echo $error;
                // $info = exif_imagetype($_FILES['cat-medias']['name']);
                var_dump($_FILES);

            }else{

                $sterilizedStatus = "";

                if($post['cat-is-sterilized'] === "on"){

                    $sterilizedStatus = "oui";
                }else{

                    $sterilizedStatus = "non";
                }

                $catFamily = null;

                foreach($families as $family){

                    if($post['cat-family'] === $family->getName()){

                        $catFamily = $family;
                    }
                }

                $cat = new Cat($post['cat-name'], $post['cat-age'], $post['cat-sex'], $post['cat-color'], $post['cat-description'], $sterilizedStatus);
                $cat->setFamily($catFamily);
                $this->catManager->insertCat($cat);

                header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
            }
            
        }else{

            $this->render('cat', 'create', $families);
        }
    }

    public function update($post, $catId)
    {
        $families = $this->familyController->toObjectArray($this->familyManager->findAll());
        $catToUpdate = $this->catManager->getCatById($catId);

        $error = "";

        if(isset($post) && !empty($post)){


            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }
            if($error !== ""){

                echo $error;

            }else{

                $sterilizedStatus = "";

                if($post['cat-is-sterilized'] === "on"){

                    $sterilizedStatus = "oui";
                }else{

                    $sterilizedStatus = "non";
                }

                $catFamily = null;

                foreach($families as $family){

                    if($post['cat-family'] === $family->getName()){

                        $catFamily = $family;
                    }
                }

                $catToUpdate = new Cat($post['cat-name'], $post['cat-age'], $post['cat-sex'], $post['cat-color'], $post['cat-description'], $sterilizedStatus);
                $catToUpdate->setFamily($catFamily);
                $catToUpdate->setId($catId);
                $catToUpdate = $this->catManager->updateCat($catToUpdate);

                header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
            }
            
        }else{

            $this->render('cat', 'edit', [['cat' =>$catToUpdate], $families]);
        }
    }

    public function delete($id)
    {
        $cat = $this->catManager->getCatById($id);
        $this->catManager->deleteCat($cat);

        header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
    }
}