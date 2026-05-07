# Classical Explorer

Une application web statique/PHP pour explorer la musique classique, gérer un compte utilisateur et choisir des rôles d'écoute, de composition et d'interprétation.

## Aperçu

- `index.html` : page d'accueil avec navigation vers les sections principales.
- `login.html` / `register.html` : formulaires d'authentification et d'inscription.
- `roles.html` : sélection de rôle utilisateur et onboarding.
- `profil.html` / `profil.php` : page de profil utilisateur.
- `oeuvres.html`, `artistes.html`, `orchestres.html`, `playlists.html`, `explorer_oeuvres.html`, `guides.html`, `evenements.html`, `compositeurs.html`, `interpretes.html` : pages de contenu statique.
- `db.php` : configuration de la connexion MySQL.
- `login.php`, `register.php` : backend PHP de connexion et d'inscription.

## Fonctionnalités principales

- Navigation statique entre sections musicales.
- Création de compte et connexion d'utilisateur.
- Attribution d'un rôle par défaut à l'inscription.
- Sélection de rôles utilisateur pour guider l'expérience.

## Structure du projet

```
Music_2.0/
├─ assets statiques : style.css, images/, static/app.js
├─ pages HTML : index.html, login.html, register.html, roles.html, profil.html, etc.
├─ backend PHP : db.php, login.php, register.php, profil.php, onboarding.php, logout.php
```

## Configuration requise

- PHP installé (version 7.4+ recommandée)
- Serveur web local (Apache, Nginx, PHP intégré)
- Base de données MySQL / MariaDB

## Installation

1. Placer le projet dans le répertoire racine du serveur web ou exécuter un serveur PHP intégré :

```bash
cd ~/Music_2.0
php -S localhost:8000
```

2. Configurer la base de données MySQL.
3. Créer une base de données `Classic`.
4. Adapter les identifiants SQL dans `db.php` si nécessaire.

## Base de données

Le fichier `db.php` utilise les paramètres suivants :

- hôte : `localhost`
- base : `Classic`
- utilisateur : `root`
- mot de passe : `&`

### Remarque

Il n’y a pas de script SQL de création fourni dans ce dépôt, mais les tables attendues incluent typiquement :

- `utilisateurs`
- `roles`
- `user_roles`

## Utilisation

- Ouvrir `index.html` pour accéder à l'accueil.
- Créer un compte via `register.html`.
- Se connecter via `login.html`.
- Choisir un rôle via `roles.html` après l'inscription.

## Conseils

- Vérifier que `register.html` et `login.html` sont bien servis depuis un environnement PHP pour que les requêtes POST fonctionnent.
- Mettre à jour `db.php` avec des identifiants de base de données sécurisés en production.

## Licence

Projet personnel / prototype de découverte de musique classique.
