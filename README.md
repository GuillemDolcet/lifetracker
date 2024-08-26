# Description

Lifetracker application using PHP/Laravel, Stimulus JS, Turbo JS, Tabler.io

[Laravel](https://laravel.com/) is a web application PHP framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects

[Stimulus](https://stimulus.hotwired.dev/) is a JavaScript framework with modest ambitions. It doesn’t seek to take over your entire front-end—in fact, it’s not concerned with rendering HTML at all. Instead, it’s designed to augment your HTML with just enough behavior to make it shine 

[Turbo](https://turbo.hotwired.dev/) bundles several techniques for creating fast, modern, progressively enhanced web applications without using much JavaScript

[Tabler.io](https://tabler.io/) is a free and open source web application UI kit based on Bootstrap 5, with hundreds responsive components and multiple layouts.

# Installation

## NewTRIP Requirements
- Laravel v11.x
- PHP v8.3.x
- PostgreSQL v16.3
- Node.js v20.x
- Redis v7.2.x

## How To Deploy

### For first time only !
- `git clone https://git.trit.tuv.com/it-sol/bsi/newTRIP.git`
- `cd newTRIP`
- `cp .env.example .env`
- `change .env variables up to you`
- `cd .docker`
- `execute build-all-images`
- `cd ..`
- `docker compose up`
- `create database defined in .env DB_DATABASE`
- `php console key:generate`
- `php console migrate`
- `php console storage:link`

### From the second time onwards
- `docker compose up`

# Notes

### PHP console

File to simplify docker commands

Examples 

php console up = docker compose up

php console artisan = docker compose exec app php artisan

### NewTRIP App
- URL: http://localhost:5000

### Mail hog
- URL: http://localhost:8025

### Postgresql
- Port: 5432
- Database: DEFINE IN .env (DB_DATABASE)
- Username: DEFINE IN .env (DB_USERNAME)
- Password: DEFINE IN .env (DB_PASSWORD)
