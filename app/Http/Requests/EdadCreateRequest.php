<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EdadCreateRequest extends Request
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
            'fecha_inicio'=>'required',
            'estado'=>'required',
            'id_galpon'=>'required',
        ];
    }
}
