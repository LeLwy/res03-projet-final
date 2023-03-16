<?php

class DiseaseManager extends AbstractManager{
    
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM diseases');
        $query->execute();
        $diseases = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $diseases;
    }

    public function getDiseaseById(int $id) : Disease
    {
        $query = $this->db->prepare('SELECT * FROM diseases WHERE id = :id');
        
        $parameters = [
        'id' => $id
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
        'name' => $disease->getName(),
        'description' => $disease->getDescription(),
        'treatment' => $disease->getTreatment(),
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $disease->setId($id);

        $newDisease = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getDiseaseById($id);
        
    }
    
    public function updateDisease(Disease $disease) : Disease
    {
        $query = $this->db->prepare('UPDATE diseases SET name = :newName, description = :newDescription, treatment = :newTreatment WHERE id = :id');
        
        $parameters = [
        'id' => $disease->getId(),
        'newName' => $disease->getName(),
        'newDescription' => $disease->getDescription(),
        'newTreatment' => $disease->getTreatment()
        ];
        
        $query->execute($parameters);

        $newDisease = $query->fetch(PDO::FETCH_ASSOC);
        return $newDisease;
        
    }
}