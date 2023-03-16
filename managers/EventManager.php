<?php

class EventManager extends AbstractManager{
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM events');
        $query->execute();
        $events = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $events;
    }

    public function getEventById(int $id) : Event
    {
        $query = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $event = $query->fetch(PDO::FETCH_ASSOC);
        
        $newEvent= new Event($event['name'], $event['description'], $event['location']);
        
        $newEvent->setId($event['id']);
        
        return $newEvent;
    }
    
    public function insertEvent(Event $event) : Event
    {
        $query = $this->db->prepare('INSERT INTO events VALUES(:id, :name, :description, :location)');
        
        $parameters = [
        'id' => null,
        'name' => $event->getName(),
        'description' => $event->getDescription(),
        'location' => $event->getLocation(),
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $event->setId($id);

        $newEvent = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getEventById($id);
        
    }
    
    public function updateEvent(Event $event) : Event
    {
        $query = $this->db->prepare('UPDATE events SET name = :newName, description = :newDescription, location = :newLocation WHERE id = :id');
        
        $parameters = [
        'id' => $event->getId(),
        'newName' => $event->getName(),
        'newDescription' => $event->getDescription(),
        'newLocation' => $event->getLocation()
        ];
        
        $query->execute($parameters);

        $newEvent = $query->fetch(PDO::FETCH_ASSOC);
        return $newEvent;
        
    }
}