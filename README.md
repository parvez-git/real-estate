## Real Estate Management System (REMS)
REMS is a simple PHP script based on Laravel that helps you to manage small or medium Real Estate business.

### Frameworks
1. Laravel 5.6
2. Materialize
3. Admin BSB Material Design

### Admin Features
1. Tags
2. Categories
3. Posts
4. Features
5. Properties
6. Sliders
7. Testimonials
8. Galleries
9. Settings
    1. Profile
    2. Message
    3. Change Password
    4. General Setting

### Agent Features
1. Properties (CRUD)
2. Settings
    1. Profile
    2. Message
    3. Change Password

### User Features
1. Comments
2. Property Rating
3. Settings
    1. Profile
    2. Message to Agent
    3. Change Password


### Install
01. `git clone https://github.com/parvez-git/real-estate.git`
02. `cd real-estate`
03. `composer install`
04. `cp .env.example .env`
05. `php artisan key:generate`
06. `php artisan migrate`
07. `php artisan db:seed`
08. `php artisan storage:link`
09. `php artisan serve`

### Docker installation (MYSQL Only)
01. 
    Edit `docker/.env-docker-mysql` for MYSQL DB docker environment variables.
    You can set your own database user, user password and database name.
02.
    Edit `docker/.env-docker-realestate` for you need.
    If you will run it for first time all must be `yes`.
    For subsequest runs you can set which one you neeed according to you DB status.
    If any of them will be needed FIRSTRUN should alwasys be `yes`
03. 
    Use `docker/.env.example` as a source for your `.env` file of application
    `./env.example` is not used in docker setup
    Edit this file DB information according to what you have entered in `docker/.env-docker-mysql`
04. 
    Start application with `sudo docker-compose -f docker/docker-compose.yml up -d`

#### Cridentials
01. 
    Email: `admin@admin.com` 
    Password: `123456`
02. 
    Email: `agent@agent.com` 
    Password: `123456`
03. 
    Email: `user@user.com` 
    Password: `123456`


### Screenshot

<img src="https://github.com/parvez-git/real-estate/blob/master/public/demo/home.jpg">