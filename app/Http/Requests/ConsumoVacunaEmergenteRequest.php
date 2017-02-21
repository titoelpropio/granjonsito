<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConsumoVacunaEmergenteRequest extends Request
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
           /*'cantidad_vac'=>'required',
           'precio_vac'=>'required',
            'estado_vac'=>'required',
            'id_vac'=>'required',*/
            'id_galponcv'=>'required',
        ];
    }
}
