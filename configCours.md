# API ServiceCours

Ce fichier `getCours.php` implémente une API RESTful pour gérer les cours dans une base de données SQLite.

## Fonctionnalités

L'API prend en charge les opérations suivantes :

### 1. Récupérer tous les cours
- **Méthode HTTP** : `GET`
- **URL** : `/getCours.php`
- **Description** : Retourne la liste de tous les cours.
- **Exemple de réponse** :
  ```json
  {
    "success": true,
    "cours": [
      {
        "id": 1,
        "code": "CS101",
        "intitule": "Introduction à l'informatique",
        "volume_horaire": 30,
        "promotion": "2023",
        "semestre": "1",
        "annee_academique": "2023-2024"
      }
    ]
  }

### 2. Récupérer un cours par son code

### Méthode HTTP : GET
### URL : /getCours.php?code_cours={code}
### Description : Retourne les informations d'un cours spécifique.
Exemple de réponse :

{
  "nom": "Introduction à l'informatique"
}

### 3. Ajouter un cours
### Méthode HTTP : POST
### URL : /getCours.php
Corps de la requête (JSON)

{
  "code": "CS102",
  "intitule": "Programmation avancée",
  "volume_horaire": 40,
  "promotion": "2023",
  "semestre": "2",
  "annee_academique": "2024"
}

### Exemple de réponse 

{
  "success": true,
  "message": "Cours ajouté avec succès"
}

### 4. Mettre à jour un cours
### Méthode HTTP : PUT
URL : /getCours.php
Corps de la requête (JSON) :

{
  "id": 1,
  "code": "CS101",
  "intitule": "Introduction à l'informatique",
  "volume_horaire": 35,
  "promotion": "2023",
  "semestre": "1",
  "annee_academique": "2023-2024"
}

### Exemple de réponse
{
  "success": true,
  "message": "Cours mis à jour avec succès"
}

### 5. Supprimer un cours
Méthode HTTP : DELETE
URL : /getCours.php
Corps de la requête (JSON) :

{
  "success": true,
  "message": "Cours supprimé avec succès"
}

THE END
