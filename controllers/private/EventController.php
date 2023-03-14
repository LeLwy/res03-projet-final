<?php

class EventController extends PrivateAbstractController
{
    
    public function index(){

        $this->render('event', 'index', []);
    }

    public function show(int $id)
    {

    }
}