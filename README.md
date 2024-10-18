# Système de Gestion de Salles - Projet Symfony 7

Ce projet est un système de gestion de salles développé avec Symfony 7. Il inclut des fonctionnalités multilingues (français, anglais, espagnol) et un système d'authentification avec notifications.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Symfony CLI

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

3. Configurez votre environnement dans le fichier `.env` ou `.env.local`

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
- Authentification des utilisateurs (inscription, connexion)
- Notifications pour les actions utilisateur
- Gestion des salles (à venir)

## Contribuer

1. Forkez le projet
2. Créez votre branche de fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## Licence

Distribué sous la licence MIT. Voir `LICENSE` pour plus d'informations.

## Contact

Votre Nom - [@votre_twitter](https://twitter.com/votre_twitter) - email@example.com

Lien du projet : [https://github.com/donmo17/ecf2](https://github.com/donmo17/ecf2)