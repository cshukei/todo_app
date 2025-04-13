# TODO App
TODO App is a web app for users to record their TODO lists. This project contains a Laravel Web Application.

The current sample UI is made from Bootstrap and Livewire.

## Setup
### Prerequisites
1. PHP: https://www.php.net/downloads.php
1. Composer: https://getcomposer.org/

### Installation Steps
1. Setup the prerequisites. Follow the steps in the corresponding download section or find the installation manual or steps on web.
1. Clone this project.
1. Navigate into your project directory
    ``` bash
    cd todo_app
    ```
1. Project environment
    - Change the *.env.example* to *.env* to ensure everyone has the project environment 
1. Install dependencies
    ``` bash
    npm install
    ```
1. Run build
    ``` bash
    npm run build
    ```
1. Run server
    ``` bash
    php artisan serve
    ```
1. The server will be hosted on http://localhost:8000
---

### Deployment
#### Prerequisites
1. Docker & Docker Desktop: https://docs.docker.com/desktop/install/windows-install/
#### Docker Deployment
Using docker compose is recommended when you want to test this in a development or testing environment. It is not really suitable for deployment environment, but can be used as well. 
1. Navigate into the project directory
1. Rename sample_db.sqlite3 into db.sqlite3
1. Run the containers using:
    ``` bash
    docker-compose up --build
    ```

#### Docker Deployment (Manual)
Using this method is suitable when the deployment environment is not under your control. Example is where scenarios where you should only place the image rather than the source code into the deployment environment. A new image should be rebuilt whenever there is a new version of the project that is ready for UAT or Production. **It is highly recommended to change the tag name only** whenever a new version is built for naming consistency. 
1. Navigate into the project directory
1. Rename sample_db.sqlite3 into db.sqlite3
1. Build the image using:
    ``` bash
    docker build -t todo_app:[insert_latest_version_here] .
    ```
1. Run the container using:
    ``` bash
    docker run -d -p 8001:8001 --name todo_app_instance1 todo_app:[insert_latest_version_here] 
    ```
1. (Optional) Multi-instance cases
    ``` bash
    docker run -d -p 8001:8001 --name todo_app_instance1 todo_app:[insert_latest_version_here] 
    docker run -d -p 8002:8001 --name todo_app_instance2 todo_app:[insert_latest_version_here] 
    docker run -d -p 8003:8001 --name todo_app_instance3 todo_app:[insert_latest_version_here] 
    ```