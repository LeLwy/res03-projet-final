<?php 

class PrivateMediaController extends PrivateAbstractController 
{
    private MediaManager $mediaManager;

    public function __construct(){

        $this->mediaManager = new MediaManager();
    }
    
    public function index(){
        
        $medias = $this->mediaManager->findAll();
        $this->render('media', 'index', [$medias]);
    }

    public function show(int $id)
    {
        $media = $this->mediaManager->getMediaById($id);
        $this->render('media', 'single', ['media' =>$media]);
    }

    public function create()
    {
        $this->render('media', 'create', []);
    }

    public function update($media)
    {
        $media = $this->mediaManager->updateMedia($media);
        $this->render('media', 'edit', ['media' =>$media]);
    }
}