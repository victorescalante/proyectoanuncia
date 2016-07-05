<?php

namespace Anuncia\Http\Requests;

use Anuncia\Http\Requests\Request;

class FootbridgeRequest extends Request {

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
            'name'            => 'required',
            'availability'    => 'required',
            'id_state'        => 'required|numeric',
            'municipality_id' => 'required|numeric',
            'latitude'        => 'required',
            'length'          => 'required',
        ];
    }
}
