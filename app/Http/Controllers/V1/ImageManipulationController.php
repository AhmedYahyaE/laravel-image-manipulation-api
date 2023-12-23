<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\ImageManipulation;
use App\Http\Requests\ResizeImageRequest;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Resources\V1\ImageManipulationResource;
// use App\Http\Requests\UpdateImageManipulationRequest; // We deleted this class as we won't have this UPDATE feature in our API



class ImageManipulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request) // Get ALL images (of the authenticated/logged-in user)
    {
        // Note: The Resource collection() method wraps your response in a 'data' key. Data Wrapping: https://laravel.com/docs/9.x/eloquent-resources#data-wrapping
        return ImageManipulationResource::collection(ImageManipulation::where('user_id', $request->user()->id)->paginate()); // Return all albums (that ONLY belong to the authenticated/logged-in user)
    }



    // Get images by album (of the authenticated/logged-in user)
    public function byAlbum(Request $request, Album $album) {
        if ($request->user()->id != $album->user_id) { // if the currently authenticated user is not the owner of the album in the URL, the user is unauthorized to show that album's images
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }

        $where = [
            'album_id' => $album->id,
        ];
        return ImageManipulationResource::collection(ImageManipulation::where($where)->paginate()); // We return the album images that belong to the authenticated/logged-in user
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ResizeImageRequest  $request
     * @return \App\Http\Resources\V1\ImageManipulationResource
     */
    public function resize(ResizeImageRequest $request)
    {
        $all = $request->all(); // Remember that here as we're using a Form Request class, $request is an object of the ResizeImageRequest.php class, not the traditional \Illuminate\Http\Request.php class!
        // dd($all);

        /** @var \Illuminate\Http\UploadedFile|string $image */ // DocBlock: $image can either be a physical uploaded file or URL (string). Check rules() method in ResizeImageRequest.php Form Request class
        $image = $all['image']; // an 'image' key in the JSON body (if the image is an URL) or in 'form-data' in Postman (if the image is a physical uploaded file) of the HTTP Request must be sent by the user
        // dd($image); // the \Illuminate\Http\UploadedFile class

        unset($all['image']); // remove the 'image' key/index from the $all array because later we'll save that $all variable inside the `data` column in `image_manipulations` table

        // $data array is the data that we're going to save in the `image_manipulations` database table (at the end of this method)
        $data = [
            // table column names => data to be saved in the table
            'type'    => ImageManipulation::TYPE_RESIZE, // the constant that we created in ImageManipulation.php model
            'data'    => json_encode($all), // save the whole data in `data` column as JSON format
            'user_id' => $request->user()->id, // `user_id` is the authenticated/logged-in user `id`
        ];

        // Since 'album_id' is OPTIONAL, if user submits an 'album_id' key in their HTTP Request Body (JSON Body in Postman if the image is a URL, or form-data Body in Postman if the image is an uploaded file) along with the image's physical file (in form-data Body in Postman) or URL (in JSON Body in Postman), we need to check if that 'album_id' belongs to the authenticated/logged-in user
        if (isset($all['album_id'])) { // if an 'album_id' key is submitted by the user in their HTTP Request Body (JSON Body in Postman if the image is a URL, or form-data Body in Postman if the image is an uploaded file) along with the image's physical file (in form-data Body in Postman) or URL (in JSON Body in Postman), append that 'album_id' to the $data array
            $album = Album::find($all['album_id']);
            if ($request->user()->id != $album->user_id) { // if the currently authenticated/logged-in user is not the owner of that album, they aren't authorized to resize that image of that album that doesn't belong to them
                return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
            }

            $data['album_id'] = $all['album_id']; // Append that 'album_id' key to the previous $data array
        }


        // The path of the uploaded files (images) will be like: public/images/sdfxGS21g(random folder name)/test.jpg, and the resized image will be in the same path (the resized image will be beside the original image) like: public/images/sdfxGS21g(random folder name)/test-resized.jpg. But, the path that we'll store in the `image_manipulations` database table will be without the 'public' like: images/sdfxGS21g(random folder name)/test.jpg
        // Note: We'll save images copies on file system (server) from both uploaded images and URLs
        $dir = 'images/' . \Illuminate\Support\Str::random() . '/'; // We create the random folder inside the public/images folder e.g. 'images/fdsx5gs4f/'
        $absolutePath = public_path($dir); // public_path(): https://laravel.com/docs/9.x/helpers#method-public-path
        // dd($absolutePath);

        \Illuminate\Support\Facades\File::makeDirectory($absolutePath); // Storage::makeDirectory(): Create A Directory: https://laravel.com/docs/9.x/filesystem#create-a-directory


        // Image resizing
        // Check if the $image is a physical upload file or a URL
        if ($image instanceof \Illuminate\Http\UploadedFile) { // if the $image is a physical uploaded file ($image is an object of the Laravel \Illuminate\Http\UploadedFile class) which is sent in the HTTP Request through 'form-data' under 'Body' in Postman, not a URL (check rules() method in ResizeImageRequest.php Form Request class)
            // Handling uploaded file (image)
            // dd($image);
            $data['name'] = $image->getClientOriginalName(); // Append that file original name 'name' to the $data array    // Remember that $image here is an object of the Laravel \Illuminate\Http\UploadedFile.php class!
            // dd($data['name']);

            // We'll name the resized image as follows: for example, if the original image name is 'test.jpg', we'll call the resized image 'test-resized.jpg'
            $filename = pathinfo($data['name'], PATHINFO_FILENAME); // e.g. lamborghini    // Get the file name WITHOUT the file extension
            // dd(filename);

            // Get the file extension of the file (image)
            $extension = $image->getClientOriginalExtension();
            // dd($extension);

            $originalPath = $absolutePath . $data['name'];
            // dd($originalPath);

            $image->move($absolutePath, $data['name']); // move(destination, name (optional)) function: 'destination' is the destination/target directory where to save the file. 'name' is the name of the file in case you want to rename it.    // Move the uploaded file (image) from the server's initial path (we don't know that initial path on the server, and we don't care!) to our dedicated path, and then rename the file with its original (uploaded) name    // Copying & Moving Files: https://laravel.com/docs/9.x/filesystem#copying-moving-files

        } else { // if the $image is a URL (which is sent in the HTTP Request as a key in the JSON Body in Postman), not an uploaded file (check rules() method in ResizeImageRequest.php Form Request class)
            // dd($image); // image URL
            $data['name'] = pathinfo($image, PATHINFO_BASENAME); // e.g. Kit-Cat.png    // Append the image name 'name' to the $data array    // Remember that $image here is a string (an image URL), not an uploaded file (image)        // Note: pathinfo() function not only can be used with files, but also can be used with URLs (links)
            // dd($data['name']); // e.g. Kit-Cat.png

            $filename = pathinfo($image, PATHINFO_FILENAME); // Kit-Cat    // Get the file name WITHOUT the file extension    // Note: pathinfo() function not only can be used with files, but also can be used with URLs (links)
            // dd($filename);

            $extension = pathinfo($image, PATHINFO_EXTENSION); // png    // Get the file/image (URL) extension    // Note: pathinfo() function not only can be used with files, but also can be used with URLs (links)
            // dd($extension);

            $originalPath = $absolutePath . $data['name'];

            copy($image, $originalPath); // To copy/save/download an image from a URL to file system/storage (server) in Laravel, use copy() method   // Copying & Moving Files: https://laravel.com/docs/9.x/filesystem#copying-moving-files
        }


        $data['path'] = $dir . $data['name']; // Append 'path' to the $data array to store it in the `path` column in the `image_manipulations` database table


        // Actual image resizing
        $w = $all['w']; // width (width is required in the Query String Parameters of the URL/route). Also, it can either be percentages % (e.g. 78%) or numbers (px) (e.g. 78)
        $h = $all['h'] ?? false; // height (height is optional) (height is submitted in the Query String Parameters of the URL/route). Also, it can either be percentages % (e.g. 78%) or numbers (px) (e.g. 78)
        // dd($w);
        // dd($h);

        list($width, $height, $image) = $this->getImageWidthAndHeight($w, $h, $originalPath); // this method returns an array of the $newWidth, $newHeight and "Intervention Image" PHP package $image instance/object
        // echo '<pre>', var_dump($width, $height), '</pre>';
        // exit;

        // Resize image with our calculated new $width and $height
        // All resized images names will be suffixed with '-resized.extension' like originalimagename-resized.jpg (Examples: cat-resized.jpg, lamborghini-resized.jpg, etc)
        $resizedFilename = $filename . '-resized.' . $extension; // the resized image name e.g. test-resized.jpg

        // Using "Intervention Image" package for image resizing: https://image.intervention.io/v2
        $image->resize($width, $height)->save($absolutePath . $resizedFilename); // Image::resize(): https://image.intervention.io/v2/api/resize    // Image::save():    // resize the image and then save it in the same original path (where we stored the uploaded image) with the new name e.g. new name pattern is:    x-resized.ext

        $data['output_path'] = $dir . $resizedFilename; // Append the resized image path to the $data array to store it in the `output_path` column in `image_manipulations` database table

        $imageManipulation = ImageManipulation::create($data); // INSERT $data array into `image_manipulations` database table    // Note: The create() method returns an instance of the inserted instance (data) in model / database table. This can be done by assigning the create() method to a variable e.g. $flight = Flight::create([ 'name' => 'London to Paris' ]);     where $flight variable is the newly created instance. Check https://laravel.com/docs/9.x/eloquent#mass-assignment:~:text=single%20PHP%20statement.-,The%20inserted%20model%20instance%20will%20be%20returned%20to%20you%20by%20the,-create    AND    https://laravel.com/docs/9.x/eloquent-relationships#the-create-method:~:text=The%20newly%20created,method


        return new ImageManipulationResource($imageManipulation); // We return the newly resized image to the user
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageManipulation  $imageManipulation
     * @return \App\Http\Resources\V1\ImageManipulationResource
     */
    public function show(Request $request, ImageManipulation $image) // Get a Single image    // Route Model Binding: https://laravel.com/docs/9.x/routing#route-model-binding
    {
        if ($request->user()->id != $image->user_id) { // if the currently authenticated user is not the owner of the image, the user is unauthorized to show that image
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }


        return new ImageManipulationResource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageManipulationRequest  $request
     * @param  \App\Models\ImageManipulation  $imageManipulation
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateImageManipulationRequest $request, ImageManipulation $imageManipulation)
    // {
        // Not implemented yet!
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageManipulation  $imageManipulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ImageManipulation $image) // Delete an image (of the authenticated/logged-in user)
    {
        if ($request->user()->id != $image->user_id) { // if the currently authenticated user is not the owner of the image, the user is unauthorized to delete that image
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }

        $image->delete();


        return response('', 204); // Note: Laravel return -s here a 200 Status Code by default, but instead, we'll return a custom Status Code 204    // 204 No Content
    }



    // Calculate the original image's width and height, then calculate the new image's resize width and height, then return them
    protected function getImageWidthAndHeight($w, $h, string $originalPath) {
        // We use the "Intervention Image" PHP package for image manipulation and handling (image resizing): https://image.intervention.io/v2
        // We need to calculate the value of width and height in pixels (px) from the original width and height of the image (e.g. if the original value is 1000px and the desired width is 50%, the final value should be 500px (which is 1000 * 50/100 = 500px))
        $image = \Intervention\Image\Facades\Image::make($originalPath); // Make an image instance of the original path    // Image::make(): https://image.intervention.io/v2/api/make
        // dd($image);

        $originalWidth  = $image->width();  // Image::width():  https://image.intervention.io/v2/api/width
        $originalHeight = $image->height(); // Image::height(): https://image.intervention.io/v2/api/height

        if (str_ends_with($w, '%')) { // if the width 'w' provided by user has a percentage sign % e.g. 50%
            $ratioW =      (float) str_replace('%', '', $w);           // width is required from user to provide, but height is OPTIONAL    // replace the percentage sign % with empty string in $w (remove the percentage sign % from $w)    
            $ratioH = $h ? (float) str_replace('%', '', $h) : $ratioW; // width is required from user to provide, but height is OPTIONAL    // if height is not provided by user, make it equal to width (width is originally required)     // replace the percentage sign % with empty string in $w (remove the percentage sign % from $w)    

            $newWidth  = $originalWidth  * $ratioW / 100;
            $newHeight = $originalHeight * $ratioH / 100;
            // dd($newWidth);
            // dd($newHeight);

        } else { // if the width provided by user doesn't have a percentage sign i.e. it's just a number (i.e px) e.g. 50 (which means 50px)
            $newWidth  = (float) $w;
            $newHeight = $h ? (float) $h : $originalHeight * ($newWidth / $originalWidth); // the new height will be equal to $h if provided by user, but if $h isn't provided, the new height will be equal to the ratio of the (new width/original width) multiplied by the original height    
            // dd($newWidth);
            // dd($newHeight);
        }


        return [$newWidth, $newHeight, $image];
    }
}