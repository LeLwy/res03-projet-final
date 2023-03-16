<?php 

class PrivateFamilyController extends PrivateAbstractController
{
    private FamilyManager $familyManager;
    
    public function index(){

        $this->render('family', 'index', []);
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