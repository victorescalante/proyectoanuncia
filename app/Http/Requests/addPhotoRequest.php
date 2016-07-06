<?php

namespace Anuncia\Http\Requests;

use Anuncia\Http\Requests\Request;

class addPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Photo' => 'required|mimes:jpg,jpeg,png',
        ];
    }
}
