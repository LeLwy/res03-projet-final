# Technical Sheet:

## Back-end:

[![A computer screen with code scrolling](/assets/medias/images/coding.jpg "Photo by Luis Gomes")](https://www.pexels.com/fr-fr/photo/ordinateur-portable-noir-et-gris-546819/)

### Models (whith CRUD):

- User
- Cat
- Post
- Event
- Family
- Disease

### Controllers:

<!-- #### PageController: 

- Call to PostManager
- Call to FamilyManager
- Call to CatManager
- Call to EventManager -->

#### UserController: 

- Call to UserManager
- Call to PostManager
- Call to MediaManager
- Call to FamilyManager

#### CatController: 

- Call to CatManager
- Call to FamilyManager
- Call to MediaManager
- Call to DiseasesManager

#### PostController:

- Call to PostManager
- Call to UserManager
- Call to MediaManager

#### EventController 

- Call to EventManager
- Call to MediaManager

#### FamilyController:

- Call to FamilyManager
- Call to UserManager
- Call to MediaManager
- Call to CatManager

#### DiseaseController:

- Call to DiseaseManager
- Call to CatManager

### Managers:

#### UserManager:

- 

### Database:

[![Database conception](/assets/medias/images/database-conception.png "Made with MySQL Workbench")]

## Front-end:

### Website pages:

- home
- about
- to-adoption
- donation
- join-us
- events
- blog
- families