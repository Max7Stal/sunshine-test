# REST API — Управление товарами

## Dependencies
- php 8.1.*
- node.js 12.13.1
- mysql 8.0
- Laravel 10.x
- Composer 2.8.10

## Install
- composer install
- change .env file (add login and password for DB connection)
- php artisan migrate

## Authorization

### Endpoints
- POST /api/register — регистрация пользователя
- POST /api/login — получение Bearer token
- GET /api/user — информация о пользователе

### POST /api/register
{
"name": "TEST",
"email": "test@example.com",
"password": "secret123"
}

### POST /api/login
{
"email": "test@example.com",
"password": "secret123"
}

Response
{
"access_token": "...",
"token_type": "Bearer"
}

### GET /api/user
{
"id": 1,
"name": "TEST",
"email": "ivan@example.com",
"email_verified_at": null,
"created_at": "2025-07-24T10:16:41.000000Z",
"updated_at": "2025-07-24T10:16:41.000000Z"
}

## Product

### Endpoints
- GET /api/products — Список товаров с пагинацией, фильтрацией и подсчетом общей общего количества на складе. Доступен без авторизации.
- POST /api/products  — Добавление товара
- PUT /api/products/{productId}  — Обновление данных о товаре
- DELETE /api/products/{productId} — Удаление товара

### GET /api/products
Для фильтров используйте параметры category (Поиска товара по категории) и in_stock (Поиск товаров которые есть на складе, используйте как флаг)
Response
{
"products": {
"current_page": 1,
"data": [...],
"first_page_url": "http://sunshine-test/api/products?page=1",
"from": null,
"last_page": 1,
"last_page_url": "http://sunshine-test/api/products?page=1",
"links": [...],
"next_page_url": null,
"path": "http://sunshine-test/api/products",
"per_page": 10,
"prev_page_url": null,
"to": null,
"total": 0
},
"total_in_stock_value": 0
}

### POST /api/products Добавил смог данные в миграции
{
"name": "Product1",
"price": 999,
"category": "cat1",
"in_stock": 2
}
{
"name": "Product2",
"price": 999,
"category": "cat1",
}
{
"name": "Product3",
"price": 999,
"category": "cat1",
}
{
"name": "Product4",
"price": 999,
"category": "cat2",
"in_stock": 4
}
{
"name": "Product5",
"price": 999,
"category": "cat2",
}

### PUT /api/products/{productId} 
{
"name": "asdsad",
"price": 999,
"category": "cat3"
}
Response
{
"id": 1,
"name": "asdsad",
"price": 999,
"category": "cat3",
"in_stock": 2,
"created_at": null,
"updated_at": "2025-07-24T13:39:47.000000Z"
}

### DELETE /api/products/{productId}
Response
{
"message": "Product deleted"
}
