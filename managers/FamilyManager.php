<?php 

class FamilyManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM families');
        $query->execute();
        $family = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $family;
    }

    public function getFamilyById(int $id) : Family
    {
        $query = $this->db->prepare('SELECT * FROM families WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $family = $query->fetch(PDO::FETCH_ASSOC);
        
        $newFamily= new Family($family['name'], $family['description']);
        
        $newFamily->setId($family['id']);
        
        return $newFamily;
    }
    
    public function insertFamily(Family $family) : Family
    {
        $query = $this->db->prepare('INSERT INTO families VALUES(:id, :name, :description)');
        
        $parameters = [
        'id' => null,
        'name' => $family->getName(),
        'description' => $family->getDescription()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $family->setId($id);

        $newFamily = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getFamilyById($id);
        
    }
    
    public function updateFamily(Family $family) : Family
    {
        $query = $this->db->prepare('UPDATE families SET name = :newName, description = :newDescription WHERE id = :id');
        
        $parameters = [
        'id' => $family->getId(),
        'newName' => $family->getName(),
        'newDescription' => $family->getDescription()
        ];
        
        $query->execute($parameters);

        $newFamily = $query->fetch(PDO::FETCH_ASSOC);
        return $newFamily;
        
    }

    public function addMediaOnFamily(int $familyId, int $mediaId) : void
    {
        $query = $this->db->prepare('INSERT INTO families_medias VALUES(:families_id, :medias_id)');

        $parameters = [
            'families_id' => $familyId,
            'medias_id' => $mediaId
        ];

        $query->execute($parameters);
    }

    public function deleteMediasOnFamily(Family $family) : void
    {
        $query = $this->db->prepare('DELETE FROM families_medias WHERE families_id = :families_id');

        $parameters = [

            'families_id' => $family->getId()
        ];

        $query->execute($parameters);
    }

    public function deleteMediaOnFamiliesMedias(Family $family, Media $media)
    {
        $query = $this->db->prepare('DELETE FROM families_medias WHERE families_id = :families_id AND medias_id = :medias_id');

        $parameters = [

            'families_id' => $family->getId(),
            'medias_id' => $media->getId()
        ];

        $query->execute($parameters);
    }
}