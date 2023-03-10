<?php 

class MediaManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM medias');
        $query->execute();
        $media = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $media;
    }

    public function getMediaById(int $id) : Media
    {
        $query = $this->db->prepare('SELECT * FROM medias WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $media = $query->fetch(PDO::FETCH_ASSOC);
        
        $newMedia= new Media($media['type'], $media['format'], $media['description'], $media['url'], $media['source']);
        
        $newMedia->setId($media['id']);
        
        return $newMedia;
    }
    
    public function insertMedia(Media $media) : Media
    {
        $query = $this->db->prepare('INSERT INTO medias VALUES(:id, :type, :format, :description, :url, :source)');
        
        $parameters = [
        'id' => null,
        'type' => $media->getType(),
        'format' => $media->getFormat(),
        'description' => $media->getDescription(),
        'url' => $media->getUrl(),
        'source' => $media->getSource()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $media->setId($id);

        $newMedia = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getMediaById($id);
        
    }
    
    public function updateMedia(Media $media) : Media
    {
        $query = $this->db->prepare('UPDATE medias SET type = :newType, format = :newFormat, description = :newDescription, url = :newUrl, source = :newSource WHERE id = :id');
        
        $parameters = [
        'id' => $media->getId(),
        'newType' => $media->getType(),
        'newFormat' => $media->getFormat(),
        'newDescription' => $media->getDescription(),
        'newUrl' => $media->getUrl(),
        'newSource' => $media->getSource()
        ];
        
        $query->execute($parameters);

        $newMedia = $query->fetch(PDO::FETCH_ASSOC);
        return $newMedia;
        
    }
}