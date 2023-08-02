<?php
// This Form Request class is related to the ImageManipulationController


namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;



class ResizeImageRequest extends FormRequest
{
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

        // Dynamically adding rules inside the rules array: (instead of    return [ ];    )
        $rules = [
            'image'    => ['required'],
            'w'        => ['required', 'regex:/^\d+(\.\d+)?%?$/'], // 'w' stands for 'width'. Width possible values can be: 50, 50%, 50.123 or 50.123%    // regex:pattern: https://laravel.com/docs/9.x/validation#rule-regex
            'h'        => ['regex:/^\d+(\.\d+)?%?$/'], // 'h' stands for 'height'. Height is OPTIONAL. Height possible values can be: 50, 50%, 50.123 or 50.123%    // regex:pattern: https://laravel.com/docs/9.x/validation#rule-regex
            'album_id' => 'exists:\App\Models\Album,id' // 'album_id' must be a valid id inside `albums` database table    // exists:table,column: Specifying A Custom Column Name: https://laravel.com/docs/9.x/validation#rule-exists:~:text=staff%2Cemail%27-,Instead%20of%20specifying%20the%20table%20name,-directly%2C%20you%20may
        ];

        $image = $this->all()['image'] ?? false; // $this variable stands for the current ResizeImageRequest.php class (the $request)
        // dd($image);

        // Check if the $image is either a URL or a physical uploaded file
        if ($image && $image instanceof \Illuminate\Http\UploadedFile) { // if the $image exists in the request and the $image is a physical uploaded file ($image is an object of the Laravel \Illuminate\Http\UploadedFile class), not a URL, append the 'image' Laravel Validation Rule to the $rules array (to the 'image' array key/index)    // image: https://laravel.com/docs/9.x/validation#rule-image
            $rules['image'][] = 'image'; // Append the 'image' Laravel Validation Rule to the $rules array (to the 'image' array key/index)    // image: https://laravel.com/docs/9.x/validation#rule-image
        } else { // if the $image in the request is a URL (not a physical uploaded file), append the 'url' Laravel Validation Rule to the $rules array (to the 'image' array key/index)    // url: https://laravel.com/docs/9.x/validation#rule-url
            $rules['image'][] = 'url'; // Append the 'url' Laravel Validation Rule to the $rules array (to the 'image' array key/index)    // url: https://laravel.com/docs/9.x/validation#rule-url
        }

        // dd($rules);


        return $rules;
    }
}