<?php 

class ContactController extends PublicAbstractController
{

    public function index($post)
    {
        $errorMessage = "";
        
        $pageInfos = [

            'title' => 'Contacter l\'association - Homeless Kitten Association',
            'main_id' => 'contact'
        ];
         
        // vérification de la soumission du formulaire  
        if(isset($post['contactFormName'])){

            // récupération des champs du formulaire
            if(isset($post["contactName"])&&!empty($post["contactName"])
            && isset($post["contactEmail"]) && !empty($post["contactEmail"])
            && filter_var($post["contactEmail"], FILTER_VALIDATE_EMAIL)
            && isset($post["contactMessage"]) && !empty($post["contactMessage"])){

                /***** Thanks to Funk Forty Niner on https://stackoverflow.com/ *****/

                $to = "louis.chancioux@3wa.io"; // adresse email de destination
                $from = htmlspecialchars($post["contactEmail"]); // adresse email d'expédition
                $name = htmlspecialchars($post["contactName"]); // nom de l'expéditeur
                $subject = "Message pour l'association"; // message de l'expéditeur
                $message = $name . " a envoyé:" . "\n\n" . htmlspecialchars($post["contactMessage"]); // message pour le destinataire
            
                $headers = "Envoyé par:" . $from;
                mail($to,$subject,$message,$headers); // envoi du mail au destinataire

                }else{

                $errorMessage = "Veuillez remplir les champs du formulaire";
                // si il n'existe pas renvoyer vers la page de connexion
                $this->render("form", "contact", [$pageInfos, $errorMessage]);  
            }
        }else{

            $this->render('form', 'contact', [$pageInfos]);
        }
    }
}