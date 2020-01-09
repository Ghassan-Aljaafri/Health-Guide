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

Good Jop:+1:

## Seeder will provide 

* **6 Users**

        * Email:

            admin@hg.local
            admin2@hg.local
            nutritionist@hg.local
            nutritionist2@hg.local
            patient@hg.local
            patient2@hg.local

        * Password: 1234


* **4 Roles**

        super-admin
        admin
        nutritionist
        patient

* **some permissions**

Thank you :heart:
