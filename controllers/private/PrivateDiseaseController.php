<?php 

class PrivateDiseaseController extends PrivateAbstractController 
{
    private DiseaseManager $diseaseManager;

    public function __construct(){

        $this->diseaseManager = new DiseaseManager();
    }
    
    public function index(){
        
        $diseases = $this->diseaseManager->findAll();
        $this->render('disease', 'index', [$diseases]);
    }

    public function show(int $id)
    {
        $disease = $this->diseaseManager->getDiseaseById($id);
        $this->render('disease', 'single', ['disease' =>$disease]);
    }

    public function create()
    {
        $this->render('disease', 'create', []);
    }

    public function update($disease)
    {
        $disease = $this->diseaseManager->updateDisease($disease);
        $this->render('disease', 'edit', ['disease' =>$disease]);
    }
}