<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Temperatura;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Hash;

class TemperaturaController extends Controller{

  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
     $this->middleware('auth',['only'=>'admin']);
  }
  function index(){
    $temperatura=Temperatura::paginate(10);
    return view('temperatura.index',compact('temperatura'));
  }

  public function update(Request $request,$id){
    $temperatura= Temperatura::find($id);
    $temperatura->fill($request->all());
    $temperatura->save();
    return Redirect::to('/temperatura');
  }

  public function edit($id){
      $temperatura=Temperatura::find($id);
      return view('temperatura.edit',['temperatura'=>$temperatura]);
  }

}
