# qrCode API

## Table des matières

- [qrCode API](#qr-code-api)
  - [Table des matières](#table-des-matières)
  - [À propos du projet](#à-propos-du-projet)
  - [Prérequis](#prérequis)
  - [Installation](#installation)
  - [Endpoints](#Endpoints)
  - [Fonctionnalités](#fonctionnalités)
  - [Tests](#tests)
  - [Docker](#docker)
  - [Auteur](#auteur)

## Á propos du projet

qrCode API est un projet de gestion de qrcode. Ce projet est une API REST qui permet de creer et de gerer des qrcodes. L'API etant concu avec Laravel et MySQL pour la base de donnees.Le tout est déployé à l'aide de Docker pour faciliter la gestion des conteneurs.

## Prérequis
Avant de démarrer, assurez-vous d'avoir les outils suivants installés sur votre machine :

- Docker
- Docker Compose
- PHP 8.2+
- Composer

## Installation

Pour installer qrCode API, suivez les instructions suivantes :

```bash
# Cloner le repository
git clone https://github.com/nsconsult/qrCode-CRUD.git

# Entrer dans le dossier du projet  
cd qrCode-CRUD

# Configurer les variables d'environnement en modifiant les paramètres de la base de données pour qu'ils correspondent à votre configuration Docker.

cp .env.example .env

# Construisez les conteneurs Docker en utilisant Docker Compose

docker-compose build

docker-compose up -d

#Installer les dependances laravel

docker exec -it laravel_app bash
    .composer install
    .php artisan key:generate
    .php artisan migrate

```
Une fois toutes ces process finis, vous pouvez lancer le serveur de l'API sur http://localhost:8000

## Endpoints

Voici les principaux endpoints disponibles dans l'API :

- `GET /api/qrcodes`: Retourne une liste paginée de QR codes.
- `POST /api/qrcodes`: Créer un nouveau QR code qui prend en charge les données suivantes : `author` et `data`.
- `GET /api/qrcodes/{id}`: Retourne les données d'un QR code spécifique.
- `PUT /api/qrcodes/{id}`: Mettre à jour un QR code.
- `DELETE /api/qrcodes/{id}`: Supprimer un QR code.

Chaque endpoint supporte des paramètres de requête pour la pagination et la recherche.

## Fonctionnalités

qrCode API offre les fonctionnalités suivantes :

- Création de QR codes.
- Mise à jour de QR codes existants.
- Suppression de QR codes.
- Pagination des QR codes.
- Recherche des QR codes.
- Affichage des données d'un QR code spécial.
-Deploiement avec Docker.

## Tests
Les tests peuvent être exécutés pour s'assurer que toutes les fonctionnalités de l'API fonctionnent correctement. Pour lancer les tests, utilisez la commande suivante :

```bash
php artisan test
```

## Docker

Le projet est conçu pour être facilement déployé avec Docker. Voici une description des services utilisés :

- `laravel_app`: Conteneur de l'application Laravel.
- `mysql_db`: Conteneur de la base de données MySQL.
- `nginx_webserver`: Conteneur du serveur web NGINX.

### Commandes Docker utiles

- `docker-compose build`: Construire les conteneurs Docker.
- `docker-compose up -d`: Démarrer les conteneurs Docker en arriere-plan.
- `docker-compose down`: Arreter les conteneurs Docker.
- `docker exec -it laravel_app bash`: Ouvrir un shell dans le conteneur de l'application Laravel.
- `docker exec -it mysql_db bash`: Ouvrir un shell dans le conteneur de la base de données MySQL.
- `docker logs [nom du conteneur]`: Afficher les logs d'un conteneur.

## Auteur

qrCode API est construit par:
- Nazim ALI - [nazim.ali@epitech.eu](mailto:nazim.ali@epitech.eu)

