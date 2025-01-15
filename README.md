# How to run my application

1. First of all, copy `.env.example` values by running `cp .env.example .env` in your terminal;
2. Now, build all Docker containers running `docker-compose up --build -d`;
3. After built, access Docker terminal by `docker exec -it fid-php bash` and run `composer install`;
4. For Laravel configuration, run `php artisan key:generate` to create application key;
5. Then, start MySQl tables running `php artisan migrate` or `php artisan migrate:fresh` in some cases;
6. Finally, access your local routes acessing `localhost:80` in your browser!