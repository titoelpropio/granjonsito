<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Redirect;
use Illuminate\Routing\Route;


class FrontController extends Controller
{
    public function __construct() {
      $this->middleware('auth',['only' => 'admin']);
//        $this->beforeFilter('@find',['only'=>['admin','update','destroy']]);
//        $this->middleware('auth',['only'=>'admin']);
        
    }

   public function index()
   {

   	return view('index');
   }
   public function contacto()
   {

   	return view('contacto');
   }
   public function review()
   {

   	return view('view');
   }
   public function admin(){
        return view('admin.index');
   }
}
