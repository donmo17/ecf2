# 🏢 Projet de Gestion des Salles

![Statut](https://img.shields.io/badge/statut-en%20développement-yellow?style=flat-square)
![Licence](https://img.shields.io/badge/licence-privée-red?style=flat-square)

Système de gestion des réservations de salles développé avec Symfony (Projet Privé).

## 📑 Table des matières

- [À propos du projet](#-à-propos-du-projet)
- [Guide de Contribution](#-guide-de-contribution)
- [Configuration initiale](#-configuration-initiale)
- [Workflow de développement](#-workflow-de-développement)
- [Commandes Git essentielles](#-commandes-git-essentielles)
- [Base de données](#-base-de-données)
- [Déploiement](#-déploiement)
- [Lancement du serveur de développement](#-lancement-du-serveur-de-développement)

## 🎯 À propos du projet

Ce projet est un système de gestion des réservations de salles développé en interne. Il permet aux utilisateurs de réserver des salles, de gérer les disponibilités et d'optimiser l'utilisation des espaces.

## 🛠 Technologies utilisées

- [Symfony](https://symfony.com/) - Framework PHP
- [Doctrine](https://www.doctrine-project.org/) - ORM
- [Twig](https://twig.symfony.com/) - Moteur de templates
- [PostgreSQL](https://www.postgresql.org/) - Base de données (production)
- [Heroku](https://www.heroku.com/) - Plateforme de déploiement

## 🚀 Guide de Contribution

Ce guide explique comment contribuer au projet de gestion des salles en utilisant Git, GitHub et Heroku.

### 🏁 Configuration initiale

1. Clonez le repository :
   ```bash
   git clone https://github.com/Matheo93/gestion-salles-symfony.git
   cd gestion-salles-symfony
   ```

2. Configurez votre nom et email pour les commits :
   ```bash
   git config user.name "Votre Nom"
   git config user.email "votre.email@exemple.com"
   ```

3. Installez les dépendances :
   ```bash
   composer install
   ```

4. Configurez votre environnement local :
   - Copiez le fichier `.env` en `.env.local`
   - Modifiez `.env.local` avec vos paramètres locaux, notamment la `DATABASE_URL`

5. Installez les dépendances supplémentaires :
   ```bash
   composer require symfony/orm-pack
   composer require symfony/twig-bundle
   ```

6. Configurez la base de données :
   - Modifiez la variable `DATABASE_URL` dans le fichier `.env` ou `.env.local`
   - Configurez le driver et la version du serveur dans `config/packages/doctrine.yaml`
   - verifiez que votre .env est bien configuré en `APP_ENV=dev`

7. Créez la base de données (si ce n'est pas déjà fait) :
   ```bash
   php bin/console doctrine:database:create
   ```

8. Appliquez les migrations (si vous en avez) :
   ```bash
   php bin/console make:migration
   php bin/console doctrine:migrations:migrate
   ```

9. Installez la bibliothèque NPM :
   ```bash
   npm install
   npm run dev
   ```



### 🔄 Workflow de développement

1. Créez une nouvelle branche pour chaque fonctionnalité ou correction :
   ```bash
   git checkout -b nom-de-votre-branche
   ```

2. Faites vos modifications et committez-les :
   ```bash
   git add .
   git commit -m "Description concise des changements"
   ```

3. Poussez votre branche vers GitHub :
   ```bash
   git push origin nom-de-votre-branche
   ```

4. Créez une Pull Request sur GitHub pour fusionner vos changements dans la branche principale.

### 🛠 Commandes Git essentielles

- Vérifier l'état de votre repository local :
   ```bash
   git status
   ```

- Récupérer les dernières modifications de la branche principale :
   ```bash
   git checkout main
   git pull origin main
   ```

- Mettre à jour votre branche de fonctionnalité avec les derniers changements de `main` :
   ```bash
   git checkout nom-de-votre-branche
   git merge main
   ```

- Annuler les modifications non committées :
   ```bash
   git checkout -- fichier-modifie
   ```

- Voir l'historique des commits :
   ```bash
   git log
   ```

### 📤 Pousser tous vos fichiers

Pour ajouter, committer et pousser tous vos changements en une seule fois :
   ```bash
   git add .
   git commit -m "Description de vos changements"
   git push origin nom-de-votre-branche
   ```

## 👍 Bonnes pratiques

- Faites des commits fréquents avec des messages clairs et descriptifs.
- Gardez vos branches à jour avec la branche principale.
- Nommez vos branches de manière descriptive (ex: `feature/nouvelle-fonctionnalite` ou `fix/correction-bug`).
- Faites une revue de code avant de fusionner dans la branche principale.
- Utilisez des pull requests pour discuter des changements avant de les fusionner.

### 🔀 Pull Requests

1. Allez sur la page GitHub du projet.
2. Cliquez sur "Pull requests" puis "New pull request".
3. Sélectionnez votre branche comme "compare" et `main` comme "base".
4. Ajoutez une description détaillée de vos changements.
5. Demandez une revue à vos collègues.

### 🚧 Résolution des conflits

Si vous rencontrez des conflits lors d'un merge ou d'un pull :

1. Ouvrez les fichiers en conflit et résolvez manuellement les différences.
2. Ajoutez les fichiers résolus avec `git add`.
3. Terminez le merge avec `git commit`.

### 🔄 Scénario de conflit

Si deux personnes créent un fichier `hello_world.html` avec un contenu différent :

- La première personne qui pousse ses changements n'aura pas de problème.
- La deuxième personne recevra un message d'erreur lors du push.
- Cette personne devra d'abord faire un `git pull` pour récupérer les changements.
- Git signalera un conflit dans le fichier `hello_world.html`.
- Le développeur devra ouvrir le fichier, résoudre manuellement le conflit, puis faire un commit.

## 🔁 Mise à jour de votre fork (si applicable)

Si vous travaillez sur un fork :

1. Ajoutez le repository original comme remote :
   ```bash
   git remote add upstream https://github.com/Matheo93/gestion-salles-symfony.git
   ```

2. Mettez à jour votre fork :
   ```bash
   git fetch upstream
   git checkout main
   git merge upstream/main
   git push origin main
   ```

## 💾 Base de données

#### 🖥 Configuration locale

- Créez un fichier `.env.local` à la racine du projet (ce fichier ne doit pas être commité)
- Ajoutez votre configuration de base de données locale, par exemple : `DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name"`

#### 🐘 Heroku PostgreSQL

- La base de données de production est hébergée sur Heroku avec PostgreSQL
- La variable d'environnement `DATABASE_URL` est automatiquement configurée par Heroku

### 🔄 Migrations

- Créez des migrations après avoir modifié les entités :
   ```bash
   php bin/console make:migration
   ```

- Appliquez les migrations localement :
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

- Pour appliquer les migrations sur Heroku (à faire après le déploiement) :
   ```bash
   heroku run php bin/console doctrine:migrations:migrate
   ```

## 🚀 Déploiement

- Le projet est automatiquement déployé sur Heroku à chaque push sur la branche principale.
- URL de l'application : [https://gestion-salles-symfony-d07ea17b552a.herokuapp.com/](https://gestion-salles-symfony-d07ea17b552a.herokuapp.com/)

## 🖥 Lancement du serveur de développement

Utilisez la commande suivante pour lancer le serveur de développement :
   ```bash
   symfony server:start
   ```
   ou
   ```bash
   php -S 127.0.0.1:8000 -t public
   ```

Accédez ensuite à votre application dans votre navigateur à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000).
