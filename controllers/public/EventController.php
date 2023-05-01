<?php

class EventController extends PublicAbstractController
{

    private EventManager $eventManager;
    private MediaManager $mediaManager;

    public function __construct()
    {
        $this->eventManager = new EventManager;
        $this->mediaManager = new MediaManager;
    }
    
    public function index()
    {
        $pageInfos = [

            'title' => 'Homeless Kitten Association - Évènements associatifs',
            'main_id' => 'events'
        ];

        $events = $this->eventManager->findAll();
        $this->render('events', 'index', [$pageInfos, $events]);
    }

    public function show(int $id)
    {
        $event = $this->eventManager->getEventById($id);
        $eventName = $event->getName();
        $eventMedia = $this->mediaManager->getMediaById($event->getMediaId());

        $pageInfos = [

            'title' => 'Homeless Kitten Association - '.$eventName,
            'main_id' => 'events-single'
        ];

        $this->render('events', 'single', [$pageInfos,['event' => $event], $eventMedia]);
    }
}