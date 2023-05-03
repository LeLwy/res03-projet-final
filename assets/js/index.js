/***** CONTACT FORM VERIFICATION *****/

function checkContactForm() {

    let contactForm = document.getElementById('contact-form');

    contactForm.addEventListener('submit', function(e) {

        let contactName = document.getElementById('contactName').value.trim();
        let contactEmail = document.getElementById('contactEmail').value.trim();
        let contactMessage = document.getElementById('contactMessage').value.trim();

        if (contactName.length < 2) {
            alert('Votre prénom doit faire au moins 2 caractères.');
            e.preventDefault();
            return;
        }

        if (contactEmail === '') {
            alert('Veuillez renseigner votre email.');
            e.preventDefault();
            return;
        }

        if (contactMessage.length < 15) {
            alert('Votre message doit faire au moins 15 caractères.');
            e.preventDefault();
            return;
        }

        // Si toutes les vérifications sont passées, on peut soumettre le formulaire
        alert('Votre message a bien été envoyé, nous reviendrons vers vous dans les plus brefs délais');
        contactForm.submit();
    });

}

window.addEventListener('DOMContentLoaded', function(){

    /***** MENU BURGER HEADER *****/

    let burgerCross = document.getElementById('burger-menu-cross');
    let burgerBars = document.getElementById('burger-menu-bars');
    let headerNav = document.getElementById('header-navigation-menu');
    let headerNavLogo = document.getElementById('header-navigation-logo');
    let homeBanner = document.getElementById('hka-home-banner');

    let burgerMenuElts = document.querySelectorAll('header > .burgerMenuElt');

    for(let i=0; i<burgerMenuElts.length; i++){

        burgerMenuElts[i].addEventListener('click', function(){

            burgerCross.classList.toggle('inactive');
            burgerBars.classList.toggle('inactive');
            headerNav.classList.toggle('active');
            headerNavLogo.classList.toggle('inactive');
            homeBanner.classList.toggle('inactive');
        })
    }

    let mainContainer = document.querySelector('main');
    let mainContainerId = mainContainer.getAttribute('id');
    
    if(mainContainerId === 'hka-page-contact'){
        
        /***** CONTACT FORM VERIFICATION *****/
        
        let contactForm = document.getElementById('contact-form');
        contactForm.addEventListener('submit', checkContactForm);
        
    }else if(mainContainerId === 'hka-page-adoption-single'){
        
        /***** CAT SINGLE PAGE GALERY *****/
        
        let mainPhoto = document.getElementById('hka-main-single-cat-page-photo');
        let galeryPhotos = document.querySelectorAll('img.hka-single-cat-page-galery-photo');
        
        for(let i=0; i<galeryPhotos.length; i++){
    
            galeryPhotos[i].addEventListener('click', function(){
    
                let link = galeryPhotos[i].getAttribute('src');
                mainPhoto.setAttribute('src', link);
            
            })
        }
    }
})