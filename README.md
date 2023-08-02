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
1- Token-based Authentication using Laravel Sanctum package.

2- Using Laravel API Resources and Resource Collection classes.

3- Using Form Request classes for complex validation.

4- Rate Limiting to restrict the number of requests to the API per minute.

5- Using Regular Expression with the resizing API endpoints.

6- Laravel Breeze package.

7- Intervention Image package for image manipulation.

8- Route Model Binding.

## Application Routes:
All the application routes and API Endpoints are defined in both ***[web.php](routes/web.php)*** (registration and login routes to get an acess token) and ***[api.php](routes/api.php)*** (API endpoints) files.

## Installation & Configuration:

1- Open your terminal, and use the '***git clone https://github.com/AhmedYahyaE/laravel-image-manipulation-api.git***' command, or just download the ZIP project.

2- Navigate/Change into (using the **cd** command) to the project root directory, then run the '***composer install***' command.

3- Run the '***npm install***' command (and only in case you face any issues/errors, run the 'npm audit fix' command), and then run the '***npm run build***' command.

4- Create a MySQL database named **\`image_manipulation_api\`**, then import the **[image_manipulation_api database SQL Dump File](<Database - yourjob/image_manipulation_api database - SQL Dump File - phpMyAdmin Export.sql>)** into your \`image_manipulation_api\` database.

5- Navigate to the **[.env](.env)** file and configure/update it with your MySQL database credentials and other configuration settings.

6- In case the application images are broken (are not loaded), recreate the Symbolic Link between the '[storage/app/public](storage/app/public)' directory and '[public/storage](public/storage)' directory by removing/deleting the [public/storage](public/storage) directory first, then run the '***php artisan storage:link***' command.

7- Run the '***php artisan serve***' command, and then open your browser and visit **http://127.0.0.1:8000** to access YourJob application.

\*\* Ready-to-use registered accounts credentials you can use to log in:
> Email: **ahmed.yahya@example.com**, Password: **123456**

## API Endpoints:
> ***\*\* Check the API Collection on my Postman Profile: https://www.postman.com/ahmed-yahya/workspace/my-public-portfolio-postman-workspace/collection/28181483-12ef8a00-7826-4bc6-b57a-016f48546432***

> ***\*\* Also, you can test the API Endpoints using Postman. Here is the API's Postman Collection .json file [Postman Collection file](<Postman Collection of API Endpoints/Image Manipulation API (Laravel).postman_collection.json>) you can download and import in your Postman.***

**1- Register/Sign up/Create a new user (POST):**

**POST /v1/users**

- "Content-Type" HTTP Request Header must be set to "application/".


## Contribution:
Contributions to my Image Manipulation API Laravel application are most welcome! If you find any issues or have suggestions for improvements or want to add new features, please open an issue or submit a pull request.
