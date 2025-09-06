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

## Interaction with the API
In this section you will find a list of all the database entities, and their respective fields and datatypes, along with some example responses from the server.

### Doctor
```
id (integer)

first_name (string)

last_name (string)

specialty (string)

identification (string, unique)

gender (string: "M" or "F")

phone (string)

email (string, unique)
```

### Patient

```
id (integer)

first_name (string)

last_name (string)

identification (string, unique)

dob (date of birth, YYYY-MM-DD)

gender (string: "M" or "F")

phone (string)

email (string, unique)
```

### Appointment

```
id (integer)

patientId (integer → Patient)

doctorId (integer → Doctor)

appointment_date_time (datetime: YYYY-MM-DD HH:mm:ss)

reason (string)

status (string: scheduled, finished, cancelled)
```

### Endpoints

## Doctors

POST ``/doctors`` => Create new doctor

GET ``/doctors`` => List all doctors

GET ``/doctors/{id}`` => Get a single doctor

PUT ``/doctors/{id}`` => Update doctor info

DELETE ``/doctors/{id}`` => Remove a doctor

### Example Response (GET /doctors):

```json
[
  {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "specialty": "Cardiology",
    "identification": "DOC123456",
    "gender": "M",
    "phone": "555-101-0001",
    "email": "j.doe@hospital.com"
  }
]
```

## Patients

POST ``/patients`` => Create new patient

GET ``/patients`` => List all patients

GET ``/patients/{id}`` => Get a single patient

PUT`` /patients/{id}`` => Update patient info

DELETE ``/patients/{id}`` => Remove a patient

### Example Response (GET /patients):

```json
[
  {
    "id": 1,
    "patientId": 1,
    "doctorId": 1,
    "appointment_date_time": "2025-08-25 10:00:00",
    "reason": "Regular check-up",
    "status": "scheduled"
  }
]
```

## Appointments

POST ``/appointments`` => Schedule a new appointment

GET ``/appointments`` => List all appointments

GET ``/appointments/{id}`` => Get a single appointment

PUT ``/appointments/{id}`` => Update appointment details

DELETE ``/appointments/{id}`` => Cancel/delete appointment

### Example Response (GET /appointments):
```json
[
  {
    "id": 1,
    "patientId": 1,
    "doctorId": 1,
    "appointment_date_time": "2025-08-25 10:00:00",
    "reason": "Regular check-up",
    "status": "scheduled"
  }
]
```

## Example status messages from the server

```json
{ "message": "The doctor was deleted successfully" }
{ "message": "The patient was deleted successfully" }
{ "message": "The appointment was deleted successfully" }
```

## Authentication via Laravel Sanctum
VitAPI offers authentication to its users via Sanctum Tokens, for tests and example responses, please refer to the test performed via postman: https://documenter.getpostman.com/view/45753445/2sB3HkqfhU

