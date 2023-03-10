<?php 

class UserManager extends AbstractManager{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $user = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function getUserById(int $id) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUser= new User($user['username'], $user['first_name'], $user['last_name'], $user['email'], $user['address'], $user['role'], $user['password']);
        
        $newUser->setId($user['id']);
        $newUser->setFamily($user['family']);
        
        return $newUser;
    }
    
    public function insertUser(User $user) : User
    {
        $query = $this->db->prepare('INSERT INTO users VALUES(:id, :username, :first_name, :last_name, :email, :address, :role, :password, :family)');
        
        $parameters = [
        'id' => null,
        'username' => $user->getUsername(),
        'first_name' => $user->getFirstName(),
        'last_name' => $user->getLastName(),
        'email' => $user->getEmail(),
        'address' => $user->getAddress(),
        'role' => $user->getRole(),
        'password' => $user->getPassword(),
        'family' => $user->getFamily()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $user->setId($id);

        $newuser = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getUserById($id);
        
    }
    
    public function updateUser(User $user) : User
    {
        $query = $this->db->prepare('UPDATE users SET username = :newUsername, first_name = :newFirst_name, last_name = :newLast_name, email = :newEmail, address = :newAddress, role = :newRole, family = newFamily WHERE id = :id');
        
        $parameters = [
        'id' => $user->getId(),
        'newUsername' => $user->getUsername(),
        'newFirst_name' => $user->getFirstName(),
        'newLast_name' => $user->getLastName(),
        'newEmail' => $user->getEmail(),
        'newAddress' => $user->getAddress(),
        'newRole' => $user->getRole(),
        'newFamily' => $user->getFamily()
        ];
        
        $query->execute($parameters);

        $newUser = $query->fetch(PDO::FETCH_ASSOC);
        return $newUser;
        
    }
}