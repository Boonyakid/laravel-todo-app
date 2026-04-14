# Laravel Todo App

A Todo application developed with **Laravel**, featuring automated testing to ensure code quality using **Pest**.

## Features
- **Authentication:** User registration, login, and logout.
- **Task Management (CRUD):** Create, read, update, and delete tasks.
- **Authorization:** Users can only view and manage their own specific tasks.
- **Automated Testing:** Comprehensive test coverage for the entire system using Pest.

## Tech Stack
- **Framework:** Laravel 13.2.0
- **Language:** PHP 8.4.19
- **Database:** MySQL
- **Testing:** Pest

## Install required packages
```bash
composer install
npm install

## Configure Environment and MySQL Database
```bash
cp .env.example .env

## Generate Application Key
- php artisan key:generate

## Run Database Migrations
- php artisan migrate

## Compile Frontend Assets
- npm run build

## Testing
- php artisan test
