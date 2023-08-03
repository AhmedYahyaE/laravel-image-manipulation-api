# Image Manipulation API - Laravel Application
The Image Manipulation REST API is a Laravel application that provides a fast and secure way to resize images based on user-defined dimensions. This API utilizes Laravel's Sanctum authentication to ensure secure access to its features. Users can send an image to the API, along with the desired dimensions (width and height), and receive the resized image in return.

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

## Application Routes and API Endpoints:
All the application routes and API Endpoints are defined in both ***[web.php](routes/web.php)*** (registration and login routes to get an acess token) and ***[api.php](routes/api.php)*** (API endpoints) files.

## Installation & Configuration:

1- Open your terminal, and use the '***git clone https://github.com/AhmedYahyaE/laravel-image-manipulation-api.git***' command, or just download the ZIP project.

2- Navigate/Change into (using the **cd** command) to the project root directory, then run the '***composer install***' command.

3- Run the '***npm install***' command (and only in case you face any issues/errors, run the 'npm audit fix' command), and then run the '***npm run build***' command.

4- Create a MySQL database named **\`image_manipulation_api\`**, then import the **[image_manipulation_api database SQL Dump File](<Database - image_manipulation_api/image_manipulation_api database - SQL Dump File - phpMyAdmin Export.sql>)** into your \`image_manipulation_api\` database.

5- Navigate to the **[.env](.env)** file and configure/update it with your MySQL database credentials and other configuration settings.

6- Run the '***php artisan serve***' command.

7- To get an access token to be able to use the API, open your browser and visit **http://127.0.0.1:8000** to access Image Manipulation API application, then click on Register, then after completing the registration process, click on 'Create new token' to get a new access token, then give a name to the token, then click on 'Generate', then copy your new access token to paste it in your HTTP Client (like Postman).

\*\* Ready-to-use registered accounts credentials you can use to log in:
> Email: **ahmed.yahya@example.com**, Password: **123456**

8- Open your HTTP Client such as Postman, create a new Collection, name it 'Image Manipulation API'. Click on your Imgae Manipulation API Collection, then go to 'Variables' tab, then create a variable with the value of the Access Token that you've copied when you registered your account, then click 'Save'. Go to 'Authorization' tab, the in the 'Type' drop-down menu, choose 'Bearer Token'. This way you can inherit this Access token in All your requests to the API in this Collection.

9- Add your first request, then go to 'Authorization' tab, click on 'Inherit auth from parent'.

10- In your request, go to 'Headers', add two headers: 'Accept': 'application/json' and 'Content-Type': 'application/json'.

> ***\*\* Check the API Collection on my Postman Profile: https://www.postman.com/ahmed-yahya/workspace/my-public-portfolio-postman-workspace/collection/28181483-12ef8a00-7826-4bc6-b57a-016f48546432***

> ***\*\* Also, you can test the API Endpoints using Postman. Here is the API's Postman Collection .json file [Postman Collection file](<Postman Collection of API Endpoints/Image Manipulation API (Laravel).postman_collection.json>) you can download and import in your Postman.***

## Note:

> For **ALL** your requests to the Image Manipulation API, you must add the following three Headers:
> 
>     a- 'Authorization' Header with the value of the Access Token you've obtained when you registered your account.
>
>     b- 'Accept' Header with the value of 'application/json'.
>
>     c- 'Content-Type' Header with the value of 'application/json'.

## API Endpoints:

**1- Create an album (POST):**

**POST /api/v1/album**

- "name" key, which is your album name, must be provided in your request's JSON body.

**2- Get all albums (that ONLY belong to the authenticated/logged-in user) (GET):**

**GET /api/v1/album**

**3- Get a Single album By ID (that belongs to the authenticated/logged-in user) (GET):**

**GET /api/v1/album/{album_id}**

- {album_id} must be provided in the URL.

**4- Update an album (that belongs to the authenticated/logged-in user) (PUT):**

**PUT /api/v1/album/{album_id}**

- {album_id} must be provided in the URL.
- "name" key, which is your updated album name, must be provided in your request's JSON body.

**5- Delete an album (that belongs to the authenticated/logged-in user) (DELETE):**

**DELETE /api/v1/album/{album_id}**

- {album_id} must be provided in the URL.

**6- Get All images (that ONLY belong to the authenticated/logged-in user) (GET):**

**GET /api/v1/image**

**7- Get a Single image By ID (that belongs to the authenticated/logged-in user) (GET):**

**GET /api/v1/image/{image_id}**

- {image_id} must be provided in the URL.

**8- Get images By Album (that belong to the authenticated/logged-in user) (GET):**

**GET /api/v1/image/by-album/{album_id}**

- {album_id} must be provided in the URL.

**9- Delete an image (that belongs to the authenticated/logged-in user) (DELETE):**

**DELETE /api/v1/image/{image_id}**

- {image_id} must be provided in the URL.

**10- Resize an image By URL with percentages % (POST):**

**POST /api/v1/image/resize?w={number}%&h={number}%**

Example: POST /api/v1/image/resize?w=50%&h=70%

- 'w' (width) query string parameter is required, 'h' (height) query string parameter is optional.
- "image" key with the value of the URL/link of your image must be provided in your request's JSON body.
- "album_id" key with the value of the album ID that you want to associate your image with can be optionally (not required) provided in your request's JSON body.

**11- Resize an image By URL with px (POST):**

**POST /api/v1/image/resize?w={number}&h={number}**

Example: POST /api/v1/image/resize?w=100&h=120

- 'w' (width) query string parameter is required, 'h' (height) query string parameter is optional.
- "image" key with the value of the URL/link of your image must be provided in your request's JSON body.
- "album_id" key with the value of the album ID that you want to associate your image with can be optionally (not required) provided in your request's JSON body.

**12- Resize an image By Upload with percentages % (POST):**

**POST /api/v1/image/resize?w={number}%&h={number}%**

Example: POST /api/v1/image/resize?w=50%&h=70%

- 'w' (width) query string parameter is required, 'h' (height) query string parameter is optional.
- Upload your image as follows (required): Click on the 'Body' tab, then click on 'form-data'. In the 'Key' field, write in 'image' and then click on the drop-down menu of the 'image' Key field and change 'Text' to 'File', then in the 'Value' field, select your image to be uploaded.
- Enter your album ID as follows (optional, not required): Click on the 'Body' tab, then click on 'form-data'. In the 'Key' field, enter 'album_id', then in the 'Value' field, enter your album ID number that you want to associate your image with.

**13- Resize an image By Upload with px (POST):**

**POST /api/v1/image/resize?w={number}&h={number}**

Example: POST /api/v1/image/resize?w=100&h=120

- 'w' (width) query string parameter is required, 'h' (height) query string parameter is optional.
- Upload your image as follows (required): Click on the 'Body' tab, then click on 'form-data'. In the 'Key' field, write in 'image' and then click on the drop-down menu of the 'image' Key field and change 'Text' to 'File', then in the 'Value' field, select your image to be uploaded.

- Enter your album ID as follows (optional, not required): Click on the 'Body' tab, then click on 'form-data'. In the 'Key' field, enter 'album_id', then in the 'Value' field, enter your album ID number that you want to associate your image with.

## Contribution:
Contributions to my Image Manipulation API Laravel application are most welcome! If you find any issues or have suggestions for improvements or want to add new features, please open an issue or submit a pull request.
