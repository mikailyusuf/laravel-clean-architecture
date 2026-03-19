# Clean Architecture Example (Laravel 13)

This repository is a simple **Clean Architecture** demo built with Laravel.
It shows how to keep business logic isolated from framework details by splitting code into clear layers:

- **Domain**: core business rules and contracts
- **Application**: use cases and DTOs (orchestration)
- **Infrastructure**: persistence/repository implementations
- **Interface Layer (HTTP)**: controllers, resources, and routes

## Tech Stack

- PHP `^8.3`
- Laravel `^13`
- Laravel Sanctum (token auth)
- SQLite (default local database)

## Project Structure

```txt
app/
  Application/
    DTOs/
    UseCases/
  Domain/
    Enums/
    Repositories/
    Services/
  Infrastructure/
    Persistence/
      Repositories/
  Http/
    Controllers/
    Resources/
  Shared/
    Responses/
```

## Clean Architecture Flow

1. Request hits a controller in `app/Http/Controllers`.
2. Controller maps request data into a DTO.
3. Controller executes a use case from `app/Application/UseCases`.
4. Use case depends on repository interfaces from `app/Domain/Repositories`.
5. Laravel container binds interfaces to implementations in `app/Providers/AppServiceProvider.php`.
6. Response is returned via `app/Shared/Responses/ApiResponse.php`.

## API Endpoints

Base URL (local): `http://127.0.0.1:8001`

### Auth

- `POST /api/v1/register`
- `POST /api/v1/login`

### Orders (Sanctum protected)

- `POST /api/v1/orders`
- `GET /api/v1/orders`

## Example Requests

### Register

```bash
curl -X POST http://127.0.0.1:8001/api/v1/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Login

```bash
curl -X POST http://127.0.0.1:8001/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Create Order (Authenticated)

```bash
curl -X POST http://127.0.0.1:8001/api/v1/orders \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{
    "pickup_address": "Lekki Phase 1",
    "delivery_address": "Yaba",
    "distance": 12.5,
    "weight": 2.3
  }'
```

### List Orders (Authenticated)

```bash
curl -X GET http://127.0.0.1:8001/api/v1/orders \
  -H "Authorization: Bearer <TOKEN>"
```

## Price Calculation

Order pricing is handled in `app/Domain/Services/DeliveryPricingService.php`:

- Base fee: `500`
- Distance cost: `distance * 100`
- Weight cost: `weight * 50`

Formula:

`price = 500 + (distance * 100) + (weight * 50)`

## Getting Started

### 1) Install dependencies

```bash
composer install
npm install
```

### 2) Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3) Prepare database

Using SQLite:

```bash
touch database/database.sqlite
php artisan migrate
```

### 4) Run the app

```bash
php artisan serve --port=8001
```

Optional frontend assets:

```bash
npm run dev
```

## Useful Commands

```bash
php artisan route:list
php artisan route:list --path=api/v1
php artisan test
composer dev
```

## Notes

- API routes are loaded from `routes/api.php` via `bootstrap/app.php`.
- Repositories are bound in `AppServiceProvider` using dependency inversion.
- All API responses follow a consistent `status/message/data/errors` structure.

## Purpose

This project is intentionally small and educational.  
Use it as a starter or reference for structuring Laravel applications with clean architecture principles.
