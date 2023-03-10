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
        $cats = $this->catManager->findAll();
        $this->render('adoption', 'index', [$cats]);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $this->render('adoption', 'single', ['cat' =>$cat]);
    }
}