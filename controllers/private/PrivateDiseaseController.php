<?php 

class PrivateDiseaseController extends PrivateAbstractController 
{
    private DiseaseManager $diseaseManager;

    public function __construct(){

        $this->diseaseManager = new DiseaseManager();
    }
    
    public function index(){
        
        $diseases = $this->diseaseManager->findAll();
        $this->render('disease', 'index', $diseases);
    }

    public function show(int $id)
    {
        $disease = $this->diseaseManager->getDiseaseById($id);
        $this->render('disease', 'single', ['disease' =>$disease]);
    }

    public function create(array $post)
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

                $disease = new Disease($post['disease-name'], $post['disease-description'], $post['disease-treatment']);

                $newDisease = $this->diseaseManager->insertDisease($disease);

                header('Location: /res03-projet-final/admin/index-des-maladies');
            }
            
        }else{

            $this->render('disease', 'create', []);
        }
    }

    public function update(array $post, int $id)
    {
        $disease = $this->diseaseManager->getDiseaseById($id);

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

                
                $diseaseToUpdate = new Disease($post['disease-name'], $post['disease-description'], $post['disease-treatment']);
                $diseaseToUpdate->setId($id);
                $diseaseToUpdate = $this->diseaseManager->updateDisease($diseaseToUpdate);
                
                header('Location: /res03-projet-final/admin/index-des-maladies');
            }
            
        }else{

            $this->render('disease', 'edit', ['disease' => $disease]);
        }
    }

    public function delete($id)
    {
        $disease = $this->diseaseManager->getDiseaseById($id);

        $this->diseaseManager->deleteDisease($disease);

        header('Location: /res03-projet-final/admin/index-des-maladies');
    }
}