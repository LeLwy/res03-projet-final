<?php 

class PrivateUserController extends PrivateAbstractController
{
    private UserManager $userManager;
    private FamilyManager $familyManager;
    private MediaManager $mediaManager;
    private Uploader $uploader;

    public function __construct(){

        $this->userManager = new UserManager();
        $this->familyManager = new FamilyManager();
        $this->mediaManager = new MediaManager();
        $this->uploader = new Uploader();
    }
    
    public function index(){

        $users = $this->userManager->findAll();
        $this->render('user', 'index', $users);
    }

    public function show(int $id)
    {
        $user = $this->userManager->getuserById($id);
        $media = $this->mediaManager->getMediaById($user->getMediaId());
        $this->render('user', 'single', [['user' =>$user], $media]);
    }

    public function profil(int $id)
    {
        $user = $this->userManager->getuserById($id);
        $media = $this->mediaManager->getMediaById($user->getMediaId());
        $this->render('user', 'profil', [['user' =>$user], $media]);
    }
   
    public function create(array $post) : void  
    {
        $users = $this->userManager->findAll();
        $families = $this->familyManager->findAll();

        $error = "";

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }
            if($error !== ""){
                
                echo $error;

            }else{

                $emailExist = false;

                foreach($users as $user){

                    if($user->getEmail() === $post['user-email']){

                        $emailExist = true;
                        $error = "Cette adresse mail est déjà utilisée";
                        break;
                    }
                }
                if($emailExist){

                    echo $error;

                }else if(!filter_var($post['user-email'], FILTER_VALIDATE_EMAIL)){

                    $error = "L'adresse email saisie est invalide'";
                    echo $error;

                }else if($post['user-password'] !== $post['user-confirm-password']){

                    $error = "Les mots de passe ne correspondent pas";
                    echo $error;

                }else{
    
                    $media = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'user-medias'));
                    $familyId = $this->familyManager->getFamilyIdByName($post['user-family']);

                    $user = new User($post['user-firstname'], $post['user-lastname'], $post['user-email'], $post['user-address'], password_hash($post['user-password'], PASSWORD_DEFAULT), $media->getId(), $familyId);
                    $user->setRole($post['user-role']);
                    $user->setStatus($post['user-status']);
                    $newUser = $this->userManager->insertUser($user);
    
                    header('Location: /res03-projet-final/admin/index-des-utilisateurs');

                }
            }
            
        }else{

            $this->render("user", "create", $families);
        }  
    }

    public function update(array $post, int $id)
    {
        $users = $this->userManager->findAll();
        $userToUpdate = $this->userManager->getUserById($id);
        $userFamilyName = $this->familyManager->getFamilyNameById($userToUpdate->getFamilyId());

        $families = $this->familyManager->findAll();

        $error = "";

        if(isset($post) && !empty($post)){

            foreach($post as $field){

                if(empty($field)){
    
                    $error = "Tous les champs ne sont pas remplis";
                }
            }
            if($error !== ""){
                
                echo $error;

            }else{

                $emailExist = false;

                foreach($users as $userToVerify){

                    if($userToVerify->getEmail() === $post['user-email']){

                        $emailExist = true;
                        $error = "Cette adresse mail est déjà utilisée";
                        break;
                    }
                }
                if($emailExist && $userToVerify->getEmail() !== $userToUpdate->getEmail()){

                    echo $error;

                }else if(!filter_var($post['user-email'], FILTER_VALIDATE_EMAIL)){

                    $error = "L'adresse email saisie est invalide";
                    echo $error;

                }else{
    
                    $media = $this->mediaManager->getMediaById($userToUpdate->getMediaId());
                    $familyId = $this->familyManager->getFamilyIdByName($post['user-family']);
                    $password = $userToUpdate->getPassword();

                    if($_FILES['user-medias']['name'] === ""){

                        $newMedia = $this->mediaManager->getMediaById($userToUpdate->getMediaId());
                        $media = null;

                    }else{

                        $newMedia = $this->mediaManager->insertMedia($this->uploader->upload($_FILES, 'user-medias'));
                    }
                    
                    $userToUpdate = new User($post['user-firstname'], $post['user-lastname'], $post['user-email'], $post['user-address'], $password, $newMedia->getId(), $familyId);
                    $userToUpdate->setId($id);
                    $userToUpdate->setRole($post['user-role']);
                    $userToUpdate->setStatus($post['user-status']);
                    $userToUpdate = $this->userManager->updateUser($userToUpdate);
                    
                    if($media !== null){

                        $this->mediaManager->deleteMedia($media);
                    }
                    
    
                    header('Location: /res03-projet-final/admin/index-des-utilisateurs');

                }
            }
            
        }else{

            $this->render("user", "edit", [['user' => $userToUpdate], $families, $userFamilyName]);
        }
    }

    public function delete($id)
    {
        $user = $this->userManager->getUserById($id);
        $media = $this->mediaManager->getMediaById($user->getMediaId());

        $this->userManager->deleteUser($user);
        $this->mediaManager->deleteMedia($media);

        header('Location: /res03-projet-final/admin/index-des-utilisateurs');
    }
}