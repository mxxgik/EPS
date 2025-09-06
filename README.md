## VITAPI
VitAPI is a web API written in Laravel which aims to help Healthcare service providers streamline the process user, doctor and appointment management via a range of comprehensive endpoints through which they can perform CRUD operations to their database.

## Tech Stack
- Language: PHP 8
- Framework: Laravel 12.x
- Database: MariaDB 10.4

## Installation

### Instalation Dependencies

- [PHP](https://www.php.net/manual/en/install.php)
- [Composer](https://getcomposer.org/download/)
- [git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) 
- [MariaDB](https://mariadb.org/download/)

Before proceeding with the installation guide, please make sure you have installed all of the dependencies listed above.

### Project installation

1) Clone the repository onto your machine.
``` bash
git clone https://github.com/mxxgik/EPS.git
```

2) Go into the project directory.
``` bash
cd EPS/
```

3) Install dependencies.
```bash
composer install
```

4) Move the example environment configuration.
```bash
mv .env.example .env
```
5) Generate a Laravel app key, just i case.
```bash
php artisan key:generate
```

### Database Configuration

1) Open the .env file to which you moved the configuration earlier. (you can use whatever text editor you see fit)
```bash
nvim .env
```

2) Set the database connection credentials and information
```ini
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=top_secret_password
```

3) Create the database which the project will use
```bash
mariadb -u root -p top_secret_password;
CREATE DATABASE your_database_name;
EXIT;
```

4) Lastly, run migrations
```bash
php artisan migrate
```

### Running the server

You can run the implemented Laravel development server by running the following command on your terminal, make sure youre on the root of your project:
```bash
php artisan serve
```

## Endpoints

