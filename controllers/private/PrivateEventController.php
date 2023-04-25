<?php

class PrivateEventController extends PrivateAbstractController
{
    private EventManager $eventManager;
    private MediaManager $mediaManager;
    private Uploader $uploader;

    public function __construct(){

        $this->eventManager = new EventManager();
        $this->mediaManager = new MediaManager();
        $this->uploader = new Uploader();
    }
    
    public function index(){

        $events = $this->eventManager->findAll();
        $this->render('event', 'index', $events);
    }

    public function show(int $id)
    {
        $event = $this->eventManager->getEventById($id);
        $media = $this->mediaManager->getMediaById($event->getMediaId());
        $this->render('event', 'single', [['event' =>$event], $media]);
    }

    public function create(array $post)
    {
        $error = "";

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field) || $_FILES['event-medias']['name'] === ""){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }

            if($error !== ""){
                
                echo $error;

            }else{

                var_dump($post);

                $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'event-medias'));

                $event = new Event($post['event-name'], $post['event-description'], $post['event-location'], $post['event-date'], $media->getId());

                $newEvent = $this->eventManager->insertEvent($event);
                // $newEventMedia = $this->eventManager->addMediaOnEvent($event->getId(), $media->getId());

                header('Location: /res03-projet-final/admin/index-des-evenements');
            }
            
        }else{

            $this->render('event', 'create', []);
        }
    }

    public function update(array $post, int $id)
    {
        $event = $this->eventManager->getEventById($id);

        $error = "";

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field) || $_FILES['event-medias']['name'] === ""){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }

            if($error !== ""){
                
                echo $error;

            }else{

                $media = $this->mediaManager->getMediaById($event->getMediaId());
                
                $newMedia = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'event-medias'));
                
                $eventToUpdate = new Event($post['event-name'], $post['event-description'], $post['event-location'], $post['event-date'], $newMedia->getId());
                $eventToUpdate->setId($id);
                $eventToUpdate = $this->eventManager->updateEvent($eventToUpdate);
                
                $this->mediaManager->deleteMedia($media);
                
                header('Location: /res03-projet-final/admin/index-des-evenements');
            }
            
        }else{

            $this->render('event', 'edit', ['event' => $event]);
        }
    }

    public function delete($id) : void
    {
        $event = $this->eventManager->getEventById($id);
        $media = $this->mediaManager->getMediaById($event->getMediaId());

        $this->eventManager->deleteEvent($event);
        $this->mediaManager->deleteMedia($media);

        header('Location: /res03-projet-final/admin/index-des-evenements');
    }
}