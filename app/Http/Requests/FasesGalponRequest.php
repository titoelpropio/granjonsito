<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FasesGalponRequest extends Request
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
             'id_edad'=>'required',
            'id_fase'=>'required',          
            'cantidad_inicial'=>'required',
            'cantidad_actual'=>'required',
            'total_muerta'=>'required',            
            'fecha_inicio'=>'required',            
        ];
    }
}
