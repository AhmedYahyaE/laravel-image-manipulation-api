<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // Get all albums of the authenticated/logged-in user
    {
        // Note: The Resource collection() method wraps your response in a 'data' key. Data Wrapping: https://laravel.com/docs/9.x/eloquent-resources#data-wrapping
        return \App\Http\Resources\V1\AlbumResource::collection(\App\Models\Album::where('user_id', $request->user()->id)->paginate()); // Return all albums (that ONLY belong to the authenticated/logged-in user)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request) // Create an Album (POST request)    // Note the Type Hinting of the StoreAlbumRequest Form Request class. Check    Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation
    {
        // Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation

        $data = $request->all();

        // Create an album devoted only for the authenticated/logged-in user
        $data['user_id'] = $request->user()->id;
        $album = Album::create($data);
        // dd($album);

        // return $album;

        // Using AlbumResource.php (instead of    return $album;    )
        return new \App\Http\Resources\V1\AlbumResource($album); // We return the newly created album to the user
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Album $album) // Get a Single album (that belongs to the authenticated user)    // Route Model Binding: https://laravel.com/docs/9.x/routing#route-model-binding
    {
        if ($request->user()->id != $album->user_id) { // if the currently authenticated user is not the owner of the album, the user is unauthorized to show that album    
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }


        return new \App\Http\Resources\V1\AlbumResource($album); // We return the album to the user
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album) // Update an Album (PUT/PATCH request) (that belongs to the authenticated/logged-in user)    // Route Model Binding: https://laravel.com/docs/9.x/routing#route-model-binding    // Note the Type Hinting of the UpdateAlbumRequest Form Request class. Check    Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation
    {
        // Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation

        if ($request->user()->id != $album->user_id) { // if the currently authenticated user is not the owner of the album, the user is unauthorized to update that album    
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }

        // dd($request->all());

        $album->update($request->all());


        return new \App\Http\Resources\V1\AlbumResource($album); // We return the album after being updated to the user
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Album $album) // Delete an album (that belongs to the authenticated/logged-in user)    // Route Model Binding: https://laravel.com/docs/9.x/routing#route-model-binding
    {
        if ($request->user()->id != $album->user_id) { // if the currently authenticated user is not the owner of the album, the user is unauthorized to delete that album    
            return abort(403, 'Unauthorized'); // '403' HTTP status code means 'Forbidden'
        }

        $album->delete();


        return response('', 204); // Note: Laravel return -s here a 200 Status Code by default, but instead, we'll return a custom Status Code 204    // 204 No Content
    }
}