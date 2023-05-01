<?php

class AdoptionController extends PublicAbstractController
{
    private CatManager $catManager;
    private MediaManager $mediaManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
        $this->mediaManager = new MediaManager();
    }

    public function index()
    {
        $cats = $this->catManager->findAll();
        $catsArray = [];

        foreach($cats as $cat){
            
            $medias = $this->mediaManager->findMediasByCatId($cat->getId());
    
            if(count($medias) > 0){

                $cat->setMainMediaUrl($medias[0]->getUrl());
            }

            $catsArray[] = $cat;
        }
        $pageInfos = [

            'title' => 'Homeless Kitten Association - Chats à l\'adoption',
            'main_id' => 'adoption'
        ];

        $this->render('adoption', 'index', [$pageInfos, $catsArray]);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $medias = $this->mediaManager->findMediasByCatId($cat->getId());
        $cat->setMedias($medias);
        $familyName = $cat->getFamilyName();
        $catName = $cat->getName();

        if(count($medias) > 0){

            $cat->setMainMediaUrl($medias[0]->getUrl());
        }

        $pageInfos = [

            'title' => 'Chats à l\'adoption: '.$catName,
            'main_id' => 'adoption-single'
        ];
        
        $this->render('adoption', 'single', [$pageInfos,['cat' =>$cat], $familyName]);
    }
}