# Technical Sheet:

## Back-end:

[![A computer screen with code scrolling](/coding.jpg "Photo by Luis Gomes")](https://www.pexels.com/fr-fr/photo/ordinateur-portable-noir-et-gris-546819/)

### Models (whith CRUD):

#### User:

##### Attributes:

- _int_ id
- _string_ username
- _string_ firstName
- _string_ lastName
- _string_ email
- _string_ address
- _string_ password
- _Media_ profilPicture
- _Family_ family

##### Constructor:

(_string_ username, _string_ fristName, _string_ lastName, _string_ email, _string_ address, _string_ password)

#### Cat:

##### Attributes:

- _int_ id
- _string_ name
- _string_ age
- _string_ sex
- _string_ color
- _string_ isSterilized
- _Family_ family
- _array_ photos

##### Constructor:

(_string_ name, _string_ age, _string_ sex, _string_ color, _string_ isSterilized, _Family_ Family)

#### Media:

##### Attributes:

- _int_ id
- _string_ type
- _string_ format
- _string_ description
- _string_ url
- _string_ alt

##### Constructor:

(_string_ type, _string_format, _string_ description, _string_ url, _string_ alt)

#### Post:

##### Attributes:

- _int_ id
- _string_ title
- _string_ content
- _User_ author
- _array_ medias

##### Constructor:

(_string_ title, _string_ content)

#### Event:

##### Attributes:

- _int_ id
- _string_ name
- _string_ description
- _string_ location
- _string_ date
- _array_ medias

##### Constructor:

(_string_ name, _string_, description, _string_ location, _string_ date)

#### Family:

##### Attributes:

- _int_ id
- _string_ name
- _string_ description

##### Constructor:

(_string_ name, _string_description)

#### Disease:

##### Attributes:

- _int_ id
- _string_ name
- _string_ description
- _string_ treatment

##### Constructor:

(_string_ name, _string_ description, _string_ treatment)


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

[![Database conception](/database-conception.png "Made with MySQL Workbench")]

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