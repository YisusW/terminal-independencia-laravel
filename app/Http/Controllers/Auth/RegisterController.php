<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $adminExist = User::where('privilegies' , 'A')->get()->first();

        $message = 'Debes registrar el Usuario Administrador del sistema';

        if( $adminExist )
            $this->middleware('auth');

        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'name'     => 'required|string|max:255|unique:users,name',
            
            'nombre'   => 'required|string|max:100',

            'apellido' => 'required|string|max:100',
            
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $user_admin = User::where('privilegies' , '=' , 'A' )->get()->last(); 

        $privielgies_ = 'A';

        $status = 'A';

        
        if( $user_admin ){ $privielgies_ = 'S';  $status = 'I'; }

        $fecha =  \DB::select('select now()');

        $user = \DB::table('users')->insert([

            'name' => $data['name'],

            'password' => bcrypt($data['password']),

            'nombre' => $data['nombre'],

            'apellido' => $data['apellido'],

            'privilegies' => $privielgies_,

            'status' => $status,

            'updated_at' => $fecha[0]->now ,
            
            'created_at' => $fecha[0]->now 
        ]);

        $user = User::where('name' , $data['name'])->get()->last(); 
            
        return  $user;

    }

}
