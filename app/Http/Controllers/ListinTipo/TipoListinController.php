<?php

namespace App\Http\Controllers\ListinTipo;

use App\TipoListin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoListinController extends Controller
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
        $tipo = TipoListin::orderBy('status' , 'desc')->get();
        
        if( count($tipo) == 0 ) return view('tipo-listine.create');

        return view('tipo-listine.create')->with( compact('tipo') );
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

    public function validar_registro( $datos = array() ){

        return  Validator::make( $datos , [

            'nombre' => 'required|alpha_num|unique:tipo_listin,descripcion',

            'estatus' => 'required|string',

        ] );
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
        $valid = $this->validar_registro( $request->all() );

        if( $valid->fails() ){
            
            return redirect('tipo-listine')->withErrors( $valid->errors() );
        }

        $tipo_listine = new TipoListin;

        $status = ( $request->estatus == 'Activo'  ) ? true : false ;

        $tipo_listine->descripcion  = $request->nombre;

        $tipo_listine->status  = $status ;
     
        if( $tipo_listine->save() ){

            $message = 'El tipo de fue guardado correctamente';

            $tipo = TipoListin::orderBy('status' , 'desc')->get();

            return redirect('tipo-listine')->with( compact('message' , 'tipo') );            

        }


    }

    protected function cambiar_estatus( $tipo ){

        $every = TipoListin::where( 'id' , '!=' , $tipo->id )->where('status' , true )->get();

        foreach ($every as $key => $value) {
            # code...
            $value->status = false;
            $value->update();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function show(TipoListin $tipoListin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoListin $tipoListin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoListin $tipoListin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoListin $tipoListin)
    {
        //
    }

    public function config_price( Request $request )
    {       
        $tipo =  TipoListin::where( 'status' , 't' )->get([ 'id' , 'descripcion' , 'status' ]);

        $listin_precio = \App\TipoListinPrice::orderBy( 'status' , 'desc' )

        ->orderBy( 'created_at' , 'desc' )

        ->get();

        return view('listine.price')->with(compact('tipo' , 'listin_precio'));
    }    
}
