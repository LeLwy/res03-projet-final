<?php 

class PrivateUserController extends PrivateAbstractController
{
    private UserManager $userManager;

    public function __construct(){

        $this->userManager = new UserManager();
    }
    
    public function index(){

        $users = $this->userManager->findAll();
        $this->render('user', 'index', [$users]);
    }

    public function show(int $id)
    {
        $user = $this->userManager->getuserById($id);
        $this->render('user', 'single', ['user' =>$user]);
    }

    public function create()
    {
        $this->render('user', 'create', []);
    }

    public function update($user)
    {
        $user = $this->userManager->updateuser($user);
        $this->render('user', 'edit', ['user' =>$user]);
    }
}