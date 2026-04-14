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

## 1. Install required packages
```bash
composer install
npm install
```
## 2. Configure Environment and MySQL Database
```bash
cp .env.example .env
```
## 3. Generate Application Key
```bash
php artisan key:generate
```
## 4. Run Database Migrations
```bash
php artisan migrate
```
## 5. Compile Frontend Assets
```bash
npm run build
```
## 6. Testing
```bash
php artisan test
```
