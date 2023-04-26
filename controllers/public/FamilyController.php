<?php 

class FamilyController extends PublicAbstractController
{

    private FamilyManager $familyManager;

    public function __construct()
    {
        $this->familyManager = new FamilyManager();
    }
    
    public function index()
    {

        $pageInfos = [

            'title' => 'Les familles d\'accueil de l\'association',
        ];

        $families = $this->familyManager->findAll();
        $this->render('families', 'index', [$pageInfos, $families]);
    }
    
    public function show(int $id)
    {
        $family = $this->familyManager->getFamilyById($id);
        $familyName = $family->getName();
        
        $pageInfos = [

            'title' => 'La famille d\'accueil: '.$familyName,
        ];

        $this->render('families', 'single', [$pageInfos, ['family' => $family]]);
    }
}