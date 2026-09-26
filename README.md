# Reservy Backend

API REST Laravel de Reservy. Elle gere l'authentification, les roles, les etablissements, les menus, les tables, les reservations et les commandes.

## Fonctionnalites

- Inscription, connexion, deconnexion et connexion Google.
- Tokens d'authentification avec Laravel Sanctum.
- Roles `client`, `gerant` et `admin` avec Spatie Laravel Permission.
- Reinitialisation du mot de passe par e-mail.
- Creation et moderation des etablissements.
- Gestion des images d'etablissements et de produits.
- Gestion des tables, categories, produits et options.
- Reservations et produits associes aux reservations.
- Controle d'appartenance : un gerant ne peut modifier que son propre etablissement.
- Validation des donnees avec des messages en francais.

## Technologies

- PHP 8.2+
- Laravel 12
- Laravel Sanctum
- Laravel Socialite
- Spatie Laravel Permission
- Cloudinary Laravel
- SQLite ou MySQL

## Prerequis

- PHP 8.2 ou version ulterieure
- Composer 2
- Une base SQLite ou MySQL
- Extensions PHP : `pdo`, `pdo_sqlite` ou `pdo_mysql`, `mbstring`, `openssl`, `xml`, `ctype`, `json`, `fileinfo`

## Installation Windows

Depuis ce dossier :

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Pour SQLite :

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
php artisan migrate --seed
```

Pour MySQL, configurez d'abord les variables `DB_*` dans `.env`, puis executez :

```powershell
php artisan migrate --seed
```

Lancez ensuite l'API :

```powershell
php artisan serve
```

L'API est disponible sur `http://127.0.0.1:8000/api`.

## Variables d'environnement

Les variables principales sont :

```env
APP_URL=http://localhost
FRONTEND_URL=http://localhost:5173

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=log

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://localhost:5173
```

Selon le stockage choisi, configurez aussi les variables Cloudinary ou les variables du filesystem utilisees par l'application.

Ne versionnez jamais `.env`, les cles privees, les tokens, `APP_KEY`, les identifiants Google ou les identifiants Cloudinary. `FRONTEND_URL` est utilise pour construire le lien de reinitialisation du mot de passe.

## Commandes utiles

```powershell
# Serveur de developpement
php artisan serve

# Migrations
php artisan migrate
php artisan migrate:fresh --seed

# Nettoyage de configuration
php artisan config:clear
php artisan cache:clear

# Tests
php artisan test

# Formatage Laravel
vendor\bin\pint
```

## Routes principales

Toutes les routes sont prefixees par `/api`.

### Routes publiques

| Methode | Route | Description |
|---|---|---|
| POST | `/login` | Connexion classique |
| POST | `/Register` | Inscription |
| POST | `/auth/google` | Connexion Google avec access token |
| POST | `/forgot-password` | Demande de reinitialisation |
| POST | `/reset-password` | Reinitialisation du mot de passe |
| GET | `/GetEtablissement` | Etablissements acceptes avec produits |
| POST | `/GetEtablissementDet` | Details d'un etablissement |

### Routes authentifiees

Toutes les routes suivantes demandent un token Sanctum :

| Methode | Route | Acces |
|---|---|---|
| POST | `/logout` | Tous les utilisateurs |
| POST | `/editProfil` | Tous les utilisateurs |
| POST | `/destroy` | Tous les utilisateurs |
| GET/POST/PUT/PATCH/DELETE | `/reservations` | Utilisateurs authentifies |
| POST | `/commande-items` | Utilisateurs authentifies |
| GET | `/Mescommandes` | Utilisateurs authentifies |
| POST | `/CreeEtablissement` | Client, gerant, admin |

### Routes gerant et admin

La modification d'un etablissement, de ses images, tables, categories, produits et options est disponible pour `gerant|admin`. Les controles d'appartenance empechent un gerant d'agir sur l'etablissement d'un autre gerant.

### Routes admin

Seul `admin` peut consulter les etablissements en attente, consulter la liste globale, accepter ou supprimer un etablissement.

La liste exacte et les noms historiques des endpoints sont definis dans [routes/api.php](routes/api.php).

## Architecture

```text
app/
├── Http/Controllers/    # Entrees HTTP
├── Models/              # Modeles Eloquent
├── Requests/            # Validation des requetes
└── Services/            # Logique metier et controles d'acces
database/
├── migrations/          # Schema
└── seeders/             # Roles et donnees initiales
routes/api.php           # API REST
resources/lang/en/       # Messages de validation francais
tests/                   # Tests PHPUnit
```

## Authentification

Apres une connexion reussie, l'API renvoie un token Sanctum. Le frontend doit l'envoyer ainsi :

```http
Authorization: Bearer <token>
Accept: application/json
```

Les roles sont renvoyes dans la reponse d'authentification. Le role deja attribue est conserve lors d'une connexion Google.

## Tests

La commande de reference est :

```powershell
php artisan test
```

Les tests fonctionnels peuvent etre etendus pour couvrir Google Login, les controles d'appartenance, les roles et le filtrage des etablissements avec produits.

