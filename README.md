# vidarex-laravel-demo

## At the moment:
Completed : Backend.<br>
To Do : Frontend functionality.

## Installation and Setup:
1. Make sure you have the required dependencies, such as PHP, Laravel, Composer, and npm, installed on your system before proceeding with the installation.<br>
2. Clone the repository to your local machine.<br>
3. Run *`composer install`* inside the backend directory to install the PHP dependencies.<br>
4. Create a new database with your prefered SQL language.<br>
5. Inside the backend directory rename the `.env.example` file to `.env` and update the necessary configuration values
6. Generate an application key by running *`php artisan key:generate`*.<br>
7. Run *`php artisan migrate --seed`* to migrate the database schema and seed it with data.
8. Inside the frontend directory run *`npm install`* to install the JavaScript dependencies.<br>
9. Inside the backend directory start the development server by running *`php artisan serve --port=8001`*.<br>
10. Inside the frontend directory start the development server by running *`npm run serve -- --port 8080`*.<br>
11. Access the application in your web browser at *`http://localhost:8080`*.<br>
