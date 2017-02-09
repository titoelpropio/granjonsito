<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use Redirect;
use DB;

class LoginController extends Controller {

    function index() {
        return view('log.index');
    }

    public function create() { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $email= $request['email'];
        $password= $request['password'];
         $sesion=Auth::user();
        if (Auth::attempt(['email' =>$email, 'password' =>$password])) {
            return Redirect::to('galpon');
//          return response()->json(['messaje',$sesion]);
        }
//        $sesion=Auth::user();
        Session::flash('message-error', 'DATOS INCORRECTOS INTENTE NUEVAMENTE');
        return Redirect::to('/');
//        return response()->json(['messaje',$sesion]);
//        if($sesion!=null){
//          return response()->json(['messaje','no es null']);  
//        }
// else {return response()->json(['messaje','no es null']); }
//          $email= $request['email'];
//        $password= $request['password'];
//        if (Auth::loginUsingId(1)==false) {
////            return Redirect::to('galpon');
//            return response()->json(['messaje',Auth::loginUsingId(1)]);
//        }
      
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
