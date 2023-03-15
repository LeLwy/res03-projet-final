<?php 

class PrivateAdminController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('admin', 'index', []);
    }
    
    public function show(int $id)
    {

    }
}