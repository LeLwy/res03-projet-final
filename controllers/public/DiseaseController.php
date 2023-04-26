<?php 

class DiseaseController extends PublicAbstractController 
{

    private DiseaseManager $diseaseManager;

    public function __construct()
    {
        $this->diseaseManager = new DiseaseManager();
    }
    
    public function index()
    {
        $pageInfos = [

            'title' => 'Les maladies du chat',
        ];
        
        $diseases = $this->diseaseManager->findAll();
        $this->render('disease', 'index', [$pageInfos, $diseases]);
    }
    
    public function show(int $id)
    {
        $disease = $this->diseaseManager->getDiseaseById($id);
        $diseaseName = $disease->getName();
        $pageInfos = [

            'title' => 'Les maladies du chat: '.$diseaseName,
        ];

        $this->render('disease', 'single', [$pageInfos, ['disease' => $disease]]);
    }
}