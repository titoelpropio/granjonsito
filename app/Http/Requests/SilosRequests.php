<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SilosRequests extends Request
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
            'id'=>'required',
            'nombre'=>'required',
            'capacidad'=>'required',
            'cantidad'=>'required',
            'cantidad_minima'=>'required',
            'id_alimento'=>'required',
            //'estado'=>'required',
        ];
    }
}
