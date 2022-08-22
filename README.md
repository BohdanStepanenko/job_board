# Job board
## A simple job board where users can post their jobs and send a response to other jobs
## Setup sail

> [Official Laravel Documentation](https://laravel.com/docs/9.x/sail#main-content)

Download sail package

    composer require laravel/sail --dev

Install images

    php artisan sail:install

Create alias

    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

Checkout to WSL (Windows OS)

    wsl

Up container

    sail up -d

To check running instance

    sail ps

Any that you want to run in container

    sail artisan make:migrations
    sail artisan make:model -mc Order
