<?php

namespace App\Http\Controllers\TasaSalida;

use App\TasaSalidaUser;
use App\TasaSalida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TasaSalidaUserController extends Controller
{


    public function __construct()
    {
        # code...        
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , TasaSalidaUser $tasaSalidaUser)
    {
        //
        
        $tasa = TasaSalida::where( 'id' , $request->price )->get()->first() ;

        $tasaSalidaUser = TasaSalidaUser::where( 'id_user' , \Auth::user()->id )

        ->where('description' , 'Abierta')->get()->last();
        
        if( isset( $tasaSalidaUser) ){

            $error = 'No has Hecho cierre de la ultima jornada';

            return redirect('open-jornada-tasa')->with('error' ,$error);

        }

        $tasaSalidaUser = new TasaSalidaUser;

        $tasaSalidaUser->id_user = \Auth::user()->id;

        $tasaSalidaUser->id_tasa_salida = $tasa->id;

        $tasaSalidaUser->fecha = $request->fecha_apertura_jornada;    

        if( $tasaSalidaUser->save() ) {

            $message = 'La Jornada Se Abrió de Manera Correcta';

            return redirect('open-jornada-tasa')->with('message' ,$message);

        }else {

            $error = 'Usuario '.$user->name.' No Existe ó el precio no existe en la base de datos ';

            return redirect('open-jornada-tasa')->with('error' , $error);

        }


    }

    public function preparar_datos_vender( Request $request )
    {
        # code...

        $tasa = TasaSalidaUser::where( 'id_user' , \Auth::user()->id )

        ->where('description' , 'Abierta')->get()->last();

        return view('tasa-salida.vender')->with(compact('tasa'));
    }

    public function cerrar_jornada( Request $request , $id , $id_jornada ){

        
        if( \Auth::user()->id == (int) $id  ){

            $tasa = TasaSalidaUser::where( 'id_user' , $id )

            ->where('description' , 'Abierta')
            
            ->where( 'id'  , '=' , (int) $id_jornada )
            
            ->get()->first();

            $tasa->description  = 'Cerrada'; 

            $carbon = Carbon::now('America/Caracas');

            $tasa->updated_at = $carbon ;

            if ( $tasa->save() ){

                $message = "La jornada fué cerrada correctamente ";

                $option_reported = true ;

                return redirect('let-it-go')->with(compact('message' , 'option_reported'));

            }

        } else {

                $error = "La jornada NO fué cerrada correctamente";

                return redirect('let-it-go')->with('error' , $error);
        }
        
    }

 
}
