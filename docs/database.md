# Database

## Database tables:

- users
- cats
- families
- events
- publications
- medias

### users:

- id
- username
- first_name
- last_name
- email
- address
- password
- family_id

### cats:

- id
- name
- age
- sex
- color
- is_sterilized
- family_id

### diseases:

- id
- name
- description
- treatment

### cats_diseases:

- cat_id
- disease_id

### families:

- id
- name
- description

### events:

- id
- name
- description
- location

### posts:

- id
- title
- content
- user_id

### medias:

- id
- type
- format
- description
- url

### users_medias:

- users_id
- medias_id

### cats_medias:

- cat_id
- media_id

### families_medias:

- families_id
- medias_id

### posts_media:

- publication_id
- media_id

### events_medias:

- events_id
- medias_id

