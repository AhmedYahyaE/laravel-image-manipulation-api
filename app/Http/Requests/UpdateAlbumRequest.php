<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumRequest extends FormRequest
{
    // Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation



    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation

        // return false;
        return true; // Changed 'false' to 'true' to avoid that error in Postman: "This action is unauthorized."
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Form Request Validation: https://laravel.com/docs/9.x/validation#form-request-validation

        return [
            'name' => 'required'
        ];
    }
}
