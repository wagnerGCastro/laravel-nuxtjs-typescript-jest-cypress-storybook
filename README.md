# Referencies

# Comands Utilities
  # git
    $ git commit --amend -m "Initialization Project" --no-verify
    $ git commit -m "feat(backend): #01 - Add Laravel Framework" --no-verify

  # docker
    $ docker-compose build workspace
    $ docker-compose up -d workspace mysql apache2 
    $ docker-compose exec workspace bash   // root
    $ docker-compose exec --user=laradock workspace bash  // user

  # backend
    -- Run server
    php artisan serve --host=0.0.0.0  --port=8040
    php artisan serve --env=dev  --host=0.0.0.0  --port=8040
    php -S 0.0.0.0:8040 
