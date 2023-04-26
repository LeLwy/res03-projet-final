<?php 

class UserController extends PublicAbstractController
{

    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    
    public function index()
    {

        $pageInfos = [

            'title' => 'Les bénévoles de l\'association',
        ];

        $users = $this->userManager->findAll();
        $this->render('user', 'index', [$pageInfos, $users]);
    }
    
    public function show(int $id)
    {
        $user = $this->userManager->getUserById($id);
        $userName = $user->getFirstName();

        $pageInfos = [

            'title' => 'Le profil de: '.$userName,
        ];

        $this->render('user', 'single', [$pageInfos, ['user' => $user]]);
    }
}