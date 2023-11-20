# Efficient Employee Management System:

A Laravel-powered Solution with Robust Security and Seamless Operations

The application is built using Laravel for both frontend and backend, with roles managed by Spatie. Routes are secured with authentication and roles middleware, and all operations use AJAX with robust error handling. Admin-exclusive tasks include adding/editing employees. A welcome email, utilizing Laravel's queue, is sent to new employees with ID and name. Employee access is limited to viewing other employees, and Eloquent relations with eager loading optimize the loading of the complete employee list.

## SETUP INSTRUCTION:

- Clone this project using command ` git clone`
- run `composer install`
- run `npm install`
- make changes in `.env` file for 
    - DB_USERNAME 
    - DB_PASSWROD
    - MAIL_*
- run command `php artinam migrate --seed`
- run command `npm run build`
- run command `php artisan queue:listen`
- run command `php artisan serve`
- Goto `htttp://127.0.0.1`
