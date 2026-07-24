# CoRide – Application Web Laravel de Covoiturage Inter-Entreprise avec Matching IA

## Description

CoRide est une application web développée avec Laravel permettant aux employés d'entreprises partenaires de partager leurs trajets domicile-travail.

L'application permet de :

* Authentifier les employés avec Laravel Breeze.
* Publier des trajets.
* Rechercher des trajets disponibles.
* Réserver une place.
* Gérer les réservations.
* Calculer un score de compatibilité entre un passager et un trajet grâce à une brique IA.

---

# Technologies utilisées

* Laravel 13
* PHP 8.3
* MySQL
* Laravel Breeze
* Blade
* Eloquent ORM
* Tailwind CSS
* Laravel AI SDK (installé)
* Git & GitHub

---

# Architecture du projet

Le projet suit l'architecture MVC de Laravel.

## Models

* User
* Trajet
* Reservation
* Ville

## Controllers

* DashboardController
* TrajetController
* ReservationController
* Auth Controllers (Laravel Breeze)

## Requests

Les Form Requests permettent de valider les données utilisateur avant leur enregistrement.

Exemples :

* StoreReservationRequest
* UpdateReservationStatusRequest

## Relations Eloquent

User

* possède plusieurs trajets (conducteur)
* possède plusieurs réservations (passager)

Trajet

* appartient à un conducteur
* possède plusieurs réservations

Reservation

* appartient à un trajet
* appartient à un passager

---

# Brique IA

L'objectif principal de la brique IA est de déterminer si un trajet est réellement adapté à un passager.

Contrairement à un simple filtre SQL, l'algorithme analyse plusieurs critères.

Critères utilisés :

* Ville de départ
* Ville d'arrivée
* Compatibilité des horaires
* Compatibilité des jours
* Disponibilité des places

Chaque critère ajoute un nombre de points afin d'obtenir un score final sur 100.

Le résultat généré contient :

* score
* compatible (Oui / Non)
* niveau
* justification
* horaire suggéré

Exemple :

```json
{
    "score":90,
    "compatible":true,
    "niveau":"Excellent",
    "justification":"Même ville de départ, même destination, horaire très proche et jours compatibles.",
    "horaire_suggere":"08:15"
}
```

Le résultat est enregistré dans la colonne **ai_result** de la table **reservations** grâce à un Cast Laravel (AiResultCast).

Il est ensuite affiché dans la page de détail de la réservation.

---

# Fonctionnement du Matching

1. Le passager choisit un trajet.
2. Les informations du trajet et du passager sont comparées.
3. CalculateCompatibility calcule le score.
4. MatchingAgent retourne le résultat.
5. Le résultat est sauvegardé dans la réservation.
6. Le score est affiché dans l'interface.

---

# Base de données

Principales tables :

* users
* entreprises
* villes
* trajets
* reservations

---

# Installation

```bash
git clone https://github.com/aiga-youcan/CoRide.git

cd CoRide

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm run build

php artisan serve
```

---

# Fonctionnalités

* Authentification
* Gestion des trajets
* Gestion des réservations
* Tableau de bord
* Validation avec Form Requests
* Relations Eloquent
* Calcul de compatibilité
* Affichage du score IA
* Architecture MVC

---
Framework : Laravel 13.
