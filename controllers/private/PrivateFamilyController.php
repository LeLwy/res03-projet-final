<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    private FamilyManager $familyManager;

    public function __construct(){

        $this->familyManager = new FamilyManager();
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
        $this->render('family', 'create', []);
    }

    public function update($family)
    {
        $family = $this->familyManager->updatefamily($family);
        $this->render('family', 'edit', ['family' =>$family]);
    }
}