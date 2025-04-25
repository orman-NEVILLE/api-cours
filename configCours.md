# Service Cours

Ce projet est un service PHP permettant de gérer les cours dans une base de données. Il prend en charge les opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) pour les cours.

## Fonctionnalités

Le service prend en charge les cas suivants :

1. **Récupération de tous les cours**  
   - Retourne tous les cours enregistrés dans la base de données.
   - **URL** : `https://api-cours.onrender.com/getCours.php`
   - **Méthode** : GET
   - **Paramètres** : Aucun.
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
           "annee_academique": "2024"
         }
       ]
     }
     ```

2. **Récupération d'un cours spécifique**  
   - Retourne les informations d'un cours donné.
   - **URL** : `https://api-cours.onrender.com/getCours.php`
   - **Méthode** : GET
   - **Paramètres** : `code_cours` (code du cours).
   - **Exemple de réponse** :
     ```json
     {
       "nom": "Introduction à l'informatique"
     }
     ```

3. **Ajout d'un nouveau cours**  
   - Permet d'ajouter un cours dans la base de données.
   - **URL** : `/getCours.php`
   - **Méthode** : POST
   - **Données** (JSON) :
     ```json
     {
       "code": "CS102",
       "intitule": "Programmation avancée",
       "volume_horaire": 40,
       "promotion": "2023",
       "semestre": "2",
       "annee_academique": "2023-2024"
     }
     ```
   - **Exemple de réponse** :
     ```json
     {
       "success": true,
       "message": "Cours ajouté avec succès"
     }
     ```

4. **Mise à jour d'un cours**  
   - Permet de mettre à jour les informations d'un cours existant.
   - **URL** : https://api-cours.onrender.com/getCours.php?id=1
   - **Méthode** : PUT
   - **Données** (JSON) :
     ```json
     {
       "id": 1,
       "code": "CS101",
       "intitule": "Introduction à l'informatique",
       "volume_horaire": 35,
       "promotion": "2023",
       "semestre": "1",
       "annee_academique": "2023-2024"
     }
     ```
   - **Exemple de réponse** :
     ```json
     {
       "success": true,
       "message": "Cours mis à jour avec succès"
     }
     ```

5. **Suppression d'un cours**  
   - Permet de supprimer un cours de la base de données.
   - **URL** : https://api-cours.onrender.com/getCours.php?id=1
   - **Méthode** : DELETE
   - **Données** (JSON) :
     ```json
     {
       "id": 1
     }
     ```
   - **Exemple de réponse** :
     ```json
     {
       "success": true,
       "message": "Cours supprimé avec succès"
     }
     ```

## Structure des Réponses

Les réponses sont au format JSON. Exemple pour une requête réussie :
```json
{
  "success": true,
  "message": "Opération réussie"
}
