<?php 

class CatController extends PrivateAbstractController
{
    


    public function show(int $id)
    {

    }

    public function index(){

        $this->render('cat_index', []);
    }
}