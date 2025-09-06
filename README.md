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
