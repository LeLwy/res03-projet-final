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
            'id' => intval($id)
        ];
        
        $query->execute($parameters);
        
        $event = $query->fetch(PDO::FETCH_ASSOC);
        
        $newEvent= new Event($event['name'], $event['description'], $event['location'], $event['date'], $event['media_id']);
        
        $newEvent->setId($event['id']);
        
        return $newEvent;
    }

    public function findLastEvent() : array
    {
        $query = $this->db->prepare('SELECT * FROM events ORDER BY id DESC LIMIT 3');
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
    
    public function insertEvent(Event $event) : Event
    {
        $query = $this->db->prepare('INSERT INTO events VALUES(:id, :name, :description, :location, :date, :media_id)');
        
        $parameters = [
            'id' => null,
            'name' => $this->cleanString($event->getName()),
            'description' => $this->cleanString($event->getDescription()),
            'location' => $this->cleanString($event->getLocation()),
            'date' => $this->cleanString($event->getDate()),
            'media_id' => intval($event->getMediaId())
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
            'id' => intval($event->getId()),
            'newName' => $this->cleanString($event->getName()),
            'newDescription' => $this->cleanString($event->getDescription()),
            'newLocation' => $this->cleanString($event->getLocation()),
            'newDate' => $this->cleanString($event->getDate()),
            'newMediaId' => intval($event->getMediaId())
        ];
        
        $query->execute($parameters);
    }

    public function deleteEvent(Event $event) : void
    {
        $query = $this->db->prepare('DELETE FROM events WHERE id = :event_id');

        $parameters = [
            'event_id' => intval($event->getId())
        ];

        $query->execute($parameters);
    }
}