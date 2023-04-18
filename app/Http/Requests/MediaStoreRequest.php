<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->isMethod('media')) {
        return [
            'name' => ['required', 'max:100'],
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'path' => ['required'],
            'type' => ['required'],
        ];
    } else {
        return [
            'name' => 'required|string|max:258',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'path' => 'required',
            'type' => 'required'
        ];
    }
  }

  public function messages()
  {
    if(request()->isMethod('media')) {
        return [
            'name.required' => 'Name is required!',
            'image.required' => 'Image is required!',
            
        ];
    }
  }

}
