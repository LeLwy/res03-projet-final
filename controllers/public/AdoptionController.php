<?php

class AdoptionController extends PublicAbstractController
{
    private CatManager $catManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
    }

    public function index()
    {
        $pageInfos = [

            'title' => 'Chats à l\'adoption',
        ];

        $cats = $this->catManager->findAll();
        $this->render('adoption', 'index', [$pageInfos, $cats]);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $catName = $cat->getName();

        $pageInfos = [

            'title' => 'Chats à l\'adoption: '.$catName,
        ];
        
        $this->render('adoption', 'single', [$pageInfos,['cat' =>$cat]]);
    }
}