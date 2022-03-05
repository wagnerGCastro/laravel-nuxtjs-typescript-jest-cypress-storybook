# Referencies

# Comands Utilities
  # git
    $ git commit --amend -m "Initialization Project" --no-verify
    $ git commit -m "feat(backend): #01 - Add Laravel Framework" --no-verify

  # docker
    $ docker-compose build workspace
    $ docker-compose up -d workspace apache2 mysql
    $ docker-compose exec workspace bash   // root
    $ docker-compose exec --user=laradock workspace bash  // user

    - container
      $ docker-compose stop workspace
      $ docker-compose start workspace

  # backend
    - Run server
      php artisan serve --host=0.0.0.0  --port=8040
      php artisan serve --host=backend.local  --port=8045
      php artisan serve --env=dev  --host=0.0.0.0  --port=8040
      php -S 0.0.0.0:8040 

  # PHP Artisan
    - php artisan migrate
    - php artisan make:model Permissions -m
    - php artisan make:controller Api/name_of_controller --api --model=name_of_model
    - php artisan make:migration alter_table_foreign_keys --create=permissions
    - php artisan make:seeder UsersTableSeeder
    - php artisan make:request PostStoreUpdateRequest
    -	php artisan db:seed --class=DatabaseSeeder  
    - php artisan make:policy PostPolicy --model=Post

  # Mysql
    - ALTER TABLE myTabel AUTO_INCREMENT=0;
