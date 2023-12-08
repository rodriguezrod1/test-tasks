# Tasks Management Web Application

This Docker Compose file is used to set up a web application for managing Tasks. The application is built using Laravel Lumen 10.0.2 and PostgreSQL 14, and the frontend is built using Vue 3 with TypeScript and the Vuexy template. The architecture is structured as a microservice with three independent services: API, Database, and Frontend, wiht Docker Compose.

## Services

### API

The API service is built using Laravel Lumen 10.0.2. It is responsible for handling requests and responses for the application. It uses the `api-backend-v01` image and is named `laravel_app`. It mounts the `./api/` directory to `/var/www` in the container and exposes port `8081`. It depends on the `db` service and is part of the `tasks_network` network.

### Database

The Database service uses PostgreSQL 14. It is responsible for storing and retrieving data for the application. It uses the `postgres:14` image and is named `laravel_db`. It is configured to use a PostgreSQL database named `laravel` with a user named `postgres` and a password of `postgres123`. It mounts the `./.docker/postgresql/db-data` directory to `/var/lib/postgresql/data` in the container and is part of the `tasks_network` network.

### Frontend

The Frontend service is built using Vue 3 with TypeScript and the Vuexy template. It is responsible for displaying the user interface of the application. It uses the `frontend-tasks-v01` image and is named `laravel_frontend`. It mounts the `./frontend/` directory to `/app` in the container and exposes port `9001`. It runs the `yarn dev` command and is part of the `tasks_network` network.



## Networks

The `tasks_network` network is used by all services.

## Volumes

The `db-data` volume is used to persist the PostgreSQL database data.


## How to use this Docker Compose file

1. Make sure Docker and Docker Compose are installed on your system.
2. Copy this Docker Compose file to your project directory.
3.  - `docker compose up -d --build`
    - Enter the app container: `docker exec -it app /bin/bash`
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate`
4. Run `docker-compose up -d`. This will start all services in detached mode (in the background).
5. Access the application at `[http://localhost:9001]` Frontend



## How to update this Docker Compose file

1. Make changes to the Docker Compose file.
2. Run `docker-compose up --build` to rebuild the services and apply the changes.


## Where to get help

If you encounter any issues or need help, please open an issue in this repository or contact me [rodriguezrod1@gmail.com].
