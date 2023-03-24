<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    private FamilyManager $familyManager;
    private MediaManager $mediaManager;
    private Uploader $uploader;

    public function __construct(){

        $this->familyManager = new FamilyManager();
        $this->mediaManager = new MediaManager();
        $this->uploader = new Uploader();
    }
    
    public function index(){

        $families = $this->familyManager->findAll();
        $this->render('family', 'index', [$families]);
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

    public function update($family)
    {
        $family = $this->familyManager->updatefamily($family);
        $this->render('family', 'edit', ['family' =>$family]);
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
}