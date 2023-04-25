<?php 

class FamilyManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM families');
        $query->execute();
        $families = $query->fetchAll(PDO::FETCH_ASSOC);

        $familiesArray = [];

        foreach($families as $family){

            $newFamily = new Family($family['name'], $family['description']);
            $newFamily->setId($family['id']);
            $familiesArray[] = $newFamily;
        }
        
        return $familiesArray;
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

    public function getFamilyIdByName(string $name) : int
    {
        $query = $this->db->prepare('SELECT * FROM families WHERE name = :name');

        $parameters = [
            'name' => $name
        ];

        $query->execute($parameters);

        $family = $query->fetch(PDO::FETCH_ASSOC);

        return $family['id'];
    }

    public function getFamilyNameById(int $familyId) : string
    {
        $query = $this->db->prepare('SELECT * FROM families WHERE id = :id');

        $parameters = [
            'id' => $familyId
        ];
            
        $query->execute($parameters);
        
        $family = $query->fetch(PDO::FETCH_ASSOC);

        return $family['name'];
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
    
    public function updateFamily(Family $family) : void
    {
        $query = $this->db->prepare('UPDATE families SET name = :newName, description = :newDescription WHERE id = :id');
        
        $parameters = [
        'id' => $family->getId(),
        'newName' => $family->getName(),
        'newDescription' => $family->getDescription()
        ];
        
        $query->execute($parameters);
        
    }

    public function findFamilyCats(Family $family) : array
    {
        $query = $this->db->prepare('SELECT * FROM cats WHERE cats.families_id = :family_id');

        $parameters = [
            'family_id' => $family->getId()
        ];

        $query->execute($parameters);

        $familyCats = [];
        $cats = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($cats as $cat){

            $newCat = new Cat($cat['name'], $cat['age'], $cat['sex'], $cat['color'], $cat['description'], $cat['is_sterilized']);
            $familyCats[] = $newCat;
        }
        
        return $familyCats;
    }

    public function deleteFamily(Family $family) : array
    {
        $query = $this->db->prepare('DELETE FROM families WHERE id = :id');

        $parameters = [

            'id' => $family->getId()
        ];

        $query->execute($parameters);

        return $this->findAll();
    }

    public function addMediaOnFamily(int $familyId, int $mediaId) : void
    {
        $query = $this->db->prepare('INSERT INTO families_medias VALUES(:medias_id, :families_id)');

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