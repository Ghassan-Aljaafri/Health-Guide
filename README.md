## Configuration Steps

1) **copy .env.example file to .env**
>
2) **create new Database**
>
3) **edit .env file :point_down:**
    >
    >DB_DATABASE=
    >
    >DB_USERNAME=
    >
    >DB_PASSWORD=

4) **Open Terminal and type these commands**
    
    ```$ composer install```
    
    ```$ php artisan key:generate```
    
    ```$ php artisan jwt:secret```
    
    ```$ php artisan migrate --seed```



Thank you :+1::heart:
