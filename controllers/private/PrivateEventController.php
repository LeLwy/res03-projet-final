<?php

class PrivateEventController extends PrivateAbstractController
{
    private EventManager $eventManager;
    
    public function index(){

        $this->render('event', 'index', []);
    }

    public function show(int $id)
    {
        $event = $this->eventManager->getEventById($id);
        $this->render('event', 'single', ['event' =>$event]);
    }

    public function create()
    {
        $this->render('event', 'create', []);
    }

    public function update($event)
    {
        $event = $this->eventManager->updateEvent($event);
        $this->render('event', 'edit', ['event' =>$event]);
    }
}