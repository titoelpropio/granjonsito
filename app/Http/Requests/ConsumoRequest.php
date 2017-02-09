<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConsumoRequest extends Request
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
           'id_fase_galpon'=>'required',
           'id_control_alimento'=>'required',
            'id_silo'=>'required',
            'cantidad'=>'required',
        ];
    }
}
