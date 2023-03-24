<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    private FamilyManager $familyManager;
    private MediaManager $mediaManager;
    private CatManager $catManager;
    private Uploader $uploader;

    public function __construct(){

        $this->familyManager = new FamilyManager();
        $this->mediaManager = new MediaManager();
        $this->catManager = new CatManager();
        $this->uploader = new Uploader();
    }
    
    public function index(){

        $families = $this->familyManager->findAll();
        $this->render('family', 'index', $families);
    }

    public function show(int $id)
    {
        $family = $this->familyManager->getfamilyById($id);
        $this->render('family', 'single', ['family' =>$family]);
    }

    public function create()
    {

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

                $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'family-medias'));

                $family = new Family($post['name'], $post['description']);
                $newFamily = $this->familyManager->insertFamily($family);
                $newFamilyMedia = $this->familyManager->addMediaOnFamily($family->getId(), $media->getId());

                header('Location: /res03-projet-final/admin/index-des-familles');
            }
            
        }else{

            $this->render('family', 'create', []);
        }
    }

    public function update(array $post, int $id)
    {
        $family = $this->familyManager->getFamilyById($id);$error = "";

        if(isset($post) && !empty($post)){


            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }
            if($error !== ""){

                echo $error;

            }else{

                $familyToUpdate = new Family($post['family-name'], $post['family-description']);
                $familyToUpdate->setId($id);
                $familyToUpdate = $this->familyManager->updatefamily($family);
                
                header('Location: /res03-projet-final/admin/index-des-chats-a-l-adoption');
            }
        }else{
            
            $this->render('family', 'edit', ['family' =>$family]);
        }
    }

    public function toObjectArray($families) : array
    {
        $objectArray = [];

        foreach($families as $family){

            $objectFamily = new Family($family['name'], $family['description']);
            $objectFamily->setId($family['id']);

            $objectArray[] = $objectFamily;
        }

        return $objectArray;
    }

    public function delete($id)
    {
        $family = $this->familyManager->getFamilyById($id);
        $medias = $this->mediaManager->findMediasByFamilyId($id);
        $cats = $this->familyManager->findFamilyCats($family);
        if(count($cats) === 0){

            $this->familyManager->deleteMediasOnFamily($family);
            $this->familyManager->deleteFamily($family);
            foreach($medias as $media){
                
                $this->mediaManager->deleteMedia($media);
            }

            header('Location: /res03-projet-final/admin/index-des-familles');
        }else{

            echo "Des chats sont encore attribués à cette famille";
        }
    }
}