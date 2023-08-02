# Image Manipulation API - Laravel Application
The Image Manipulation API is a Laravel application that provides a fast and secure way to resize images based on user-defined dimensions. This API utilizes Laravel's Sanctum authentication to ensure secure access to its features. Users can send an image to the API, along with the desired dimensions (width and height), and receive the resized image in return.

## Screenshots:
### Image Manipulation API Collection on my Postman profile:
![image-manipulation-api-my-postman-profile](https://github.com/AhmedYahyaE/laravel-image-manipulation-api/assets/118033266/29091773-ac8f-4d6a-abf0-a6800f3e7e74)

### Database design:
![image_manipulation_api database design](https://github.com/AhmedYahyaE/laravel-image-manipulation-api/assets/118033266/e7210e63-fa4b-4fc1-8698-a466363c7697)

### Creating an account to generate a Sanctum Access Token:
![image-manipulation-api-homepage](https://github.com/AhmedYahyaE/laravel-image-manipulation-api/assets/118033266/4b506229-e862-48da-938b-38b65911aa8d)

![sanctum-access-tokens](https://github.com/AhmedYahyaE/laravel-image-manipulation-api/assets/118033266/614974ed-5cff-4f8f-bc6e-1c70388c5fa6)

![create-sanctum-access-token](https://github.com/AhmedYahyaE/laravel-image-manipulation-api/assets/118033266/0ab56da1-4666-40f9-b94c-e24690498560)

## Features:
1- Using a Scope Filter (Query Scopes) for both the Search Bar Form and Website Tags implementation.

2- Using Blade Components and Component Slots.

3- Using Database Seeders and Model Factories.

4 - Using Laravel's '[storage](storage)' directory (public disk and local driver) for storing user-uploaded images (instead of the regular '[public](public)' directory). Then, using a Symbolic Link between the '[storage/app/public](storage/app/public)' directory and '[public/storage](public/storage)' directory to display images throughout the application.

5- Using Route Model Binding.

6- Using Alpine.js library for creating Session Flash Messages that disappears after a specified duration.

7- Using Tailwind CSS for creating a completely responsive/mobile first design.

8- Eloquent Pagination.

9-  User Registration, Authentication and Authorization.

## Application Routes:
All the application routes are defined in the [web.php](/routes/web.php) file.

## Installation & Configuration:

1- Open your terminal, and use the '***git clone https://github.com/AhmedYahyaE/laravel-job-search-app.git***' command, or just download the ZIP project.

2- Navigate/Change into (using the **cd** command) to the project root directory, then run the '***composer install***' command.

3- Run the '***npm install***' command (and only in case you face any issues/errors, run the 'npm audit fix' command), and then run the '***npm run build***' command.

4- Create a MySQL database named **\`yourjob\`**, then import the **[yourjob database SQL Dump File](<Database - yourjob/yourjob database - SQL Dump File - phpMyAdmin Export.sql>)** into your \`yourjob\` database.

5- Navigate to the **[.env](.env)** file and configure/update it with your MySQL database credentials and other configuration settings.

6- In case the application images are broken (are not loaded), recreate the Symbolic Link between the '[storage/app/public](storage/app/public)' directory and '[public/storage](public/storage)' directory by removing/deleting the [public/storage](public/storage) directory first, then run the '***php artisan storage:link***' command.

7- Run the '***php artisan serve***' command, and then open your browser and visit **http://127.0.0.1:8000** to access YourJob application.

\*\* Ready-to-use registered accounts credentials you can use to log in:
> Email: **test@test.com**, Password: **123456**

> Email: **yasser@gmail.com**, Password: **123456**
    
> Email: **test2@test.com**, Password: **123456**

## Contribution:
Contributions to my YourJob Laravel application are most welcome! If you find any issues or have suggestions for improvements or want to add new features, please open an issue or submit a pull request.
