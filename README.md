# Test Backend

## Requirements
- PHP ^8.1
- PostgreSQL
- Composer
- [RabbitMQ](https://www.rabbitmq.com/docs/download)

## Persiapan Running Di Lokal

### Tanpa menggunakan docker
- Jalankan Composer
    ```
    composer install
    composer dump-autoload
    ```
- Buat Database
    ```
    CREATE DATABASE email_queue;
    ```
- Copy ENV (**sesuaikan value di env sesuai dengan database postgre & rabbitmq yang ada di lokal Anda**)
    ```
    copy .env.example .env
    ```
- Jalankan migrasi
    ```
    php app\Migrations\Migrate.php
    ```
- Jalankan aplikasi
    ```
    php -S 127.0.0.1:8000 index.php
    ```
- Buka terminal lagi, untuk menjalankan workerny
    ```
    php worker.php
    ```
## Dokumentasi API

- environtment

    


