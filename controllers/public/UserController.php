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

            'title' => 'Les bénévoles de l\'association - Homeless Kitten Association',
            'main_id' => 'volunteers'
        ];

        $users = $this->userManager->findAll();
        $this->render('volunteers', 'index', [$pageInfos, $users]);
    }
    
    public function show(int $id)
    {
        $user = $this->userManager->getUserById($id);
        $userName = $user->getFirstName();

        $pageInfos = [

            'title' => 'Le profil de: '.$userName.' - Homeless Kitten Association',
            'main_id' => 'volunteers-single'
        ];

        $this->render('volunteers', 'single', [$pageInfos, ['user' => $user]]);
    }
}