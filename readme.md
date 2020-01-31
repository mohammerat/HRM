## About Project

This project was made for Basic Engineering Principles Course in University of Isfahan in subject of Human Resource Management

- Users Management
- Attendances Management
- Salary Management
- Handling Work Hours
- Creating and managing Demands
- Three user level restriction
- Can change server base address in android app

### This project built with

- Laravel 5.7
- Mysql Database

## How to use

1. clone the project

```
git clone
```
2. install dependencies

```
composer install
```
3. copy .env.example file

```
cp .env.example .env
```
4. edit db name, username and password

```
nano .env
```
5. generate app key and jwt secret

```
php artisan key:geneate && php artisan jwt:secret
```

6. migrate and seed database

```
php artisan migrate --seed
```

7. You'r ready to go
