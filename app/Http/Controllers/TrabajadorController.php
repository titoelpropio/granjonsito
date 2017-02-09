<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Trabajador;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Session;
use Redirect;


class TrabajadorController extends Controller
{
    
	function index(){
        $trabajador=Trabajador::paginate(7);
        return view('trabajador.index',compact('trabajador'));
	}
  
  
	public function create(){
      return view('usuario.create');	
    }
    
    public function store(TrabajadorCreateRequest $request){
    	Trabajador::create ([
            'nombre' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'cargo' => $request['cargo'],
            'acceso' => $request['acceso'],
            'nick' =>$request['nick'],
            'pass' => $request['pass'],
        ]);
        return "Usuario registrado";        
    }

    public function edit($id){
       $trabajador = Trabajador::find($id);
       return view('trabajador.edit',['user'=>$trabajador]);
    }

    public function update($id, UserUpdateRequest $request){
        $user =Trabajador::find($id);
        $user->fill($request->all());
        $user->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/trabajador');
    }
    
    public function destroy($id){
        $trabajador=Trabajador::find($id);
        $trabajador->delete();
        Session::flash('message','Usuario Eliminado Correctamente');
       return Redirect::to('/trabajador');
    }
}
