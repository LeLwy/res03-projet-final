<?php

class EventManager extends AbstractManager{
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM events');
        $query->execute();
        $events = $query->fetchAll(PDO::FETCH_ASSOC);

        $eventsArray = [];
        
        foreach($events as $event){

            $newEvent = new Event($event['name'], $event['description'], $event['location'], $event['date'], $event['media_id']);
            $newEvent->setId($event['id']);
            $eventsArray[] = $newEvent;

        }

        return $eventsArray;
    }

    public function getEventById(int $id) : Event
    {
        $query = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        
        $parameters = [
            'id' => $id
        ];
        
        $query->execute($parameters);
        
        $event = $query->fetch(PDO::FETCH_ASSOC);
        
        $newEvent= new Event($event['name'], $event['description'], $event['location'], $event['date'], $event['media_id']);
        
        $newEvent->setId($event['id']);
        
        return $newEvent;
    }
    
    public function insertEvent(Event $event) : Event
    {
        $query = $this->db->prepare('INSERT INTO events VALUES(:id, :name, :description, :location, :date, :media_id)');
        
        $parameters = [
            'id' => null,
            'name' => $event->getName(),
            'description' => $event->getDescription(),
            'location' => $event->getLocation(),
            'date' => $event->getDate(),
            'media_id' => $event->getMediaId()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $event->setId($id);

        $newEvent = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getEventById($id);
        
    }
    
    public function updateEvent(Event $event) : void
    {
        $query = $this->db->prepare('UPDATE events SET name = :newName, description = :newDescription, location = :newLocation, date = :newDate, media_id = :newMediaId WHERE id = :id');
        
        $parameters = [
            'id' => $event->getId(),
            'newName' => $event->getName(),
            'newDescription' => $event->getDescription(),
            'newLocation' => $event->getLocation(),
            'newDate' => $event->getDate(),
            'newMediaId' => $event->getMediaId()
        ];
        
        $query->execute($parameters);
    }

    public function deleteEvent(Event $event) : void
    {
        $query = $this->db->prepare('DELETE FROM events WHERE id = :event_id');

        $parameters = [
            'event_id' => $event->getId()
        ];

        $query->execute($parameters);
    }
}