<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
TASK MANAGER TOOL BACKEND
</p>

## About Task Management Tool

Task Management Tool is a backend api supports the following:

- Login using sanctum
- Create Task
- Update Own Task
- Get Todo Tasks
- Get Inprogress Tasks
- Get Done Task
- Delete Own Task

## Setup Instructions

- Copy `.env.example` to `.env`,  Update `.env` with db credentials
- Run `composer install`
- Run `php artisan migrate`
- Run `php artisan db:seed`

## Testing Instructions

- Make sure you have done the Setup Instructions
- Run `php artisan test`
