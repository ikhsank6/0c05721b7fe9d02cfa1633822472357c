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
    php -S 127.0.0.1:8080 index.php
    ```
- Sebelum menjalankan worker pastikan **RabbitMQ** sudah jalan di lokal Anda
- Buka terminal lagi, untuk menjalankan workerny
    ```
    php worker.php
    ```
## Dokumentasi API
- untuk dokumentasi api yang sudah dipublish public bisa dilihat [disini](https://documenter.getpostman.com/view/6185322/2sA3QwdAoe)
- collection api dapat diunduh [disini](https://github.com/ikhsank6/0c05721b7fe9d02cfa1633822472357c/blob/main/Levart%20Test.postman_collection.json)
- env collection dapat diunduh [disini](https://github.com/ikhsank6/0c05721b7fe9d02cfa1633822472357c/blob/main/Levart_TEST_env.postman_environment.json)

    


