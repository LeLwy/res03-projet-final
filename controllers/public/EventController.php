<?php

class EventController extends PublicAbstractController
{

    private EventManager $eventManager;

    public function __construct()
    {
        $this->eventManager = new EventManager;
    }
    
    public function index()
    {
        $pageInfos = [

            'title' => 'Évènements associatifs',
        ];

        $events = $this->eventManager->findAll();
        $this->render('event', 'index', [$pageInfos, $events]);
    }

    public function show(int $id)
    {
        $event = $this->eventManager->getEventById($id);
        $eventName = $event->getName();

        $pageInfos = [

            'title' => 'Évènements associatifs: '.$eventName,
        ];

        $this->render('event', 'single', [$pageInfos,['event' => $event]]);
    }
}