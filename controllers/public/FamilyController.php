<?php 

class FamilyController extends PublicAbstractController
{

    private FamilyManager $familyManager;
    private MediaManager $mediaManager;

    public function __construct()
    {
        $this->familyManager = new FamilyManager();
        $this->mediaManager = new MediaManager();
    }
    
    public function index()
    {

        $pageInfos = [

            'title' => 'Les familles d\'accueil de l\'association - Homeless Kitten Association',
            'main_id' => 'families'
        ];

        $families = $this->familyManager->findAll();
        $this->render('families', 'index', [$pageInfos, $families]);
    }
    
    public function show(int $id)
    {
        $family = $this->familyManager->getFamilyById($id);
        $familyName = $family->getName();
        $medias = $this->mediaManager->findMediasByFamilyId($family);
        $cats = $this->familyManager->findFamilyCats($family);

        if(count($medias) > 0){

            $family->setMainMediaUrl($medias[0]->getUrl());
        }
        
        $pageInfos = [

            'title' => 'La famille d\'accueil: '.$familyName.' - Homeless Kitten Association',
            'main_id' => 'families-single'
        ];

        $this->render('families', 'single', [$pageInfos, ['family' => $family], $medias, $cats]);
    }
}