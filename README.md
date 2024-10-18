# Système de Gestion de Salles - Projet Symfony 7

Ce projet est un système de gestion de salles développé avec Symfony 7. Il inclut des fonctionnalités multilingues (français, anglais, espagnol), un système d'authentification avec Google, des notifications, et une gestion du consentement des cookies.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Symfony CLI
- Compte Google Developer pour l'authentification OAuth

## Installation

1. Clonez le dépôt :
   ```
   git clone https://github.com/donmo17/ecf2.git
   cd ecf2
   ```

2. Installez les dépendances :
   ```
   composer install
   ```

3. Configurez votre environnement dans le fichier `.env.local` :
   ```
   cp .env .env.local
   ```
   Ajoutez vos identifiants Google OAuth :
   ```
   GOOGLE_CLIENT_ID=votre_client_id
   GOOGLE_CLIENT_SECRET=votre_client_secret
   ```

4. Créez la base de données et effectuez les migrations :
   ```
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Lancez le serveur de développement :
   ```
   symfony serve
   ```

## Fonctionnalités

- Système multilingue (français, anglais, espagnol)
- Authentification des utilisateurs (inscription, connexion, Google OAuth)
- Notifications pour les actions utilisateur
- Gestion du consentement des cookies
- Gestion des salles (à implémenter)

## Guide d'implémentation pour les collaborateurs

### 1. Système multilingue
- Les traductions se trouvent dans le dossier `translations/`.
- Ajoutez de nouvelles traductions dans les fichiers `messages.{locale}.yaml`.
- Utilisez `{{ 'key'|trans }}` dans les templates Twig pour les textes à traduire.

### 2. Authentification Google
- La configuration se trouve dans `config/packages/knpu_oauth2_client.yaml`.
- Le `GoogleAuthenticator` gère le processus d'authentification.
- Modifiez `src/Security/GoogleAuthenticator.php` pour personnaliser le comportement post-authentification.

### 3. Notifications
- Utilisez le service `NotificationService` pour ajouter des notifications.
- Exemple : `$notificationService->addSuccess('Message de succès');`

### 4. Gestion des cookies
- La logique se trouve dans `templates/base.html.twig`.
- Personnalisez le comportement dans le script JavaScript inclus.

### 5. Gestion des salles (à implémenter)
- Créez une entité `Room` dans `src/Entity/Room.php`.
- Générez un CRUD pour la gestion des salles : `php bin/console make:crud Room`
- Implémentez la logique métier dans le contrôleur généré.

## Gestion des Cookies

Le site inclut une bannière de consentement pour les cookies qui s'affiche lors de la première visite. Les utilisateurs peuvent choisir d'accepter tous les cookies ou seulement les cookies essentiels. Cette préférence est stockée dans le localStorage du navigateur.

## Contribuer

1. Forkez le projet
2. Créez votre branche de fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## Licence

Distribué sous la licence MIT. Voir `LICENSE` pour plus d'informations.

## Contact

Lien du projet : [https://github.com/donmo17/ecf2](https://github.com/donmo17/ecf2)