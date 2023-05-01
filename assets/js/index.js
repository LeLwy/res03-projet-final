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
})