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
        $cats = $this->familyManager->findFamilyCats($family);
        $medias = $this->mediaManager->findMediasByFamilyId($family);
        $family->setCats($cats);
        $family->setMedias($medias);
        $this->render('family', 'single', ['family' =>$family]);
    }

    public function create($post)
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

                echo "coucou";

                $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'family-medias'));

                $family = new Family($post['family-name'], $post['family-description']);
                $newFamily = $this->familyManager->insertFamily($family);
                $newFamilyMedia = $this->familyManager->addMediaOnFamily($newFamily->getId(), $media->getId());

                header('Location: /res03-projet-final/admin/index-des-familles');
            }
            
        }else{

            $this->render('family', 'create', []);
        }
    }

    public function update(array $post, int $id)
    {
        $family = $this->familyManager->getFamilyById($id);
        
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

                $familyToUpdate = new Family($post['family-name'], $post['family-description']);
                $familyToUpdate->setId($id);
                $familyToUpdate = $this->familyManager->updatefamily($familyToUpdate);
                
                header('Location: /res03-projet-final/admin/index-des-familles');
            }
        }else{
            
            $this->render('family', 'edit', ['family' =>$family]);
        }
    }

    public function delete($id)
    {
        $family = $this->familyManager->getFamilyById($id);
        $medias = $this->mediaManager->findMediasByFamilyId($family);
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

    public function addMediaInFamilyMedias(array $post, int $id)
    {
        var_dump($_FILES);

        if(isset($_FILES) && !empty($_FILES)){
            $family = $this->familyManager->getFamilyById($id);
            
            $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'family-medias'));
            $newFamilyMedia = $this->familyManager->addMediaOnFamily($family->getId(), $media->getId());

            header('Location: /res03-projet-final/admin/index-des-familles/'.$id.'/voir');
        }
    }

    public function deleteMediaInFamilyMedias(int $familyId, int $mediaId)
    {
        $family = $this->familyManager->getFamilyById($familyId);
        $media = $this->mediaManager->getMediaById($mediaId);
        $this->familyManager->deleteMediaOnFamiliesMedias($family, $media);
        $this->mediaManager->deleteMedia($media);

        header('Location: /res03-projet-final/admin/index-des-familles/'.$family->getId().'/voir');
    }
}