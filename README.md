# Getting started in a new environment
- Ensure Docker is installed on your local environment and is running as well as Composer and Node
- Navigate to the project root and run ```composer install```
- Next run ```./vendor/bin/sail up -d``` to start the containers
    - ```./vendor/bin/sail down``` will stop the containers
    - https://laravel.com/docs/8.x/sail for more instructions
- If needed, composer packages can be installed in your container via the command below
    ```
    docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
    ``` 
- Run the migrations
    - ```./vendor/bin/sail artisan migrate```
- Compile and install NPM packages
    -  ```./vendor/bin/sail npm install```
    -  ```./vendor/bin/sail npm run dev```
    -  Note that if there are issues with updating packages you can clear the NPM cache and re-install
        - ```./vendor/bin/sail npm cache clean --force```



# Testing
To run the available tests run the following commands:
- ```./vendor/bin/sail artisan test```



# Frameworks Used
- Laravel 8
- Bootstrap 4
- Vue 2
