# Test Backend

## Requirements
- PHP ^8.1
- PostgreSQL
- Composer
- [RabbitMQ](https://www.rabbitmq.com/docs/download)

## Dokumentasi API
- untuk dokumentasi api yang sudah dipublish public bisa dilihat [disini](https://documenter.getpostman.com/view/6185322/2sA3QwdAoe)
- collection api dapat diunduh [disini](https://github.com/ikhsank6/0c05721b7fe9d02cfa1633822472357c/blob/main/Levart%20Test.postman_collection.json)
- env collection dapat diunduh [disini](https://github.com/ikhsank6/0c05721b7fe9d02cfa1633822472357c/blob/main/Levart_TEST_env.postman_environment.json)

## Persiapan Running Di Lokal

### Menggunakan Docker
- Copy env example
    ```
    cp env.example .env
    ```
- Jalankan Composer
    ```
    composer install
    ```
- Jalankan perintah untuk build docker image
    ```
    docker compose up --build -d
    ```
- Sekarang cek container yang berjalan, (**ada 4 image yang berjalan yaitu aplikasi,rabbitmq,postgresql dan pgadmin**)
    ```
    docker ps
    ```
- Jalankan migrasi dengan perintah docker (**lihat container id yang nama image nya terdapat kata restapi**)
    ```
    docker exec -it contain_ID php app/Migrations/Migrate.php
    ```
- Jalankan queue nya dengan supervisord
    ```
    docker exec -it 82f956e877c2 supervisord
    ```
- Untuk membuka rabbitmq server, buka dibrowser
    ```
    http://localhost:15673/#/

    User: guest
    Password: guest
    ```
- Untuk memastikan aplikasi telah berjalan buka di browser
    ```
    http://localhost:8080/
    ```

### Tanpa Menggunakan Docker
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


    


