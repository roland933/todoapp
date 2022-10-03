1.install dependencies : sudo docker-compose run myapp composer install
2.generate key: sudo docker-compose run myapp php artisan key:generate
3.Create env file from env.example and set your configuration from docker-compose.yml
4.start the project: docker-compose up -d

