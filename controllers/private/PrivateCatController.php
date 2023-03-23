<?php 

class PrivateCatController extends PrivateAbstractController
{
    
    private CatManager $catManager;
    private FamilyManager $familyManager;
    private PrivateFamilyController $familyController;
    private Uploader $uploader;
    private MediaManager $mediaManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
        $this->familyManager = new FamilyManager();
        $this->familyController = new PrivateFamilyController();
        $this->uploader = new Uploader();
        $this->mediaManager = new MediaManager();
    }

    public function index()
    {
        $cats = $this->catManager->findAll();
        $this->render('cat', 'index', $cats);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $medias = $this->mediaManager->findMediasByCatId($id);
        foreach($medias as $media){

            $cat->addMedias($media);
        }
        $this->render('cat', 'single', ['cat' => $cat]);
        
    }

    public function create($post)
    {
        $families = $this->familyController->toObjectArray($this->familyManager->findAll());

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

                if(isset($post['cat-is-sterilized'])){

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

                $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'cat-medias'));

                $cat = new Cat($post['cat-name'], $post['cat-age'], $post['cat-sex'], $post['cat-color'], $post['cat-description'], $sterilizedStatus);
                $cat->setFamily($catFamily);
                $newCat = $this->catManager->insertCat($cat);
                $newCatMedia = $this->catManager->addMediaOnCat($cat->getId(), $media->getId());

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

                if(isset($post['cat-is-sterilized'])){

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
        $medias = $this->mediaManager->findMediasByCatId($id);
        $this->catManager->deleteMediasOnCat($cat);
        $this->catManager->deleteCat($cat);
        foreach($medias as $media){
            
            $this->mediaManager->deleteMedia($media);
        }

        header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
    }

    public function addMediaInCatMedias(array $post, int $id)
    {
        var_dump($_FILES);

        if(isset($_FILES) && !empty($_FILES)){
            $cat = $this->catManager->getCatById($id);
            
            $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'cat-medias'));
            $newCatMedia = $this->catManager->addMediaOnCat($cat->getId(), $media->getId());

            header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption/'.$id.'/voir');
        }
    }

    public function deleteMediaInCatMedias(int $catId, int $mediaId)
    {
        $cat = $this->catManager->getCatById($catId);
        $media = $this->mediaManager->getMediaById($mediaId);
        $this->catManager->deleteMediaOnCatsMedias($cat, $media);
        $this->mediaManager->deleteMedia($media);

        header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption/'.$cat->getId().'/voir');
    }
}