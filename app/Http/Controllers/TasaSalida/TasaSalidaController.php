<?php

namespace App\Http\Controllers\TasaSalida;

use Carbon\Carbon;
use App\TasaSalida;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TasaSalidaController extends Controller
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
    public function index( )
    {   
        $tasa  = \App\TasaSalidaUser::where( 'id_user' , \Auth::user()->id  )
        
        ->where( 'description' , 'Abierta' )->get(['description'])->first();

        if( isset($tasa->description) ){   

            $info = 'Ésta jornada debe ser cerrada antes de abrir una nueva';
            // si se encuentra la jornada abierta redirecciona a  cerrar la jornada
            return redirect('let-it-go')->with( compact('tasa' , 'info') );
        }

        $precio = TasaSalida::where( 'status' , 't' )->get([ 'id' , 'precio' ])->first();

        $carbon = Carbon::now('America/Caracas');

        $fecha =  $carbon->formatLocalized('%A %d %B %Y');

        return view('tasa-salida.open_jornada')->with(compact( 'precio' , 'fecha' , 'carbon' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_tasa(array $data)
    {
        return Validator::make($data, [

            'price' => 'required|numeric|unique:tasa_salida,precio',

            'status' => 'required|string',

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $vali_result =  $this->validator_tasa( $request->all() );

        if( $vali_result->fails() ){

            return redirect('tasa-salida-config')
            ->withErrors( $vali_result->errors() );
                        
        }

         $tasa = new TasaSalida;

         $status = ( $request->status == 'Activo'  ) ? true : false ;

             $tasa->precio = $request->price ;

             $tasa->status = $status ; 

             $tasa->codigo_serial = 00000001 ;     
         
         if( $tasa->save() ){

            if ( $tasa->status == true ) {

                $other = TasaSalida::where( 'id' , '!=' , $tasa->id )->where('status' , true )->get();

                foreach ($other as $key => $value) {
                    # code...
                    $value->status = false;
                    $value->update();
                }

            }

            $message = 'Tasa de salidad Configurada Correctamente';

            $tasa = TasaSalida::orderBy('status' , 'desc')->get();

            return view('tasa-salida.config')->with(compact('message', 'tasa'));
         }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TasaSalida  $tasaSalida
     * @return \Illuminate\Http\Response
     */
    public function show(TasaSalida $tasaSalida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TasaSalida  $tasaSalida
     * @return \Illuminate\Http\Response
     */
    public function edit(TasaSalida $tasaSalida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TasaSalida  $tasaSalida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TasaSalida $tasaSalida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TasaSalida  $tasaSalida
     * @return \Illuminate\Http\Response
     */
    public function destroy(TasaSalida $tasaSalida)
    {
        //
    }

    public function config(){

        $tasa = TasaSalida::orderBy('status' , 'desc')->get();

        return view('tasa-salida.config')->with( compact('tasa') );
    }
}
