<?php

class DiseaseManager extends AbstractManager{
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM diseases');
        $query->execute();
        $diseases = $query->fetchAll(PDO::FETCH_ASSOC);

        $diseasesArray = [];

        foreach($diseases as $disease){

            $newDisease = new Disease($disease['name'], $disease['description'], $disease['treatment']);
            $newDisease->setId($disease['id']);

            $diseasesArray[] = $newDisease;
        }
        
        return $diseasesArray;
    }

    public function getDiseaseById(int $id) : Disease
    {
        $query = $this->db->prepare('SELECT * FROM diseases WHERE id = :id');
        
        $parameters = [
        'id' => intval($id)
        ];
        
        $query->execute($parameters);
        
        $disease = $query->fetch(PDO::FETCH_ASSOC);
        
        $newDisease= new Disease($disease['name'], $disease['description'], $disease['treatment']);
        
        $newDisease->setId($disease['id']);
        
        return $newDisease;
    }
    
    public function insertDisease(Disease $disease) : Disease
    {
        $query = $this->db->prepare('INSERT INTO diseases VALUES(:id, :name, :description, :treatment)');
        
        $parameters = [
        'id' => null,
        'name' => $this->cleanString($disease->getName()),
        'description' => $this->cleanString($disease->getDescription()),
        'treatment' => $this->cleanString($disease->getTreatment()),
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $disease->setId($id);

        $newDisease = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getDiseaseById($id);
        
    }
    
    public function updateDisease(Disease $disease) : void
    {
        $query = $this->db->prepare('UPDATE diseases SET name = :newName, description = :newDescription, treatment = :newTreatment WHERE id = :id');
        
        $parameters = [
        'id' => intval($disease->getId()),
        'newName' => $this->cleanString($disease->getName()),
        'newDescription' => $this->cleanString($disease->getDescription()),
        'newTreatment' => $this->cleanString($disease->getTreatment())
        ];
        
        $query->execute($parameters);
        
    }

    public function deleteDisease(Disease $disease) : void
    {
        $query = $this->db->prepare('DELETE FROM diseases WHERE id = :disease_id');

        $parameters = [

            'disease_id' => intval($disease->getId())
        ];

        $query->execute($parameters);
    }
}