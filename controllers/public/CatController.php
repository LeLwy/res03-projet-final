<?php 

class PrivateCatController extends PrivateAbstractController
{
    
    private CatManager $catManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
    }

    public function index()
    {
        $cats = $this->catManager->findAll();
        $this->render('cat', 'index', [$cats]);
    }

    public function show(int $id)
    {
        $cat = $this->catManager->getCatById($id);
        $this->render('cat', 'single', ['cat' =>$cat]);
    }
}