<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsuarioController extends Controller
{
    //

	public function __construct ()
	{
		# code...
		$this->middleware('auth');
	
	}

	private function consultar_usuarios (){

    	$thisid = \Auth::user()->id;
    	
    	return \App\User:: where( 'id' , '!=' , $thisid) ->where( 'status' , 'I' )->get();    	

	}


    public function index( Request $request ){

    	$user = $this->consultar_usuarios();

    	return view( 'usuarios.usuarios' )->with(compact('user'));
    }

    public function update(Request $request, User $user , $id ) {

    	$user = $user::where( 'id' , $id )->get()->last();

    	$user->status = 'A';

    	$error = 'Usuario '.$user->name.' No se pudo Actualizar vuelve a intentarlo';

        $carbon = Carbon::now('America/Caracas');

        $user->updated_at = $carbon ;

    	if( $user->update() ){

    		$message = 'El Usuario '.$user->name.' Ya puede acceder a el sistema correctamente';
    		
    		$user = $this->consultar_usuarios();

    		return view( 'usuarios.usuarios' )->with(compact('message','user'));
    	} 

    	return view( 'usuarios.usuarios' )->with(compact('error','user'));

    } 
}
