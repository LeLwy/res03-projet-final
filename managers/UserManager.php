<?php 

class UserManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        $usersArray = [];

        foreach($users as $user){

            $newUser = new User($user['first_name'], $user['last_name'], $user['email'], $user['address'], $user['password'], $user['media_id'], $user['family_id']);
            $newUser->setId($user['id']);
            $newUser->setRole($user['role']);
            $newUser->setStatus($user['status']);
            $usersArray[] = $newUser;
        }
        
        return $usersArray;
    }

    public function getUserById(int $id) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        
        $parameters = [
            'id' => $id
        ];
        
        $query->execute($parameters);
        
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUser= new User($user['first_name'], $user['last_name'], $user['email'], $user['address'], $user['password'], $user['media_id'], $user['family_id']);
        
        $newUser->setId($user['id']);
        $newUser->setStatus($user['status']);
        $newUser->setRole($user['role']);
        
        return $newUser;
    }

    public function getUserByEmail(string $email) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');

        $parameters = [
            'email' => $email
        ];
        
        $query->execute($parameters);
        
        $user = $query->fetch(PDO::FETCH_ASSOC);

        $newUser= new User($user['first_name'], $user['last_name'], $user['email'], $user['address'], $user['password'], $user['media_id'], $user['family_id']);
        
        $newUser->setId($user['id']);
        $newUser->setStatus($user['status']);
        $newUser->setRole($user['role']);
        
        return $newUser;
    }

    public function verifyExistingEmail(string $email) : bool
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');

        $parameters = [
            'email' => $email
        ];
        
        $query->execute($parameters);

        $existingEmail = $query->fetch(PDO::FETCH_ASSOC);

        if($existingEmail){

            return true;
        }else{

            return false;
        }
    }
    
    public function insertUser(User $user) : User
    {
        $query = $this->db->prepare('INSERT INTO users VALUES(:id, :first_name, :last_name, :email, :address, :role, :status, :password, :media_id, :family_id)');
        
        $parameters = [
            'id' => null,
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'address' => $user->getAddress(),
            'role' => $user->getRole(),
            'status' => $user->getStatus(),
            'password' => $user->getPassword(),
            'media_id' => $user->getMediaId(),
            'family_id' => $user->getFamilyId()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $user->setId($id);

        $newuser = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getUserById($id);
        
    }
    
    public function updateUser(User $user) : void
    {
        $query = $this->db->prepare('UPDATE users SET first_name = :newFirst_name, last_name = :newLast_name, email = :newEmail, address = :newAddress, role = :newRole, status = :newStatus, password = :newPassword, media_id = :newMediaId, family_id = :newFamilyId WHERE id = :id');
        
        $parameters = [
            'id' => $user->getId(),
            'newFirst_name' => $user->getFirstName(),
            'newLast_name' => $user->getLastName(),
            'newEmail' => $user->getEmail(),
            'newAddress' => $user->getAddress(),
            'newRole' => $user->getRole(),
            'newStatus' => $user->getStatus(),
            'newPassword' => $user->getPassword(),
            'newMediaId' => $user->getMediaId(),
            'newFamilyId' => $user->getFamilyId()
        ];
        
        $query->execute($parameters);        
    }

    public function deleteUser(User $user) : void
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id = :user_id');

        $parameters = [
            'user_id' => $user->getId()
        ];

        $query->execute($parameters);
    }
}