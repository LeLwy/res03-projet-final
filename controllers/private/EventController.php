<?php

class EventController extends PrivateAbstractController
{
    public function show(int $id)
    {

    }

    public function index(){

        $this->render('event_index', []);
    }
}