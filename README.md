<div align="center">

# Reservy — Backend (API)

**API REST pour la plateforme de réservation Reservy — Cafés & Restaurants**

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Laravel_Sanctum-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

</div>

---

## Présentation

Reservy est une plateforme web centralisée de mise en relation entre clients finaux et gérants de cafés/restaurants. Ce dépôt contient l'**API REST** développée avec Laravel, qui gère l'authentification, les rôles, les établissements, les menus, les réservations, les pré-commandes et les avis clients.

---

## Problématique

Les clients ont du mal à trouver des places disponibles lors des heures de pointe (matchs, soirées, week-ends) et à gérer les temps d'attente sur place. Parallèlement, les gérants manquent d'outils numériques centralisés pour optimiser leurs réservations et leur visibilité en ligne.

## Objectifs

Digitaliser le processus de réservation et de pré-commande pour les cafés et restaurants, en offrant une expérience fluide côté client et une gestion optimisée côté professionnels.

---

## Fonctionnalités de l'API (par Epic)

### Epic 1 — Authentification et sécurité

* Inscription et connexion via API (Laravel Breeze / Sanctum).
* Gestion des rôles (SuperAdmin, Gérant, Client) via Spatie Permission / Laratrust.
* Seeders pour les rôles par défaut.
* Protection des routes API par middleware selon le rôle.

### Epic 2 — Gestion des établissements et menus (B2B)

* CRUD complet du profil d'un établissement (nom, adresse, photos, horaires).
* CRUD des catégories et produits du menu, avec prix.
* Relations Eloquent entre établissements, catégories et produits.

### Epic 3 — Découverte, réservation et pré-commande (B2C)

* Endpoint de recherche et filtrage des établissements (ville, nom).
* Gestion des réservations (date, heure, nombre de personnes).
* Gestion des pré-commandes liées à une réservation (`commande_items`).
* Soumission de réservation en transaction base de données.
* Changement de statut d'une réservation (En attente → Acceptée / Refusée / Terminée).

### Epic 4 — Avis et administration globale

* CRUD des avis clients (note en étoiles + commentaire).
* Calcul de la moyenne des notes par établissement.
* Validation des établissements par le Super Admin (`est_valide`).

---

## Stack technique

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Sanctum-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Spatie](https://img.shields.io/badge/Spatie_Permission-FF2D20?style=flat-square&logo=laravel&logoColor=white)

</div>

* **Framework :** Laravel (Architecture MVC, API REST)
* **Base de données :** MySQL
* **Authentification :** Laravel Breeze / Sanctum (tokens API)
* **Gestion des rôles :** Spatie Permission (ou Laratrust)
* **ORM :** Eloquent

---

## Modèle de données (principales entités)

| Table | Rôle |
|---|---|
| `users` | Comptes utilisateurs (Admin, Gérant, Client) |
| `etablissements` | Profils des cafés/restaurants |
| `categories` | Catégories du menu d'un établissement |
| `produits` | Plats/produits avec leurs prix |
| `reservations` | Réservations des clients (date, heure, personnes, statut) |
| `commande_items` | Produits pré-commandés liés à une réservation |
| `reviews` | Avis et notes laissés par les clients |

---

## Installation en local

### 1. Prérequis

* PHP 8.2 ou supérieur
* Composer
* MySQL
* Git

### 2. Cloner le dépôt

```bash
git clone https://github.com/AITABBOUyoussef/reservy-backend.git
cd reservy-backend
```

### 3. Installer les dépendances

```bash
composer install
```

### 4. Configurer l'environnement

```bash
cp .env.example .env
```

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservy
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Générer la clé et migrer la base de données

```bash
php artisan key:generate
php artisan migrate --seed
```

### 6. Lancer le serveur

```bash
php artisan serve
```

L'API sera accessible sur :

```
http://localhost:8000/api
```

---

## Dépôts liés

* [Reservy — Frontend (React)](https://github.com/AITABBOUyoussef/reservy-frontend)

---

## Auteur

**Youssef Ait Abbou**
Étudiant en Développement Web Full-Stack | École Numérique Ahmed El Hansali
