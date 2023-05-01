<?php 

class HomeController extends PublicAbstractController
{

    private CatManager $catManager;
    private EventManager $eventManager;
    private PostManager $postManager;
    private MediaManager $mediaManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
        $this->eventManager = new EventManager();
        $this->postManager = new PostManager();
        $this->mediaManager = new MediaManager();
    }

    public function index()
    {
        $cats = $this->catManager->findLastThreeCats();
        $event = $this->eventManager->findLastEvent()[0];
        $eventMedia = $this->mediaManager->getMediaById($event->getMediaId());
        $posts = $this->postManager->findLastThreePost();

        $catsArray = [];
        foreach($cats as $cat){
            
            $medias = $this->mediaManager->findMediasByCatId($cat->getId());
    
            if(count($medias) > 0){

                $cat->setMainMediaUrl($medias[0]->getUrl());
            }

            $catsArray[] = $cat;
        }

        $pageInfos = [

            'title' => 'Homeless Kitten Association - Accueil',
            'main_id' => 'home'
        ];

        $this->render('home', "index", [$pageInfos, [$catsArray], [$event, $eventMedia], [$posts]]);
    }
}