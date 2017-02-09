<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GalponFormRequest extends Request
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
            'nombre'=>'required|max:20',
            'capacidad_total'=>'required',
            'cantidad_inicial'=>'required',
            'cantidad_total'=>'required',
            'consumo'=>'required',
        ];
    }
}
