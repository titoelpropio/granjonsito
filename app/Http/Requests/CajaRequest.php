<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CajaRequest extends Request
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
             'cantidad_caja'=>'required',
             'cantidad_maple'=>'required',
             'cantidad_huevo'=>'required',
             'id_tipo_caja'=>'required',
             'fecha'=>'required',          
        ];
    }
}
