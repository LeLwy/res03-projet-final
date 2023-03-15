<?php

class PrivateEventController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('event', 'index', []);
    }

    public function show(int $id)
    {

    }
}